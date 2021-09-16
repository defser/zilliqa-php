<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetTransactionRateTest extends TestZilliqaClient
{
    public function testMainNetGetTransactionRate() {
        $transactionRate = $this->web3->GetTransactionRate();
        $this->assertIsNumeric($transactionRate->val());
        $this->assertTrue((float) $transactionRate->val() >= 0.1);
    }
}