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
    public function testMainNetTx() {
        // @see https://viewblock.io/zilliqa/address/zil1qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq9yf6pz
        $mainNetTx = new ZilliqaBech32('zil1l4khjax278mae63ywsv3l4uj8gg4fsxh34nnzh');
        $balance = $this->web3->GetBalance($mainNetTx);
        $this->assertSame(100000000.0, ZilliqaStatic::convertCurrency($balance->balance));
    }
}



