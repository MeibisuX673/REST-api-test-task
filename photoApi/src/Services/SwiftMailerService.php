<?php


namespace App\Services;


class SwiftMailerService implements SwiftMailerServiceInterface
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function sendMessage(string $email)
    {
        $message = (new \Swift_Message('Hello!!'))
            ->setFrom('test.test@test.com','Test')
            ->setTo($email)
            ->setBody('You have registered');

        $this->mailer->send($message);
    }

}