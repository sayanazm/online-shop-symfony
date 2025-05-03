<?php

namespace App\User\Doctrine\EventListener;

use App\User\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserListener
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function prePersist(User $user): void
    {
        $this->hashPassword($user);
    }

    public function preUpdate(User $user): void
    {
        $this->hashPassword($user);
    }

    private function hashPassword(User $user): void
    {
        $password = $user->getPassword();
        $hashed = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashed);
    }
}