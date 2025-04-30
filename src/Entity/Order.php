<?php

namespace App\Entity;

use App\Enum\DeliveryType;
use App\Enum\OrderStatus;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: 'string', length: 20)]
    private string $phone;

    #[ORM\Column(type: 'string', length: 20)]
    private DeliveryType $deliveryType;

    #[ORM\Column(type: 'string', length: 30)]
    private OrderStatus $status;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $createdAt;
}