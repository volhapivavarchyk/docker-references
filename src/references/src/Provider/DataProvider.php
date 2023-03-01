<?php

declare(strict_types=1);

namespace App\Provider;

use App\Entity\Global\BlobStorage;
use App\Entity\Global\SentAttachment;
use App\Entity\Global\SentMessage;
use App\Entity\Shard\Attachment;
use App\Entity\Shard\ContactData;
use App\Entity\Shard\MessageData;
use App\Entity\Shard\OutsideAttachment;
use App\Helper\ArrayHelper;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class DataProvider
{
    private ObjectRepository $blobStorageRepository;
    private ObjectRepository $attachmentRepository;
    private ObjectRepository $contactDataRepository;
    private ObjectRepository $messageDataRepository;
    private ObjectRepository $outsideAttachmentRepository;
    private ObjectRepository $sentAttachmentRepository;
    private ObjectRepository $sentMessageRepository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->blobStorageRepository       = $doctrine->getRepository(BlobStorage::class, 'proton_mail_global');
        $this->sentAttachmentRepository    = $doctrine->getRepository(SentAttachment::class, 'proton_mail_global');
        $this->sentMessageRepository       = $doctrine->getRepository(SentMessage::class, 'proton_mail_global');
        $this->attachmentRepository        = $doctrine->getRepository(Attachment::class, 'proton_mail_shard');
        $this->contactDataRepository       = $doctrine->getRepository(ContactData::class, 'proton_mail_shard');
        $this->messageDataRepository       = $doctrine->getRepository(MessageData::class, 'proton_mail_shard');
        $this->outsideAttachmentRepository = $doctrine->getRepository(OutsideAttachment::class, 'proton_mail_shard');
    }
    public function getNumReferences(): array
    {
        $refSentAttachment    = $this->sentAttachmentRepository->getBlobReferences();
        $refSentMessage       = $this->sentMessageRepository->getBlobReferences();
        $refAttachment        = $this->attachmentRepository->getBlobReferences();
        $refContactData       = $this->contactDataRepository->getBlobReferences();
        $refMessageData       = $this->messageDataRepository->getBlobReferences();
        $refOutsideAttachment = $this->outsideAttachmentRepository->getBlobReferences();

        $actualNumReferences = ArrayHelper::sumArrayValues([
            $refSentAttachment,
            $refSentMessage,
            $refAttachment,
            $refContactData,
            $refMessageData,
            $refOutsideAttachment,
        ]);

        $numReferences = $this->blobStorageRepository->getNumReferences(array_keys($actualNumReferences));

        return [
            $actualNumReferences,
            $this->toSimpleArray($numReferences),
        ];
    }

    private function toSimpleArray(array $numReferences): array
    {
        $numReferencesToSimpleArray = [];
        array_walk(
            $numReferences,
            function ($elem) use (&$numReferencesToSimpleArray) {
                $numReferencesToSimpleArray[$elem['id']] = $elem['num'];
            }
        );

        return $numReferencesToSimpleArray;
    }
}