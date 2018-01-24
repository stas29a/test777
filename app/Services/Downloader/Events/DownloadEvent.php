<?php
namespace App\Services\Downloader\Events;

use App\Services\Downloader\Entities\Task;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownloadEvent implements ShouldQueue
{
    /**
     * @var \App\Services\Downloader\Entities\Task
     */
    protected $task;

    /**
     * DownloadEvent constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask()
    {
        return $this->task;
    }
}