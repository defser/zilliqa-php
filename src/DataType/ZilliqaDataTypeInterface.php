<?php
/**
 * @file
 * Zilliqa data type API.
 *
 * @ingroup interfaces
 */

namespace Zilliqa\DataType;

interface ZilliqaDataTypeInterface
{
    public static function isPrimitive(): bool;

    public function toArray(): array;
}
