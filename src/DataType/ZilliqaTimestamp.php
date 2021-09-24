<?php

namespace Zilliqa\DataType;

use DateTime;

class ZilliqaTimestamp extends ZilliqaData
{
    protected $value;

    public function validate(string $val): DateTime
    {
        return (new DateTime)->setTimestamp((int) $val);
    }

    public function val(): DateTime
    {
        return $this->value;
    }
}
