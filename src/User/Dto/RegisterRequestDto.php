<?php

namespace App\User\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 20)]
    public string $phone;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $password;
}