<?php

declare(strict_types=1);

namespace App\Entity\Global;

use App\Repository\Global\SentAttachmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: SentAttachmentRepository::class)]
class SentAttachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name:"SentMessageID", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $userID = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $messageID;

    #[ORM\Column(type: Types::INTEGER)]
    private int $version = 1;

    #[ORM\Column(type: Types::STRING)]
    private int $metadata;

    #[ManyToOne(targetEntity: BlobStorage::class)]
    #[JoinColumn(name: 'BlobStorageID', referencedColumnName: 'BlobStorageID')]
    private BlobStorage|null $blobStorage = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserID(): ?int
    {
        return $this->userID;
    }

    /**
     * @param int|null $userID
     */
    public function setUserID(?int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return int
     */
    public function getMessageID(): int
    {
        return $this->messageID;
    }

    /**
     * @param int $messageID
     */
    public function setMessageID(int $messageID): void
    {
        $this->messageID = $messageID;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getMetadata(): int
    {
        return $this->metadata;
    }

    /**
     * @param int $metadata
     */
    public function setMetadata(int $metadata): void
    {
        $this->metadata = $metadata;
    }

    /**
     * @return BlobStorage|null
     */
    public function getBlobStorage(): ?BlobStorage
    {
        return $this->blobStorage;
    }

    /**
     * @param BlobStorage|null $blobStorage
     */
    public function setBlobStorage(?BlobStorage $blobStorage): void
    {
        $this->blobStorage = $blobStorage;
    }
}
