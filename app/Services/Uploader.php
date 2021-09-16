<?php

namespace App\Services;


use \Illuminate\Contracts\Auth\Authenticatable as User;
use Illuminate\Http\Request;

class Uploader
{
    /** @var Request  */
    private Request $request;
    private ?User $user = null;
    private IStorage $storage;

    public function __construct(Request $request, IStorage $storage)
    {
        $this->request = $request;
        $this->storage = $storage;
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
