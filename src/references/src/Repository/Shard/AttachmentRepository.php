<?php

declare(strict_types=1);

namespace App\Repository\Shard;

class AttachmentRepository extends ShardRepository
{
    protected const DB_ALIAS = 'a';
    protected const DB_NAME = 'Attachment';
    protected const DB_CONNECTION = 'proton_mail_shard';
}