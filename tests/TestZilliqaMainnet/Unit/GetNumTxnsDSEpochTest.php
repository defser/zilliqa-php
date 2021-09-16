<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNumTxnsDSEpochTest extends TestZilliqaClient
{
    public function testMainNetGetNumTxnsDSEpoch() {
        $numTxnsDSEpoch = $this->web3->GetNumTxnsDSEpoch();
        $this->assertIsNumeric($numTxnsDSEpoch->val());
        $this->assertTrue((int) $numTxnsDSEpoch->val() >= 100);
    }
}