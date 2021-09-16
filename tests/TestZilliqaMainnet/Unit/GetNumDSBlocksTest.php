<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNumDSBlocksTest extends TestZilliqaClient
{
    public function testMainNetGetNumDSBlocks() {
        $numDSBlocks = $this->web3->GetNumDSBlocks();
        $this->assertIsNumeric($numDSBlocks->val());
        $this->assertTrue((int) $numDSBlocks->val() >= 14362);
    }
}



