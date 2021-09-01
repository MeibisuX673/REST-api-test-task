<?php


namespace App\Services;


use Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventService implements EventServiceInterface
{
    private $dispatcher;

    /**
     * EventService constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = LegacyEventDispatcherProxy::decorate($dispatcher);
    }

    public function dispatchEvent(Event $event, ?string $eventName = null): object{

        if(is_null($eventName)){
            return $this->dispatcher->dispatch($event);
        }
        return $this->dispatcher->dispatch($event,$eventName);

    }



}