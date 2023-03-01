<?php

declare(strict_types=1);

namespace App\Helper;

use Doctrine\ORM\EntityRepository;

class ArrayHelper extends EntityRepository
{
    /**
     * @param array<array<mixed, int>> $arrays
     * @return array<mixed, int>
     */
    public static function sumArrayValues(array $arrays): array
    {
        $result = [];
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                $result[$key] = $result[$key] ?? $value;
            }
        }

        return $result;
    }
}