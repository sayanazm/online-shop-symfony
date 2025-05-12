<?php

namespace App\Product\Resource;

use App\Product\Entity\Product;

class ProductResource
{
    public int $id;
    public string $name;
    public float $price;
    public int $version;
    public ?string $description;
    public array $measurements;

    public function __construct(Product $product)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->description = $product->getDescription();
        $this->measurements = $product->getMeasurements();
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}