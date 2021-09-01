<?php


namespace App\Controller;


use App\Events\SendListener;
use App\Events\SendMessageEmailEvent;
use App\Events\SendMessageEmailSubscriber;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class TestController extends BaseController
{

    private $dispatcher;
    /**
     * TestController constructor.
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    /**
     *
     * @Route("/send", name="testSendMessge")
     * @return Response
     */
    public function sendMessage(){


        $event = new SendMessageEmailEvent('g1eme.please@gmail.com');
        $this->dispatcher->dispatch($event);


        return new Response('$this->json($real)',200);
    }


}