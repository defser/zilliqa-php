<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetRecentTransactionsTest extends TestZilliqaClient
{
    public function testMainNetGetRecentTransactions() {
        $recentTransactions = $this->web3->GetRecentTransactions(new ZilliqaString(''));
        $this->assertIsNumeric($recentTransactions->number->val());
        $this->assertIsString($recentTransactions->TxnHashes[0]->val());
        $this->assertIsArray($recentTransactions->toArray());
        $this->assertArrayHasKey('TxnHashes', $recentTransactions->toArray());
        $this->assertArrayHasKey('number', $recentTransactions->toArray());
    }
}