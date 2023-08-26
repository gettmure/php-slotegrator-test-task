<?php

namespace App\Repository\Product;

use App\DTO\Product\ProductPatchDTO;
use App\Entity\Product\Product;
use App\Repository\AbstractRepository;
use App\Repository\Filter\Product\ProductFilter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends AbstractRepository
{
    public function __construct(EntityManagerInterface $em) {
        parent::__construct($em, new ClassMetadata(Product::class));
    }

    public function delete(int $id): void {
        $qb = $this->newQueryBuilder();
        $alias = $this->getRootAlias($qb);

        $this->newQueryBuilder()
            ->andWhere("$alias.id = :id")
            ->setParameter('id', $id)
            ->delete()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getOne(int $id): ?Product {
        $qb = $this->newQueryBuilder();
        $qb = $this->applyFilter($qb, new ProductFilter($id));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array|Product[]
     */
    public function getBy(?ProductFilter $filter = null): array {
        $qb = $this->newQueryBuilder();
        $qb = $this->applyFilter($qb, $filter);

        return $qb->getQuery()->getResult();
    }

    public function upsert(ProductPatchDTO $patch): Product {
        $product = (function () use ($patch): Product {
            if ($patch->getId() === null) {
                return new Product();
            }

            return $this->getOne($patch->getId());
        })()->patch($patch);

        $this->flushOne($product);

        return $product;
    }

    private function applyFilter(QueryBuilder $qb, ?ProductFilter $filter): QueryBuilder {
        if ($filter === null) {
            return $qb;
        }

        $alias = $this->getRootAlias($qb);
        if ($filter->id !== null) {
            $qb->andWhere("$alias.id = :id")->setParameter('id', $filter->id);
        }
        if ($filter->name !== null) {
            $qb->andWhere(
              $qb->expr()->like("$alias.name", $filter->name)
            );
        }
        if ($filter->description !== null) {
            $qb->andWhere(
                $qb->expr()->like("$alias.description", $filter->description)
            );
        }
        if ($filter->price !== null) {
            $qb->andWhere("$alias.price = :price")->setParameter('price', $filter->price);
        }

        return $qb;
    }
}
