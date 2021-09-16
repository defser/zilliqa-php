<?php

namespace Zilliqa\DataType;

use InvalidArgumentException;

class ZilliqaBech32 extends ZilliqaData
{
    protected $value;

    public function validate(string $val): string
    {
        if ($this->validateBech32String($val)) {
            return strtolower($val);
        } else {
            throw new InvalidArgumentException('Can not decode hex binary: ' . $val);
        }
    }

    public function validateBech32String(string $val): bool
    {
        return preg_match('/^zil1[qpzry9x8gf2tvdw0s3jn54khce6mua7l]{38}$/', $val);
    }

    public function val(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [$this->value];
    }
}
