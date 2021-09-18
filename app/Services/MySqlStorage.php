<?php

namespace App\Services;

use App\Events\FileUploaded;
use App\Services\EventDispatcher\IEventDispatcher;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile as File;
use Illuminate\Contracts\Events\Dispatcher;

class MySqlStorage implements IStorage
{
    /** @var Collection  */
    private Collection $collection;

    private IEventDispatcher $dispatcher;

    public function __construct(IEventDispatcher $dispatcher)
    {
        $this->collection = new Collection();
        $this->dispatcher = $dispatcher;
    }

    public function moveTo(array $data): void
    {
        $user = array_key_exists('user', $data) ? $data['user'] : null;

        /** @var File $file */
        foreach ($data['files'] as $file) {
            $model = new \App\Models\File();

            $email = !$user ?:  $user->email;
            $user_id = !$user ?:  $user->id;

            $model->name = $file->getClientOriginalName();
            $model->mime = $file->getMimeType();
            $model->filecontent = $file->getContent();
            $model->user_id = $user_id;
            $model->user_email = $email;

            $model->save();

            $this->collection->add($model);

            $this->dispatcher->dispatch(new FileUploaded([
                'file_id' => $model->id,
                'link'=> 'http://0.0.0.0/files_downloader/file/'.$model->id,
                'filename' => $model->name,
                'creator_email' => $model->user_email,
                'creator_id' => $user_id,
            ]));
        }
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }
}
