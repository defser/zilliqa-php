<?php
namespace TestZilliqaMainnet\Unit;

use Zilliqa\DataType\ZilliqaBech32;
use Zilliqa\ZilliqaStatic;
use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetBalanceTest extends TestZilliqaClient
{
    public function testMainNetGetBalance() {
        // @see https://viewblock.io/zilliqa/address/zil1qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq9yf6pz
        $mainNetTx = new ZilliqaBech32('zil1wyyyr29eg7qw3mys6vp86l2808vy4yl2yw389x');
        $balance = $this->web3->GetBalance($mainNetTx);
        $this->assertGreaterThan(1, ZilliqaStatic::convertCurrency($balance->balance));
        $this->assertIsArray($balance->balance->toArray());
        $this->assertIsArray($balance->toArray());
        $this->assertArrayHasKey('balance', $balance->toArray());
        $this->assertArrayHasKey('value', $balance->balance->toArray());
    }
}