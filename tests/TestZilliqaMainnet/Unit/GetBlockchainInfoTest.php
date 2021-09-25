<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetBlockchainInfoTest extends TestZilliqaClient
{
    public function testMainNetGetBlockchainInfo() {
        $emptyString = new ZilliqaString('');
        $blockchainInfo = $this->web3->GetBlockchainInfo($emptyString);
        $this->assertGreaterThanOrEqual(14516, $blockchainInfo->CurrentDSEpoch->val());
        $this->assertGreaterThanOrEqual(1451512, $blockchainInfo->CurrentMiniEpoch->val());
        $this->assertIsString($blockchainInfo->DSBlockRate->val());
        $this->assertGreaterThanOrEqual(14516, $blockchainInfo->NumDSBlocks->val());
        $this->assertGreaterThanOrEqual(1000, $blockchainInfo->NumPeers->val());
        $this->assertGreaterThanOrEqual(24979221, $blockchainInfo->NumTransactions->val());
        $this->assertGreaterThanOrEqual(1451512, $blockchainInfo->NumTxBlocks->val());
        $this->assertGreaterThanOrEqual(100, $blockchainInfo->NumTxnsDSEpoch->val());
        $this->assertGreaterThanOrEqual(0, $blockchainInfo->NumTxnsTxEpoch->val());
        $this->assertGreaterThanOrEqual(10, $blockchainInfo->ShardingStructure[0]->NumPeers[0]->val());
        $this->assertGreaterThanOrEqual(0, $blockchainInfo->TransactionRate->val());
        $this->assertGreaterThanOrEqual(0, $blockchainInfo->TxBlockRate->val());

        $this->assertIsArray($blockchainInfo->toArray());
        $this->assertArrayHasKey('ShardingStructure', $blockchainInfo->toArray());
        $this->assertArrayHasKey('CurrentDSEpoch', $blockchainInfo->toArray());
        $this->assertArrayHasKey('DSBlockRate', $blockchainInfo->toArray());
        $this->assertArrayHasKey('NumDSBlocks', $blockchainInfo->toArray());
        $this->assertIsArray($blockchainInfo->ShardingStructure[0]->toArray());
        $this->assertArrayHasKey('NumPeers', $blockchainInfo->ShardingStructure[0]->toArray());
    }
}