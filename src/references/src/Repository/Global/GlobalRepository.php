<?php

declare(strict_types=1);

namespace App\Repository\Global;

use Doctrine\ORM\EntityRepository;

class GlobalRepository extends EntityRepository
{
    protected const DB_ALIAS = '';
    protected const DB_NAME = '';
    protected const DB_CONNECTION = '';

    public function getBlobReferences(): array
    {
        return $this->_em
            ->getConnection(self::DB_CONNECTION)
            ->createQueryBuilder()
            ->from(static::DB_NAME,static::DB_ALIAS)
            ->select('bs.BlobStorageID as id, count('.static::DB_ALIAS.'.BlobStorageID) as count')
            ->innerJoin(static::DB_ALIAS, 'BlobStorage', 'bs', static::DB_ALIAS.'.BlobStorageID = bs.BlobStorageID')
            ->groupBy(static::DB_ALIAS.'.BlobStorageID')
            ->executeQuery()
            ->fetchAllKeyValue();
    }
}