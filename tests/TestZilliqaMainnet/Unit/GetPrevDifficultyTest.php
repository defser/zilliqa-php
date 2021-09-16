<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetPrevDifficultyTest extends TestZilliqaClient
{
    public function testMainNetGetPrevDifficulty() {
        $prevDifficulty = $this->web3->GetPrevDifficulty();
        $this->assertIsNumeric($prevDifficulty->val());
        $this->assertTrue((int) $prevDifficulty->val() >= 10);
    }
}