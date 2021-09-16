<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetMinimumGasPriceTest extends TestZilliqaClient
{
    public function testMainNetGetMinimumGasPrice() {
        $minimumGasPrice = $this->web3->GetMinimumGasPrice();
        $this->assertIsNumeric($minimumGasPrice->val());
        $this->assertTrue((int) $minimumGasPrice->val() >= 1000000000);
    }
}