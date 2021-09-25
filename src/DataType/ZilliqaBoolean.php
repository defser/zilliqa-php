<?php

namespace Zilliqa\DataType;

use InvalidArgumentException;

class ZilliqaBoolean extends ZilliqaData
{
    protected $value;

    public function validate(bool $val): int
    {
        if (! is_bool($val)) {
            throw new InvalidArgumentException('Value is not a boolean: ' . $val);
        }

        return (int) $val;
    }

    public function val(): int
    {
        return $this->value;
    }
}
