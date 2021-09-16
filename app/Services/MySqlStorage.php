<?php

namespace App\Services;

use App\Events\FileUploaded;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile as File;

class MySqlStorage implements IStorage
{
    /** @var Collection  */
    private Collection $collection;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function moveTo(array $data): void
    {

        $user = array_key_exists('user', $data) ? $data['user'] : null;

        /** @var File $file */
        foreach ($data['files'] as $file) {
            $model = new \App\Models\File();

            $email = !$user ?:  $user->email;

            $model->name = $file->getClientOriginalName();
            $model->mime = $file->getMimeType();
            $model->filecontent = $file->getContent();
            $model->user_id = !$user ?:  $user->id;
            $model->user_email = $email;

            $model->save();

            $this->collection->add($model);

            FileUploaded::dispatch([
                'file_id' => $model->id,
                'link'=> 'http://0.0.0.0/files_downloader/file/'.$model->id,
                'filename' => $model->name,
                'creator_email' => $model->user_email,
            ]);
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
