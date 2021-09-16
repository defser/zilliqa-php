<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNumTxBlocksTest extends TestZilliqaClient
{
    public function testMainNetGetNumTxBlocks() {
        $numTxBlocks = $this->web3->GetNumTxBlocks();
        $this->assertIsNumeric($numTxBlocks->val());
        $this->assertTrue((int) $numTxBlocks->val() >= 1436079);
    }
}



