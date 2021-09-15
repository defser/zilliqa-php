<?php

namespace Zilliqa;

use Exception;
use Zilliqa\DataType\ZilliqaQuantity;

abstract class ZilliqaStatic
{
    public static function getDefinition(): array
    {
        $schema_path = __DIR__ . '/../resources/zilliqa-schema.json';

        return json_decode(file_get_contents($schema_path), true);
    }

    public static function hasHexPrefix(string $str): bool
    {
        return substr($str, 0, 2) === '0x';
    }

    public static function removeHexPrefix(string $str): string
    {
        if (!self::hasHexPrefix($str)) {
            return $str;
        }

        return substr($str, 2);
    }

    public static function ensureHexPrefix(string $str): string
    {
        if (self::hasHexPrefix($str)) {
            return $str;
        }

        return '0x' . $str;
    }

    /**
     * @throws Exception
     */
    public static function convertCurrency(ZilliqaQuantity $quantity, string $from = 'zil', string $to = 'qa'): float
    {
        $convertTabe = [
            'zil' => 1000000000000, // 1e12 qa
            'li' => 1000000, // 1e6 qa
            'qa' => 1,
        ];
        if (!isset($convertTabe[$from])) {
            throw new Exception('Unknown currency to convert from "' . $from . '"');
        }
        if (!isset($convertTabe[$to])) {
            throw new Exception('Unknown currency to convert to "' . $to . '"');
        }
        return $convertTabe[$to] * $quantity->val() / $convertTabe[$from];
    }
}
