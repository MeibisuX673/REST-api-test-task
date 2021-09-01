<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

interface AuthControllerInterface
{
    public  function register(Request $request);


}