<?php


namespace App\Controller;


use App\Entity\Image;
use App\Events\LoadImageEvent;
use App\Services\CounterManagerService;
use App\Services\EventServiceInterface;

class GetItemImageOperationAction
{
    private $eventService;
    private $counterManager;

    public function __construct(
        EventServiceInterface $eventService,
        CounterManagerService $counterManager
    ){
        $this->eventService = $eventService;
        $this->counterManager = $counterManager;
    }

    public function __invoke(Image $data): Image
    {
        $fileName = $data->getFile()->getName();

        $event = new LoadImageEvent($fileName);
        $this->eventService->dispatchEvent($event);
        $counter = $this->counterManager->getCounter($fileName);

        $data->setCounter($counter);

        return $data;
    }
}