<?php

namespace Zilliqa\DataType;

use InvalidArgumentException;

class ZilliqaBoolean extends ZilliqaData
{
    protected $value;

    public function validate(bool $val): bool
    {
        return $val;
    }

    public function val(): bool
    {
        return $this->value;
    }
}
