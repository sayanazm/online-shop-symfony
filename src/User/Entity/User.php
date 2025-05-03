<?php

namespace App\User\Entity;

use App\User\Doctrine\EventListener\UserListener;
use App\User\Doctrine\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\EntityListeners([UserListener::class])]
#[ORM\Table(name: '`users`')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    #[Assert\NotBlank(message: "Email is required.")]
    #[Assert\Email(message: "Please provide a valid email address.")]
    private string $email;

    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank(message: "Password is required.")]
    #[Assert\Length(min: 6, minMessage: "Password must be at least {{ limit }} characters long.")]
    private string $password;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: "Name is required.")]
    #[Assert\Length(max: 255, maxMessage: "Name must not be longer than {{ limit }} characters.")]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 20)]
    #[Assert\NotBlank(message: "Phone number is required.")]
    #[Assert\Regex(
        pattern: "/^\+?[1-9]\d{1,14}$/",
        message: "Invalid phone number format."
    )]
    private string $phone;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isModerator = false;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $phone,
        ?bool $isModerator = false
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->isModerator = $isModerator;
        $this->password = $password;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getRoles(): array
    {
        return $this->isModerator ? ['ROLE_ADMIN'] : ['ROLE_USER'];
    }

    public function setIsModerator(bool $isModerator): self
    {
        $this->isModerator = $isModerator;

        return $this;
    }

    public function getIsModerator(): array
    {
        return $this->isModerator ? ['ROLE_ADMIN'] : ['ROLE_USER'];
    }

    public function eraseCredentials(): void {}

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
