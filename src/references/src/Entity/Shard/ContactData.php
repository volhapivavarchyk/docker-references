<?php

declare(strict_types=1);

namespace App\Entity\Shard;

use App\Entity\Global\BlobStorage;
use App\Repository\Shard\ContactDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: ContactDataRepository::class)]
class ContactData
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: "ContactDataID", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER)]
    private int $userID;

    #[ORM\Column(type: Types::INTEGER)]
    private int $contactID;

    #[ManyToOne(targetEntity: BlobStorage::class)]
    #[JoinColumn(name: 'BlobStorageID', referencedColumnName: 'BlobStorageID')]
    private BlobStorage|null $blobStorage = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private ?string $keyPackets = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $type = 1;

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
    public function getContactID(): int
    {
        return $this->contactID;
    }

    /**
     * @param int $contactID
     */
    public function setContactID(int $contactID): void
    {
        $this->contactID = $contactID;
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
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }
}
