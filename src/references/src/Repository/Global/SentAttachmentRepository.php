<?php

declare(strict_types=1);

namespace App\Repository\Global;

class SentAttachmentRepository extends GlobalRepository
{
    protected const DB_ALIAS = 'sa';
    protected const DB_NAME = 'SentAttachment';
    protected const DB_CONNECTION = 'proton_mail_global';

}