<?php

namespace TestZilliqaStatic\Unit;

use Zilliqa\DataType\ZilliqaTx;
use Zilliqa\Zilliqa;
use TestZilliqaStatic\TestStatic;

/**
 * ZilliqaStaticTest
 *
 * @ingroup staticTests
 */
class ZilliqaStaticTest extends TestStatic
{
    public function testValueArray()
    {
        $values = [
            '0xe1a299df003ee10fd2c08831515bf17db6b90cf579dfc89f8b9eee21e9e09c27',
            '0xa7cf93d0c1758978fd3ed1c68c9c1eb0e52baf0e98add47d075227a7cd0a5007'
        ];

        $this->assertEquals(
            Zilliqa::valueArray($values, 'ZilliqaTx'),
            [
                new ZilliqaTx('0xe1a299df003ee10fd2c08831515bf17db6b90cf579dfc89f8b9eee21e9e09c27'),
                new ZilliqaTx('0xa7cf93d0c1758978fd3ed1c68c9c1eb0e52baf0e98add47d075227a7cd0a5007'),
            ]
        );
    }
}
