<?php
namespace TestZilliqaMainnet\Unit;

use Zilliqa\DataType\ZilliqaNumber;
use TestZilliqaMainnet\TestZilliqaClient;

/**
 *
 * @ingroup zilliqaTests
 */
class DSBlockListingTest extends TestZilliqaClient
{
    public function testMainNetDSBlockListing() {
        $pageNumber = new ZilliqaNumber(1);
        $DSBlockListings = $this->web3->DSBlockListing($pageNumber);
        $this->assertGreaterThanOrEqual(1452, $DSBlockListings->maxPages->val());
        $this->assertGreaterThanOrEqual(14514, $DSBlockListings->data[0]->BlockNum->val());
        $this->assertIsString($DSBlockListings->data[0]->Hash->val());
        $this->assertEquals(64, strlen($DSBlockListings->data[0]->Hash->val()));

        $this->assertIsArray($DSBlockListings->toArray());
        $this->assertIsArray($DSBlockListings->data[0]->toArray());
    }
}