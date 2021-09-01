<?php


namespace App\Events;


use Symfony\Contracts\EventDispatcher\Event;

class LoadImageEvent extends Event
{
    private $nameFile;

    public function __construct(string $nameFile){
        $this->nameFile = $nameFile;
    }

    public function getNameFile(){
        return $this->nameFile;
    }
}