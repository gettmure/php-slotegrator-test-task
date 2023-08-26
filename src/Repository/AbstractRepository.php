<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractRepository extends EntityRepository
{
    protected function getRootAlias(QueryBuilder $qb): string {
        return $qb->getRootAliases()[0];
    }

    protected function flushOne(object $object): void {
        $em = $this->getEntityManager();

        $em->persist($object);
        $em->flush();
    }

    protected function newQueryBuilder(): QueryBuilder {
        return $this->createQueryBuilder('q');
    }
}
