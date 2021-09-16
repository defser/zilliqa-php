<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNumTransactionsTest extends TestZilliqaClient
{
    public function testMainNetGetNumTransactions() {
        $numTransactions = $this->web3->GetNumTransactions();
        $this->assertIsNumeric($numTransactions->val());
        $this->assertTrue((int) $numTransactions->val() >= 24688490);
    }
}



