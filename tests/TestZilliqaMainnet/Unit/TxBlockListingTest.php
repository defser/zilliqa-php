<?php
namespace TestZilliqaMainnet\Unit;

use Zilliqa\DataType\ZilliqaNumber;
use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class TxBlockListingTest extends TestZilliqaClient
{
    public function testMainNetTxBlockListing() {
        $pageNumber = new ZilliqaNumber(1);
        $TxBlockListing = $this->web3->TxBlockListing($pageNumber);
        $this->assertGreaterThanOrEqual(145861, $TxBlockListing->maxPages->val());
        $this->assertGreaterThanOrEqual(1458600, $TxBlockListing->data[0]->BlockNum->val());
        $this->assertIsString($TxBlockListing->data[0]->Hash->val());
        $this->assertEquals(64, strlen($TxBlockListing->data[0]->Hash->val()));

        $this->assertIsArray($TxBlockListing->toArray());
        $this->assertIsArray($TxBlockListing->data[0]->toArray());

        $this->assertArrayHasKey('data', $TxBlockListing->toArray());
        $this->assertArrayHasKey('maxPages', $TxBlockListing->toArray());
    }
}