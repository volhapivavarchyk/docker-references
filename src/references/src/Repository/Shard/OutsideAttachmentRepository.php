<?php

declare(strict_types=1);

namespace App\Repository\Shard;

class OutsideAttachmentRepository extends ShardRepository
{
    protected const DB_ALIAS = 'oa';
    protected const DB_NAME = 'OutsideAttachment';
    protected const DB_CONNECTION = 'proton_mail_shard';
}