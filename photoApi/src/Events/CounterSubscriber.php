<?php


namespace App\Events;


use App\Services\CounterManagerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CounterSubscriber implements EventSubscriberInterface
{

    private $counterManager;


    public function __construct(

        CounterManagerService $counterManager
    ){

        $this->counterManager = $counterManager;
    }

    public static function getSubscribedEvents()
    {
        return [
          LoadImageEvent::class => 'onLoadImage'
        ];
    }
    public function onloadImage(LoadImageEvent $event){
        $fileName = $event->getNameFile();

        $this->counterManager->counterPlus($fileName);
    }

}