<?php
namespace TestZilliqaMainnet\Unit;

use DateTime;
use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetTxBlockTest extends TestZilliqaClient
{
    public function testMainNetGetTxBlockTest() {
        $TxBlockNumber = new ZilliqaString('1002353');
        $TxBlock = $this->web3->GetTxBlock($TxBlockNumber);
        $this->assertIsString($TxBlock->body->BlockHash->val());
        $this->assertIsString($TxBlock->body->HeaderSign->val());
        $this->assertEquals(128, strlen($TxBlock->body->HeaderSign->val()));
        $this->assertIsArray($TxBlock->body->MicroBlockInfos);
        $this->assertIsString($TxBlock->body->MicroBlockInfos[0]->MicroBlockHash->val());
        $this->assertIsInt($TxBlock->body->MicroBlockInfos[0]->MicroBlockShardId->val());
        $this->assertIsString($TxBlock->body->MicroBlockInfos[0]->MicroBlockTxnRootHash->val());
        $this->assertEquals(1002353, $TxBlock->header->BlockNum->val());
        $this->assertEquals(10024, $TxBlock->header->DSBlockNum->val());
        $this->assertIsNumeric($TxBlock->header->GasLimit->val());
        $this->assertIsNumeric($TxBlock->header->GasUsed->val());
        $this->assertIsString($TxBlock->header->MbInfoHash->val());
        $this->assertIsString($TxBlock->header->MinerPubKey->val());
        $this->assertIsInt($TxBlock->header->NumMicroBlocks->val());
        $this->assertIsInt($TxBlock->header->NumPages->val());
        $this->assertIsInt($TxBlock->header->NumTxns->val());
        $this->assertIsString($TxBlock->header->PrevBlockHash->val());
        $this->assertIsString($TxBlock->header->Rewards->val());
        $this->assertIsString($TxBlock->header->StateDeltaHash->val());
        $this->assertIsString($TxBlock->header->StateRootHash->val());
        $this->assertSame(DateTime::class, get_class($TxBlock->header->Timestamp->val()));
        $this->assertIsNumeric($TxBlock->header->TxnFees->val());
        $this->assertIsInt($TxBlock->header->Version->val());

        $this->assertIsArray($TxBlock->header->toArray());
        $this->assertIsArray($TxBlock->body->toArray());
    }
}