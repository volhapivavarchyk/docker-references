<?php

declare(strict_types=1);

namespace App\Repository\Shard;

use App\Helper\ArrayHelper;
use Doctrine\ORM\EntityRepository;

class MessageDataRepository extends EntityRepository
{
    protected const DB_ALIAS = 'sm';
    protected const DB_NAME = 'MessageData';
    protected const DB_CONNECTION = 'proton_mail_shard';

    public function getBlobReferences(): array
    {
        return ArrayHelper::sumArrayValues([
            $this->getHeaderBlobReferences(),
            $this->getBodyBlobReferences(),
        ]);
    }

    private function getHeaderBlobReferences(): array
    {
        return $this->_em
            ->getConnection()
            ->createQueryBuilder()
            ->from(self::DB_CONNECTION.'.'.self::DB_NAME,self::DB_ALIAS)
            ->select(self::DB_ALIAS.'.Header as id, count('.self::DB_ALIAS.'.Header) as count')
            ->groupBy(self::DB_ALIAS.'.Header')
            ->executeQuery()
            ->fetchAllKeyValue();
    }
    private function getBodyBlobReferences(): array
    {
        return $this->_em
            ->getConnection()
            ->createQueryBuilder()
            ->from(self::DB_CONNECTION.'.'.self::DB_NAME,self::DB_ALIAS)
            ->select(self::DB_ALIAS.'.Body as id, count('.self::DB_ALIAS.'.Body) as count')
            ->groupBy(self::DB_ALIAS.'.Body')
            ->executeQuery()
            ->fetchAllKeyValue();
    }
}