<?php

namespace App\Subscribers;

use App\Events\FileUploaded;
use App\Jobs\ProduceFileUploadedJob;
use App\Services\JobDispatcher\IJobDispatcher as JobDispatcher;

final class FileUploadedSubscriber
{
    private JobDispatcher $jobDispatcher;

    public function __construct(JobDispatcher $jobDispatcher)
    {
        $this->jobDispatcher = $jobDispatcher;
    }

    public function handle(FileUploaded $event): void
    {
        $this->jobDispatcher->dispatch(
            new ProduceFileUploadedJob($event->getData())
        );
    }
}
