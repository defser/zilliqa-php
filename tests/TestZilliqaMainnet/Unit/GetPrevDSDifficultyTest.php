<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetPrevDSDifficultyTest extends TestZilliqaClient
{
    public function testMainNetGetPrevDSDifficulty() {
        $prevDSDifficulty = $this->web3->GetPrevDSDifficulty();
        $this->assertIsNumeric($prevDSDifficulty->val());
        $this->assertTrue((int) $prevDSDifficulty->val() >= 10);
    }
}



