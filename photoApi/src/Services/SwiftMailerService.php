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
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('test.test@test.com','GAY')
            ->setTo($email)
            ->setBody('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($message);
    }

    public function sendMessageTest(string $email, $message)
    {
        $message = (new \Swift_Message("You have registered'))
            ->setFrom('test.test@test.com','Test')
            ->setTo($email)
            ->setBody($message);

        $this->mailer->send($message);
    }
}