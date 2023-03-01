<?php

declare(strict_types=1);

namespace App\Entity\Shard;

use App\Entity\Global\BlobStorage;
use App\Repository\Shard\OutsideAttachmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: OutsideAttachmentRepository::class)]
class OutsideAttachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: "AttachmentID", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER)]
    private int $messageID = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $userID;

    #[ORM\Column(type: Types::INTEGER)]
    private int $version = 1;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $fileName;

    #[ORM\Column(name: "MIMEType", type: Types::STRING, length: 255)]
    private string $mimeType;

    #[ORM\Column(type: Types::INTEGER)]
    private int $fileSize;

    #[ManyToOne(targetEntity: BlobStorage::class)]
    #[JoinColumn(name: 'BlobStorageID', referencedColumnName: 'BlobStorageID')]
    private BlobStorage|null $blobStorage = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private ?string $keyPackets = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private ?string $signature = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $header = null;

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
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
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
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     */
    public function setFileSize(int $fileSize): void
    {
        $this->fileSize = $fileSize;
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

    /**
     * @return string|null
     */
    public function getKeyPackets(): ?string
    {
        return $this->keyPackets;
    }

    /**
     * @param string|null $keyPackets
     */
    public function setKeyPackets(?string $keyPackets): void
    {
        $this->keyPackets = $keyPackets;
    }

    /**
     * @return string|null
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @param string|null $signature
     */
    public function setSignature(?string $signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @return string|null
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * @param string|null $header
     */
    public function setHeader(?string $header): void
    {
        $this->header = $header;
    }
}
