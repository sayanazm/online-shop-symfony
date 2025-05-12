<?php

namespace App\Product\Doctrine;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Embeddable]
class Measurements
{
    #[ORM\Column(type: Types::INTEGER)]
    private int $weight;
    #[ORM\Column(type: Types::INTEGER)]
    private int $width;

    #[ORM\Column(type: Types::INTEGER)]
    private int $height;

    #[ORM\Column(type: Types::INTEGER)]
    private int $length;

    public function __construct(int $weight, int $width, int $height, int $length)
    {
        $this->weight = $weight;
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    public static function fromArray(array $measurements): self
    {
        return new self(
            $measurements['weight'] ?? 0,
            $measurements['width'] ?? 0,
            $measurements['height'] ?? 0,
            $measurements['depth'] ?? 0,
        );
    }

    public function toArray(): array
    {
        return [
            'weight' => $this->weight,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
        ];
    }
}
