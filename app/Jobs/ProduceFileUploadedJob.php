<?php

namespace App\Jobs;

class ProduceFileUploadedJob extends ABaseJob
{
    private array $data;

    public $queue = 'default';

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle() {

    }
}
