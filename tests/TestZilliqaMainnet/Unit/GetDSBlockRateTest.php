<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetDSBlockRateTest extends TestZilliqaClient
{
    public function testMainNetGetDSBlockRate() {
        $DSBlockRate = $this->web3->GetDSBlockRate(new ZilliqaString(''));
        $this->assertIsNumeric($DSBlockRate->val());
        $this->assertGreaterThanOrEqual(0, $DSBlockRate->val());
    }
}