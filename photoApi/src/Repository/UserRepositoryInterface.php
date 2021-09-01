<?php


namespace App\Repository;




use App\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return object
     */
    public function setCreate(User $user): object;

    /**
     * @param string $email
     * @return object|null
     */
    public function getOne(string $email): ?object;
}