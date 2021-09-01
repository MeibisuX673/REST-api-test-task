<?php


namespace App\Services;


interface SwiftMailerServiceInterface
{
    /**
     * @param string $email
     * @return mixed
     */
    public function sendMessage(string $email);

    /**
     * @param string $email
     * @param $message
     * @return mixed
     */
    public function sendMessageTest(string $email, $message);
}