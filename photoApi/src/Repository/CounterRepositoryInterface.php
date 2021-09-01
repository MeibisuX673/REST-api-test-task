<?php


namespace App\Repository;


use App\Entity\Counter;
use App\Entity\Image;

interface CounterRepositoryInterface
{
    public function setCreate( Counter $counter);
}