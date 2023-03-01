<?php

declare(strict_types=1);

namespace App\Repository\Shard;

use Doctrine\ORM\EntityRepository;

class ShardRepository extends EntityRepository
{
    protected const DB_ALIAS = '';
    protected const DB_NAME = '';
    protected const DB_CONNECTION = '';

    public function getBlobReferences(): array
    {
        return $this->_em
            ->getConnection()
            ->createQueryBuilder()
            ->from(static::DB_CONNECTION.'.'.static::DB_NAME,static::DB_ALIAS)
            ->select(static::DB_ALIAS.'.BlobStorageID as id, count('.static::DB_ALIAS.'.BlobStorageID) as count')
            ->groupBy(static::DB_ALIAS.'.BlobStorageID')
            ->executeQuery()
            ->fetchAllKeyValue();
    }
}