<?php


namespace App\Services;


interface SwiftMailerServiceInterface
{
    /**
     * @param string $email
     * @return mixed
     */
    public function sendMessage(string $email);

}