<?php
namespace App\Services\Downloader\Subscribers;

use App\Services\Downloader\Entities\Task;
use App\Services\Downloader\Events\DownloadEvent;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Storage;

class DownloadSubscriber
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param DownloadEvent $event
     */
    public function onDownloadEvent(DownloadEvent $event)
    {
        /** @var Task $task */
        $task = $this->em->find(Task::class, $event->getTask()->getId());
        $task->setStatus(Task::STATUS_DOWNLOADING);
        $this->em->flush();
        $pathInfo = pathinfo($task->getExternalUrl());

        /**
         * Это только для тестовых целей, на проде нужно выносить в отдельный метод
         * + проверять расширения вроде php чтобы дыр не открывать
         */
        $task->setLocalUrl("storage//". rand(0, 999999).'_'. $pathInfo['filename']);

        /**
         * Опять же только для теста, если файлы будут большие это все упадет
         * и нужно будет на более нативный метод переделывать, все от требований зависит
         */
        $data = file_get_contents($task->getExternalUrl());

        if($data === false)
            $task->setStatus(Task::STATUS_ERROR);
        else {
            Storage::disk('local')->put($task->getLocalUrl(), $data);
            $task->setStatus(Task::STATUS_COMPLETE);
        }

        $this->em->flush();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            DownloadEvent::class,
            DownloadSubscriber::class."@onDownloadEvent"
        );
    }
}