<?php
namespace TestZilliqaMainnet\Unit;

use Graze\GuzzleHttp\JsonRpc\Exception\ServerException;
use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaBoolean;
use Zilliqa\DataType\ZilliqaHash;
use Zilliqa\DataType\ZilliqaNumber;
use Zilliqa\DataType\ZilliqaQuantity;
use Zilliqa\DataType\ZilliqaSignature;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class CreateTransactionTest extends TestZilliqaClient
{
    public function testMainNetCreateTransaction() {
        $version = new ZilliqaNumber(65537);
        $nonce = new ZilliqaNumber(1);
        $toAddr = new ZilliqaString('0x4BAF5faDA8e5Db92C3d3242618c5B47133AE003C');
        $amount = new ZilliqaQuantity('1000000000000');
        $hash = new ZilliqaHash('0205273e54f262f8717a687250591dcfb5755b8ce4e3bd340c7abefd0de1276574');
        $gasPrice = new ZilliqaQuantity('2000000000');
        $gasLimit = new ZilliqaQuantity('50');
        $code = new ZilliqaString('');
        $data = new ZilliqaString('');
        $signature = new ZilliqaSignature('29ad673848dcd7f5168f205f7a9fcd1e8109408e6c4d7d03e4e869317b9067e636b216a32314dd37176c35d51f9d4c24e0e519ba80e66206457c83c9029a490d');
        $priority = new ZilliqaBoolean(false);


        $this->expectException(ServerException::class);
        $this->expectExceptionMessage('Unable to verify transaction');
        $this->web3->CreateTransaction($version, $nonce, $toAddr, $amount, $hash, $gasPrice, $gasLimit, $code, $data, $signature, $priority);
    }
}