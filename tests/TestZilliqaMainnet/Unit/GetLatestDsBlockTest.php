<?php
namespace TestZilliqaMainnet\Unit;

use DateTime;
use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetLatestDsBlockTest extends TestZilliqaClient
{
    public function testMainNetGetLatestDsBlockTest() {
        $DsBlock = $this->web3->GetLatestDsBlock(new ZilliqaString(''));
        $this->assertIsString($DsBlock->signature->val());
        $this->assertEquals(128, strlen($DsBlock->signature->val()));
        $this->assertSame(DateTime::class, get_class($DsBlock->header->Timestamp->val()));
        $this->assertIsString($DsBlock->header->PrevHash->val());
        $this->assertIsString($DsBlock->header->PoWWinners[0]->val());
        $this->assertIsString($DsBlock->header->LeaderPubKey->val());
        $this->assertGreaterThanOrEqual(50000, $DsBlock->header->GasPrice->val());
        $this->assertGreaterThanOrEqual(1, $DsBlock->header->DifficultyDS->val());
        $this->assertGreaterThanOrEqual(1, $DsBlock->header->Difficulty->val());
        $this->assertGreaterThanOrEqual('14553', $DsBlock->header->BlockNum->val());

        $this->assertIsArray($DsBlock->header->PoWWinners);
        $this->assertIsArray($DsBlock->toArray());
        $this->assertArrayHasKey('header', $DsBlock->toArray());
        $this->assertArrayHasKey('signature', $DsBlock->toArray());
    }
}