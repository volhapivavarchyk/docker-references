<?php

declare(strict_types=1);

namespace App\Repository\Shard;

class ContactDataRepository extends ShardRepository
{
    protected const DB_ALIAS = 'cd';
    protected const DB_NAME = 'ContactData';
    protected const DB_CONNECTION = 'proton_mail_shard';
}