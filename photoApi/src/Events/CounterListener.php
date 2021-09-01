<?php


namespace App\Events;


use App\Entity\Image;
use App\Services\CounterManagerService;
use App\Services\SwiftMailerServiceInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;


class CounterListener
{

    private $counterManager;

    public function __construct(

        CounterManagerService $counterManager
    ){

        $this->counterManager = $counterManager;
    }


    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        if ($entity instanceof Image){
            $this->counterManager->writeZero($entity->getFile()->getName());

        }
    }
}