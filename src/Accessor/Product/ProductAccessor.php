<?php

namespace App\Accessor\Product;

use App\DTO\Product\ProductPatchDTO;
use App\Entity\Product\Product;
use App\Repository\Filter\Product\ProductFilter;
use App\Repository\Product\ProductRepository;
use Doctrine\ORM\NonUniqueResultException;

readonly class ProductAccessor
{
    public function __construct(private ProductRepository $repo) {}

    public function one(int $id): ?Product {
        return $this->repo->getOne($id);
    }

    /**
     * @return array|Product[]
     */
    public function list(?ProductFilter $filter = null): array {
        return $this->repo->getBy($filter);
    }

    public function upsert(ProductPatchDTO $patch): Product {
        return $this->repo->upsert($patch);
    }

    public function delete(int $id): void {
        $this->repo->delete($id);
    }
}
