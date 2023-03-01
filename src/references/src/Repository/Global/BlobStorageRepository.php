<?php

declare(strict_types=1);

namespace App\Repository\Global;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

class BlobStorageRepository extends EntityRepository
{
    protected const DB_ALIAS = 'bs';

    public function getNumReferences(array $ids = []): array
    {
        return $this
            ->createQueryBuilder(self::DB_ALIAS)
            ->select('bs.id as id, bs.numReferences as num')
            ->where('bs.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }
}