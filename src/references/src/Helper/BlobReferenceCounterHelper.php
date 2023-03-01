<?php

declare(strict_types=1);

namespace App\Helper;

use App\Provider\DataProvider;

class BlobReferenceCounterHelper
{

    private DataProvider $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function getReferencesInconsistencies(): array
    {
        list($actualNumReferences, $numReferences) = $this->dataProvider->getNumReferences();

        return [
            'mismatches'   => $this->getMismatches($actualNumReferences, $numReferences),
            'missingBlobs' => $this->getMissingBlobs($actualNumReferences, $numReferences),
            'orphansBlobs' => $this->getOrphansBlobs($actualNumReferences, $numReferences),
        ];
    }

    private function getMismatches(array $actualNumReferences, array $numReferences): array
    {
        $result = array_filter(
            $numReferences,
            fn ($value, $key) => array_key_exists($key, $actualNumReferences) && $actualNumReferences[$key] !== $value && $value !== 0,
            ARRAY_FILTER_USE_BOTH
        );

        return array_map(
            fn ($value, $key) => [
                'blobStorageID'       => $key,
                'numReferences'       => $value,
                'actualNumReferences' => $actualNumReferences[$key],
            ],
            $result,
            array_keys($result)
        );
    }

    private function getMissingBlobs(array $actualNumReferences, array $numReferences): array
    {
        $ids = array_keys($numReferences);

        return array_filter(
            $actualNumReferences,
            fn ($key) => !in_array($key, $ids),
            ARRAY_FILTER_USE_KEY
        );
    }

    private function getOrphansBlobs(array $actualNumReferences, array $numReferences): array
    {
        $ids = array_keys($actualNumReferences);

        return array_filter(
            $numReferences,
            fn ($value, $key) => !in_array($key, $ids) && $value !== 0,
            ARRAY_FILTER_USE_BOTH
        );
    }
}