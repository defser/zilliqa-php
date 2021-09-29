<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaHash;

/**
 *
 * @ingroup zilliqaTests
 */
class GetTransactionTest extends TestZilliqaClient
{
    public function testMainNetGetTransaction() {
        $transactionHash = new ZilliqaHash('cd8727674bc05e0ede405597a218164e1c13c7103b9d0ba43586785f3d8cede5');
        $transaction = $this->web3->GetTransaction($transactionHash);

        $this->assertIsString($transaction->ID->val());
        $this->assertIsString($transaction->amount->val());

        $this->assertIsArray($transaction->toArray());
        $this->assertArrayHasKey('ID', $transaction->toArray());
        $this->assertSame('cd8727674bc05e0ede405597a218164e1c13c7103b9d0ba43586785f3d8cede5', $transaction->ID->val());
        $this->assertArrayHasKey('amount', $transaction->toArray());
        $this->assertArrayHasKey('gasLimit', $transaction->toArray());
        $this->assertArrayHasKey('gasPrice', $transaction->toArray());
        $this->assertArrayHasKey('nonce', $transaction->toArray());
        $this->assertIsArray($transaction->receipt->toArray());
        $this->assertArrayHasKey('cumulative_gas', $transaction->receipt->toArray());
        $this->assertArrayHasKey('epoch_num', $transaction->receipt->toArray());
        $this->assertSame(589763, $transaction->receipt->epoch_num->val());
        $this->assertArrayHasKey('success', $transaction->receipt->toArray());
        $this->assertSame(true, $transaction->receipt->success->val());
    }

    public function testMainNetGetContractDeploymentTransaction() {
        $transactionHash = new ZilliqaHash('f9170f9661a2ec5a90e6701618ba38d76257c00a1e5848d8f541e1ef52d11ede');
        $transaction = $this->web3->GetTransaction($transactionHash);

        $this->assertIsString($transaction->ID->val());
        $this->assertIsString($transaction->amount->val());

        $this->assertIsArray($transaction->toArray());
        $this->assertArrayHasKey('ID', $transaction->toArray());
        $this->assertSame('f9170f9661a2ec5a90e6701618ba38d76257c00a1e5848d8f541e1ef52d11ede', $transaction->ID->val());
        $this->assertArrayHasKey('code', $transaction->toArray());
        $this->assertArrayHasKey('data', $transaction->toArray());
    }

    public function testMainNetGetContractCallTransaction() {
        $transactionHash = new ZilliqaHash('52605cee6955b3d14f5478927a90977b305325aff4ae0a2f9dbde758e7b92ad4');
        $transaction = $this->web3->GetTransaction($transactionHash);

        $this->assertIsString($transaction->ID->val());
        $this->assertIsString($transaction->amount->val());

        $this->assertIsArray($transaction->toArray());
        $this->assertArrayHasKey('ID', $transaction->toArray());
        $this->assertSame('52605cee6955b3d14f5478927a90977b305325aff4ae0a2f9dbde758e7b92ad4', $transaction->ID->val());
        $this->assertArrayHasKey('data', $transaction->toArray());
        $this->assertArrayHasKey('receipt', $transaction->toArray());
        $this->assertArrayHasKey('transitions', $transaction->receipt->toArray());
        $this->assertArrayHasKey('addr', $transaction->receipt->transitions[0]->toArray());
        $this->assertArrayHasKey('depth', $transaction->receipt->transitions[0]->toArray());
        $this->assertArrayHasKey('msg', $transaction->receipt->transitions[0]->toArray());
        $this->assertArrayHasKey('_amount', $transaction->receipt->transitions[0]->msg->toArray());
        $this->assertArrayHasKey('_recipient', $transaction->receipt->transitions[0]->msg->toArray());
        $this->assertArrayHasKey('_tag', $transaction->receipt->transitions[0]->msg->toArray());
        $this->assertArrayHasKey('params', $transaction->receipt->transitions[0]->msg->toArray());
    }

    public function testMainNetGetFailedTransaction() {
        $transactionHash = new ZilliqaHash('9b00b3b7d80dfb3818a6aaab0cb6fd3822b1bd7b3c6d5c6260579d12ae631a96');
        $transaction = $this->web3->GetTransaction($transactionHash);

        $this->assertIsString($transaction->ID->val());
        $this->assertIsString($transaction->amount->val());

        $this->assertIsArray($transaction->toArray());
        $this->assertArrayHasKey('ID', $transaction->toArray());
        $this->assertSame('9b00b3b7d80dfb3818a6aaab0cb6fd3822b1bd7b3c6d5c6260579d12ae631a96', $transaction->ID->val());
        $this->assertArrayHasKey('data', $transaction->toArray());
        $this->assertArrayHasKey('receipt', $transaction->toArray());
        $this->assertSame(false, $transaction->receipt->success->val());
        $this->assertArrayHasKey('line', $transaction->receipt->exceptions[0]->toArray());
        $this->assertSame(87, $transaction->receipt->exceptions[0]->line->val());
        $this->assertArrayHasKey('message', $transaction->receipt->exceptions[0]->toArray());
    }
}