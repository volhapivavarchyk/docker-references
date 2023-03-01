<?php

declare(strict_types=1);

namespace App\Tests\Provider;

use App\Provider\DataProvider;
use App\Repository\Global\BlobStorageRepository;
use App\Repository\Global\SentAttachmentRepository;
use App\Repository\Global\SentMessageRepository;
use App\Repository\Shard\AttachmentRepository;
use App\Repository\Shard\ContactDataRepository;
use App\Repository\Shard\MessageDataRepository;
use App\Repository\Shard\OutsideAttachmentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class DataProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->doctrine                    = $this->createMock(ManagerRegistry::class);

        $this->outsideAttachmentRepository = $this->createMock(ObjectRepository::class);
        $this->blobStorageRepository       = $this->createMock(BlobStorageRepository::class);
        $this->sentAttachmentRepository    = $this->createMock(SentAttachmentRepository::class);
        $this->sentMessageRepository       = $this->createMock(SentMessageRepository::class);
        $this->attachmentRepository        = $this->createMock(AttachmentRepository::class);
        $this->contactDataRepository       = $this->createMock(ContactDataRepository::class);
        $this->messageDataRepository       = $this->createMock(MessageDataRepository::class);
        $this->outsideAttachmentRepository = $this->createMock(OutsideAttachmentRepository::class);

        $this->doctrine->expects($this->exactly(7))
            ->method('getRepository')
            ->willReturnOnConsecutiveCalls(
                $this->blobStorageRepository,
                $this->sentAttachmentRepository,
                $this->sentMessageRepository,
                $this->attachmentRepository,
                $this->contactDataRepository,
                $this->messageDataRepository,
                $this->outsideAttachmentRepository
            );

        $this->dataProvider = new DataProvider($this->doctrine);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetNumReferences(array $input, array $expected): void
    {
        $this->sentAttachmentRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->sentMessageRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->attachmentRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->contactDataRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->messageDataRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->outsideAttachmentRepository->expects($this->once())
            ->method('getBlobReferences')
            ->willReturn($input[0]);
        $this->blobStorageRepository->expects($this->once())
            ->method('getNumReferences')
            ->with(array_keys($input[1]))
            ->willReturn($input[2]);

        $result = $this->dataProvider->getNumReferences();

        Assert::assertIsArray($result);
        Assert::assertSame($result, $expected);

    }

    public function dataProvider(): Generator
    {
        yield [
            [
                [1 => 1, 2 => 1, 3 => 1,],
                [1 => 6, 2 => 6, 3 => 6,],
                [0 => ['id' => 1, 'num' => 1], 1 => ['id' => 2, 'num' => 1], 2 => ['id' => 3, 'num' => 1],]
            ],
            [
                [1 => 6, 2 => 6, 3 => 6,],
                [1 => 1, 2 => 1, 3 => 1,],
            ]
        ];
    }
}
