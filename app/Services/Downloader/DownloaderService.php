<?php
namespace App\Services\Downloader;

use App\Services\Downloader\Entities\Task;
use App\Services\Downloader\Events\DownloadEvent;
use Doctrine\ORM\EntityManagerInterface;

class DownloaderService
{
    protected $entityManager;

    /**
     * DownloaderService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Publish task for downloading resource by given url
     * @param string $url
     * @return bool
     */
    public function publishDownloadTask(string $url)
    {
        $repo = $this->entityManager->getRepository(Task::class);
        $o = $repo->findOneBy(['externalUrl' => $url]);

        if($o)
            return false;

        $task = new Task();
        $task->setExternalUrl($url);
        $task->setStatus(Task::STATUS_PENDING);
        $task->setCreatedAt(new \DateTime());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        $this->entityManager->detach($task);

        $event = new DownloadEvent($task);
        event($event);

        return true;
    }

    public function getTasks()
    {
        /**
         * Для теста возвращаем все что есть
         */
        return $this->entityManager->getRepository(Task::class)->findAll();
    }
}