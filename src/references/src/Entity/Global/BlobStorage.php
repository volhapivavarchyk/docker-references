<?php

declare(strict_types=1);

namespace App\Entity\Global;

use App\Repository\Global\BlobStorageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlobStorageRepository::class)]
#[ORM\Table(name: 'BlobStorage')]
class BlobStorage
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name:"BlobStorageID", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER)]
    private int $version = 1;

    #[ORM\Column(type: Types::INTEGER)]
    private int $type = 1;

    #[ORM\Column(name:"NumReferences", type: Types::INTEGER)]
    private int $numReferences = 1;

    #[ORM\Column(type: Types::BINARY, length: 16)]
    private int $hash;

    #[ORM\Column(type: Types::INTEGER)]
    private int $size = 0;

    #[ORM\Column(type: Types::STRING, length: 191, nullable: true)]
    private ?string $cephID = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private int $shardID = 0;


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

    /**
     * @return int
     */
    public function getNumReferences(): int
    {
        return $this->numReferences;
    }

    /**
     * @param int $numReferences
     */
    public function setNumReferences(int $numReferences): void
    {
        $this->numReferences = $numReferences;
    }

    /**
     * @return int
     */
    public function getHash(): int
    {
        return $this->hash;
    }

    /**
     * @param int $hash
     */
    public function setHash(int $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string|null
     */
    public function getCephID(): ?string
    {
        return $this->cephID;
    }

    /**
     * @param string|null $cephID
     */
    public function setCephID(?string $cephID): void
    {
        $this->cephID = $cephID;
    }

    /**
     * @return int
     */
    public function getShardID(): int
    {
        return $this->shardID;
    }

    /**
     * @param int $shardID
     */
    public function setShardID(int $shardID): void
    {
        $this->shardID = $shardID;
    }
}
