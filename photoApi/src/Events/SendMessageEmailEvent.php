<?php


namespace App\Events;


use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;


class SendMessageEmailEvent extends Event
{
    /**
     * @var $email
     */
    private $email;

    public const NAME = 'user.register';

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}