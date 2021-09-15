<?php

namespace Zilliqa\DataType;

use Exception;
use Zilliqa\ZilliqaStatic;


/**
 * @defgroup dataTypes Data Types
 *
 * All data types in Zilliqa-PHP are derived from ZilliqaDataType.
 */

/**
 * @defgroup interfaces Interfaces
 *
 * All Interfaces.
 */

/**
 * @defgroup dataTypesPrimitive Primitive Types
 *
 * All data primitive types in Zilliqa-PHP are derived from ZilliqaData.
 *
 * @ingroup dataTypes
 */

/**
 * @defgroup dataTypesComplex Complex Types
 *
 * All data types in Zilliqa-PHP are derived from ZilliqaDataType.
 *
 * @ingroup dataTypes
 */


/**
 * Base Class for all Data types.
 *
 * @ingroup dataTypes
 *
 */
abstract class ZilliqaDataType extends ZilliqaStatic implements ZilliqaDataTypeInterface
{
    public static function isPrimitive(): bool
    {
        return false;
    }

    /**
     * @throws Exception
     */
    public function setValue(string $val)
    {
        if (method_exists($this, 'validate')) {
            $this->value = $this->validate($val);
        }
        else {
            throw new Exception('Validation of ' . __METHOD__ . ' not implemented yet.');
        }
    }

    /**
     * @throws Exception
     */
    public static function getTypeClass(string $type, bool $typed_constructor = false): string
    {
        $isArray = false;
        if (strpos($type, '[') !== false) {
            $type = str_replace(['[', ']'], '', $type);
            $isArray = true;
        }

        $primitive_type = ZilliqaData::typeMap($type);

        if ($primitive_type) {
            $type_class = $primitive_type;
        }
        else {
            // Sadly arrayOf <type> is not supported by PHP.
            if ($typed_constructor) {
                $type_class = $isArray ? 'array' : $type;
            }
            else {
                $type_class = $type;
            }
        }

        if (!$type_class) {
            throw new Exception('Could not determine type class at getTypeClass()');
        }

        return $type_class;
    }
}

