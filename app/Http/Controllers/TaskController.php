<?php
namespace App\Http\Controllers;

use App\Services\Downloader\DownloaderService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TaskController extends BaseController
{
    /** @var  DownloaderService */
    protected $downloadService;

    /**
     * TaskController constructor.
     * @param DownloaderService $downloaderService
     */
    public function __construct(DownloaderService $downloaderService)
    {
        $this->downloadService = $downloaderService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->downloadService->getTasks());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function publishTask(Request $request)
    {
        return response()->json($this->downloadService->publishDownloadTask($request->post('url')));
    }
}