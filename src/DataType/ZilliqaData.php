<?php

namespace Zilliqa\DataType;

use Exception;

/**
 * Basic Zilliqa data types.
 *
 * @ingroup dataTypes
 */
class ZilliqaData extends ZilliqaDataType
{
    public static function isPrimitive(): bool
    {
        return true;
    }

    /**
     * @const SCHEMA_MAP
     *   Mapping ZilliqaJs schema types to respective PHP classes.
     * @see resources/zilliqa-schema.json
     */
    private const SCHEMA_MAP = [
        'Tx' => 'ZilliqaTx',
        'Bech32' => 'ZilliqaBech32',
        'Quantity' => 'ZilliqaQuantity',
        'Number' => 'ZilliqaNumber',
        'String' => 'ZilliqaString',
        'Boolean' => 'ZilliqaBoolean',
        'Timestamp' => 'ZilliqaTimestamp',
        'Hash' => 'ZilliqaHash',
        'Signature' => 'ZilliqaSignature'
    ];

    /**
     * @throws Exception
     */
    public function __construct(string $val)
    {
        $this->setValue($val);
    }

    public static function typeMap(string $type): ?string
    {
        return self::SCHEMA_MAP[$type] ?? null;
    }

    public static function getTypeArray(): array
    {
        return array(
          'value' => get_class(),
        );
    }

    public function toArray(): array
    {
        return array(
          'value' => $this->value,
        );
    }
}
