<?php

namespace App\Product\MessageHandler;

use App\Product\Doctrine\Measurements;
use App\Product\Entity\Product;
use App\Product\Message\ProductMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ProductMessageHandler
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(ProductMessage $message): void
    {
        $product = new Product(
            name: $message->name,
            price: $message->cost + $message->tax,
            measurements: $message->measurements,
            version: $message->version,
            description: $message->description,
        );

        $this->em->persist($product);
        $this->em->flush();

        dump('Товар добавлен в таблицу');
    }
}