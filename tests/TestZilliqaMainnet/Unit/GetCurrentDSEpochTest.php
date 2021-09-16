<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetCurrentDSEpochTest extends TestZilliqaClient
{
    public function testMainNetGetCurrentDSEpoch() {
        $DSEpoch = $this->web3->GetCurrentDSEpoch();
        $this->assertIsNumeric($DSEpoch->val());
        $this->assertTrue($DSEpoch->val() >= 14360);
    }
}