<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use \Illuminate\Contracts\Auth\Authenticatable as User;
use App\Http\Requests\UploadFilesRequest as Request;

class Uploader
{
    /** @var Request  */
    private Request $request;
    private ?User $user = null;
    private IStorage $storage;

    public function __construct(Request $request, IStorage $storage, Authenticatable $user)
    {
        $this->request = $request;
        $this->storage = $storage;
        $this->user = $user;
    }

    public function upload() {
        $this->storage->moveTo(['files' => $this->request->all(), 'user' => $this->user]);
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return IStorage
     */
    public function getStorage(): IStorage
    {
        return $this->storage;
    }
}
