<?php

declare(strict_types=1);

namespace App\Repository\Global;

class SentMessageRepository extends GlobalRepository
{
    protected const DB_ALIAS      = 'sm';
    protected const DB_NAME       = 'SentMessage';
    protected const DB_CONNECTION = 'proton_mail_global';
}