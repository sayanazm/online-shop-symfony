<?php

namespace App\Product\Message;

class ProductMessage
{
    public function __construct(
        public int $id,
        public string $name,
        public array $measurements,
        public ?string $description,
        public int $cost,
        public int $tax,
        public int $version
    ) {}
}