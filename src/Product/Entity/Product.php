<?php

namespace App\Product\Entity;
use App\Product\Doctrine\Measurements;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[ORM\Column(type: Types::FLOAT)]
    private float $price;

    #[ORM\Column(type: Types::JSON)]
    private array $measurements;

    #[ORM\Column(type: Types::INTEGER)]
    private int $version;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description;

    public function __construct(
        string $name,
        float $price,
        array $measurements,
        int $version,
        ?string $description = null,
    ) {
        $this->name = $name;
        $this->measurements = $measurements;
        $this->price = $price;
        $this->version = $version;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getMeasurements(): array
    {
        return $this->measurements;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getVersion(): int
    {
        return $this->version;
    }
}
