<?php

namespace App\Events;

class FileUploaded implements IEvent
{
    /**
     * @var array
     */
    public array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array {
        return $this->data;
    }
}

