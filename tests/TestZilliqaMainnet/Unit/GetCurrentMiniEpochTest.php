<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetCurrentMiniEpochTest extends TestZilliqaClient
{
    public function testMainNetGetCurrentMiniEpoch() {
        $miniEpoch = $this->web3->GetCurrentMiniEpoch();
        var_dump($miniEpoch->val());
        $this->assertIsNumeric($miniEpoch->val());
        $this->assertTrue($miniEpoch->val() >= 1435994);
    }
}



