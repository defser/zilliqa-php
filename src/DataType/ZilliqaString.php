<?php

namespace Zilliqa\DataType;

class ZilliqaString extends ZilliqaData
{
    protected $value;

    public function validate(string $val): string
    {
        return $val;
    }

    public function val(): string
    {
        return $this->value;
    }
}
