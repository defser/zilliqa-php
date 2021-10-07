<?php

namespace TestZilliqaStatic\Unit;

use Zilliqa\DataType\TransactionCreated;
use Zilliqa\DataType\ZilliqaHash;
use Zilliqa\DataType\ZilliqaString;
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
            [
                new ZilliqaTx('0xe1a299df003ee10fd2c08831515bf17db6b90cf579dfc89f8b9eee21e9e09c27'),
                new ZilliqaTx('0xa7cf93d0c1758978fd3ed1c68c9c1eb0e52baf0e98add47d075227a7cd0a5007'),
            ],
            Zilliqa::valueArray($values, 'ZilliqaTx')
        );
    }

    public function testTransactionCreated()
    {
        $transactionCreated = new TransactionCreated(
            new ZilliqaString('Non-contract txn, sent to shard'),
            new ZilliqaHash('2d1eea871d8845472e98dbe9b7a7d788fbcce226f52e4216612592167b89042c')
        );

        $this->assertSame('Non-contract txn, sent to shard', $transactionCreated->toArray()['Info']);
        $this->assertSame('2d1eea871d8845472e98dbe9b7a7d788fbcce226f52e4216612592167b89042c', $transactionCreated->toArray()['TranID']);

        $this->assertEquals(
            [
                'Info' => 'ZilliqaString',
                'TranID' => 'ZilliqaHash',
            ],
            $transactionCreated->getTypeArray()
        );
    }
}
