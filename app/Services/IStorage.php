<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface IStorage
{
    /**
     * @param array $data
     * @return mixed
     */
    public function moveTo(array $data): void;

    /**
     * @return Collection
     */
    public function getCollection(): Collection;
}
