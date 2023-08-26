<?php

namespace App\Repository\Filter\Product;

class ProductFilter
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?float $price = null,
    ) {}
}
