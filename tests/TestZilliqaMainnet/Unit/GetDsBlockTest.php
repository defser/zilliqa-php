<?php
namespace TestZilliqaMainnet\Unit;

use DateTime;
use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetDsBlockTest extends TestZilliqaClient
{
    public function testMainNetGetDsBlockTest() {
        $DsBlockNumber = new ZilliqaString('9000');
        $DsBlock = $this->web3->GetDsBlock($DsBlockNumber);
        $this->assertIsString($DsBlock->signature->val());
        $this->assertEquals(128, strlen($DsBlock->signature->val()));
        $this->assertSame(DateTime::class, get_class($DsBlock->header->Timestamp->val()));
        $this->assertIsString($DsBlock->header->PrevHash->val());
        $this->assertIsArray($DsBlock->header->PoWWinners);
        $this->assertIsString($DsBlock->header->PoWWinners[0]->val());
        $this->assertIsString($DsBlock->header->LeaderPubKey->val());
        $this->assertGreaterThanOrEqual(50000, $DsBlock->header->GasPrice->val());
        $this->assertGreaterThanOrEqual(1, $DsBlock->header->DifficultyDS->val());
        $this->assertGreaterThanOrEqual(1, $DsBlock->header->Difficulty->val());
        $this->assertSame(9000, $DsBlock->header->BlockNum->val());

        $this->assertIsArray($DsBlock->header->toArray());
        $this->assertIsArray($DsBlock->toArray());
        $this->assertArrayHasKey('header', $DsBlock->toArray());
        $this->assertArrayHasKey('signature', $DsBlock->toArray());
    }
}