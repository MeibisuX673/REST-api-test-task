<?php


namespace App\Events;



use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Services\SwiftMailerServiceInterface;


class SendMessageEmailSubscriber implements EventSubscriberInterface
{

    private $mailerInterface;


    public function __construct(SwiftMailerServiceInterface $mailerInterface){
        $this->mailerInterface = $mailerInterface;
    }


    public static function getSubscribedEvents()
    {
        return [
            SendMessageEmailEvent::class => ['onRegisterUser', 100]
        ];
    }

    public function onRegisterUser(SendMessageEmailEvent $event){

        $event->stopPropagation();
        $this->mailerInterface->sendMessage($event->getEmail());


    }
}