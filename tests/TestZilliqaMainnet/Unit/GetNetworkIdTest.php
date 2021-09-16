<?php
namespace TestZilliqaMainnet\Unit;

use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class GetNetworkIdTest extends TestZilliqaClient
{
    public function testMainNetGetNetworkId() {
        $networkId = $this->web3->GetNetworkId();
        $this->assertIsNumeric($networkId->val());
        $this->assertTrue($networkId->val() === "1");
    }
}