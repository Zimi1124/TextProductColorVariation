<?php

declare(strict_types=1);

namespace App\Entity;

use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductInterface ;

class Product extends BaseProduct implements ProductInterface
{


    protected ?string $color;

    public function getColor(): ?string
    {
        $color = $this->color;
        if ($color !== null) {
            $color = ucfirst(strtolower($color));
        }
        return $color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }
}
