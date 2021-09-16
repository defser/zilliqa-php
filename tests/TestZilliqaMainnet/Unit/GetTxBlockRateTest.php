<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetTxBlockRateTest extends TestZilliqaClient
{
    public function testMainNetGetTransactionRate() {
        $txBlockRate = $this->web3->GetTxBlockRate();
        $this->assertIsNumeric($txBlockRate->val());
        $this->assertTrue((float) $txBlockRate->val() >= 0.001);
    }
}