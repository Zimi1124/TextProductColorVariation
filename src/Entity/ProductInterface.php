<?php

declare(strict_types=1);

namespace App\Entity;

interface ProductInterface
{
    public const COLOR_RED = 'red';
    public const COLOR_GREEN = 'green';
    public const COLOR_BLUE = 'blue';
    public const COLOR_YELLOW = 'yellow';
    public const COLOR_PURPLE = 'purple';

    public function getColor(): ?string;

    public function setColor(?string $color): void;
}
