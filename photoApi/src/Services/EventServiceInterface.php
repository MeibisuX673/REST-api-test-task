<?php


namespace App\Services;


use Symfony\Contracts\EventDispatcher\Event;

interface EventServiceInterface
{
    public function dispatchEvent(Event $event, ?string $eventName = null): object;
}