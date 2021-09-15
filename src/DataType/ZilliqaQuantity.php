<?php

namespace Zilliqa\DataType;

class ZilliqaQuantity extends ZilliqaData
{
    protected $value;

    public function validate(string $val): string
    {
        //TODO
        return $val;
    }

    public function val()
    {
        return $this->value;
    }
}
