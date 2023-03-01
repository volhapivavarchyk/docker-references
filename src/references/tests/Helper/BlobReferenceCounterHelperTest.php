<?php

declare(strict_types=1);

namespace App\Tests\Helper;

use App\Helper\BlobReferenceCounterHelper;
use App\Provider\DataProvider;
use Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BlobReferenceCounterHelperTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->dataProvider               = $this->createMock(DataProvider::class);
        $this->blobReferenceCounterHelper = new BlobReferenceCounterHelper($this->dataProvider);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetReferencesInconsistencies(array $input, array $expected): void
    {
        $this->dataProvider->expects($this->once())
            ->method('getNumReferences')
            ->willReturn($input);

        $result = $this->blobReferenceCounterHelper->getReferencesInconsistencies();

        Assert::assertArrayHasKey('mismatches', $result);
        Assert::assertArrayHasKey('missingBlobs', $result);
        Assert::assertArrayHasKey('orphansBlobs', $result);

        Assert::assertSame($result['mismatches'], $expected[0]);
        Assert::assertSame($result['missingBlobs'], $expected[1]);
        Assert::assertSame($result['orphansBlobs'], $expected[2]);

    }

    public function dataProvider(): Generator
    {
        yield [
            [
                0 => [
                    1 => 2,
                    2 => 2,
                    3 => 3,
                ],
                1 => [
                    1 => 1,
                    2 => 3,
                    3 => 3,
                ],
            ],
            [
                [
                    ['blobStorageID' => 1, 'numReferences' => 1, 'actualNumReferences' => 2],
                    ['blobStorageID' => 2, 'numReferences' => 3, 'actualNumReferences' => 2],
                ],
                [],
                [],
            ]
        ];

        yield [
            [
                [1 => 2,2 => 2,3 => 3,],
                [1 => 1,2 => 3,4 => 3,],
            ],
            [
                [
                    ['blobStorageID' => 1, 'numReferences' => 1, 'actualNumReferences' => 2],
                    ['blobStorageID' => 2, 'numReferences' => 3, 'actualNumReferences' => 2],
                ],
                [3=>3],
                [4=>3],
            ]
        ];
    }
}
