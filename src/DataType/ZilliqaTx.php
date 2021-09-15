<?php

namespace Zilliqa\DataType;

use InvalidArgumentException;

class ZilliqaTx extends ZilliqaData
{
    protected $value;

    public function validateLength(string $val): string
    {
        if (strlen($val) <= 66) {
            $padUp = 66 - strlen($val);
            $val = $val . str_repeat('0', $padUp);
        }
        if (strlen($val) === 66) {
            return $val;
        }
        else {
            throw new InvalidArgumentException('Invalid length for hex binary: ' . $val);
        }
    }

    public function validate(string $val): string
    {
        $val = $this->ensureHexPrefix($val);

        if ($this->validateHexString($val)) {
            $val = strtolower($val);
            if (method_exists($this, 'validateLength')) {
                $val = call_user_func([$this, 'validateLength'], $val);
            }
            return $val;
        } else {
            throw new InvalidArgumentException('Can not decode hex binary: ' . $val);
        }
    }

    public function validateHexString(string $val): bool
    {
        if ($val === '0x') {
            $val = '0x0';
        }
        if (!ctype_xdigit(substr($val, 2))) {
            throw new InvalidArgumentException('A non well formed hex value encountered: ' . $val);
        }
        return true;
    }

    public function hexVal()
    {
        return $this->value;
    }

    public function val()
    {
        return substr($this->value, 2);
    }
}
