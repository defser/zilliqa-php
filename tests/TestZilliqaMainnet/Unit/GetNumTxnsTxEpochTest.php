<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNumTxnsTxEpochTest extends TestZilliqaClient
{
    public function testMainNetGetNumTxnsTxEpoch() {
        $numTxnsTxEpochTest = $this->web3->GetNumTxnsTxEpoch();
        $this->assertIsNumeric($numTxnsTxEpochTest->val());
    }
}