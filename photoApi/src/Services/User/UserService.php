<?php


namespace App\Services\User;


use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $userRepository;
    private $encoder;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserRepositoryInterface $userRepository,UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }


    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function handleCreate(string $email, string $password): User{
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->encoder->encodePassword($user,$password));
        $this->userRepository->setCreate($user);

        return $user;
    }

    /**
     * @param string $email
     * @return object|null
     */
    public function handleFindOne(string $email): ?object{
        return $this->userRepository->getOne($email);

    }

}