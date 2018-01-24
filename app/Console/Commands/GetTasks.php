<?php

namespace App\Console\Commands;

use App\Services\Downloader\DownloaderService;
use Illuminate\Console\Command;

class GetTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return all tasks';

    /**
     * @var DownloaderService
     */
    protected $downloadService;

    /**
     * GetTasks constructor.
     * @param DownloaderService $downloaderService
     */
    public function __construct(DownloaderService $downloaderService)
    {
        parent::__construct();
        $this->downloadService = $downloaderService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        print_r($this->downloadService->getTasks());
    }
}
