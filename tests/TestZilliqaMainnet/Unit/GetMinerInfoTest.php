<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;
use Zilliqa\DataType\ZilliqaString;

/**
 *
 * @ingroup zilliqaTests
 */
class GetMinerInfoTest extends TestZilliqaClient
{
    public function testGetMinerInfo() {
        $minerInfo = $this->web3->GetMinerInfo(new ZilliqaString('5500'));
        $this->assertIsString($minerInfo->dscommittee[0]->val());
        $this->assertIsString($minerInfo->shards[0]->nodes[0]->val());
        $this->assertIsNumeric($minerInfo->shards[0]->size->val());

        $this->assertIsArray($minerInfo->toArray());
        $this->assertArrayHasKey('dscommittee', $minerInfo->toArray());
        $this->assertArrayHasKey('shards', $minerInfo->toArray());
    }
}