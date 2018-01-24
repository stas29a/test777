<?php

namespace App\Console\Commands;

use App\Services\Downloader\DownloaderService;
use Illuminate\Console\Command;

class CreateTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:create {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create download task';

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
        $this->downloadService->publishDownloadTask($this->argument('url'));
    }
}
