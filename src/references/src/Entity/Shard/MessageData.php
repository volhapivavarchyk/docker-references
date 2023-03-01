<?php

declare(strict_types=1);

namespace App\Entity\Shard;

use App\Entity\Global\BlobStorage;
use App\Repository\Shard\MessageDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: MessageDataRepository::class)]
class MessageData
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name:"MessageID", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER)]
    private int $userID;

    #[ORM\Column(type: Types::INTEGER)]
    private int $version = 1;

    #[ORM\Column(type: Types::INTEGER)]
    private int $contentType = 1;

    #[ManyToOne(targetEntity: BlobStorage::class)]
    #[JoinColumn(name: 'Body', referencedColumnName: 'BlobStorageID')]
    private BlobStorage $body;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private ?string $keyPackets = null;

    #[ManyToOne(targetEntity: BlobStorage::class)]
    #[JoinColumn(name: 'Header', referencedColumnName: 'BlobStorageID')]
    private BlobStorage $header;

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
     * @return int
     */
    public function getContentType(): int
    {
        return $this->contentType;
    }

    /**
     * @param int $contentType
     */
    public function setContentType(int $contentType): void
    {
        $this->contentType = $contentType;
    }

    /**
     * @return BlobStorage
     */
    public function getBody(): BlobStorage
    {
        return $this->body;
    }

    /**
     * @param BlobStorage $body
     */
    public function setBody(BlobStorage $body): void
    {
        $this->body = $body;
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
     * @return BlobStorage
     */
    public function getHeader(): BlobStorage
    {
        return $this->header;
    }

    /**
     * @param BlobStorage $header
     */
    public function setHeader(BlobStorage $header): void
    {
        $this->header = $header;
    }
}