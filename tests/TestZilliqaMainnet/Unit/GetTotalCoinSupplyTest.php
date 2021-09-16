<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetTotalCoinSupplyTest extends TestZilliqaClient
{
    public function testMainNetGetTotalCoinSupply() {
        $totalCoinSupply = $this->web3->GetTotalCoinSupply();
        $this->assertIsNumeric($totalCoinSupply->val());
        $this->assertTrue((int) $totalCoinSupply->val() >= 15000000000);
    }
}



