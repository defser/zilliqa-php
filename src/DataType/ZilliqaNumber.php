<?php

namespace Zilliqa\DataType;

use InvalidArgumentException;

class ZilliqaNumber extends ZilliqaData
{
    protected $value;

    public function validate(string $val): int
    {
        if (! is_numeric($val)) {
            throw new InvalidArgumentException('Value is not numeric: ' . $val);
        }

        return (int) $val;
    }

    public function val(): int
    {
        return $this->value;
    }
}
