<?php


namespace App\Controller;

use App\Events\SendMessageEmailEvent;
use App\Services\EventServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AuthController extends BaseController
{
    private $userService;

    private $eventService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     * @param EventServiceInterface $eventService
     */
    public function __construct(UserService $userService, EventServiceInterface $eventService)
    {
        $this->userService = $userService;
        $this->eventService = $eventService;
    }

    /**
     * @Route("api/register",name = "register")
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $user = $request->getContent();
        $user = json_decode($user,true);
        if (!is_null($this->userService->handleFindOne($user['email']))){
            return $this->json(['message'=>'The user exists'],409);
        }
        $user = $this->userService->handleCreate($user['email'],$user['password']);

        $event = new SendMessageEmailEvent($user->getEmail());
        $this->eventService->dispatchEvent($event);

        return $this->json($user,201);
    }
}