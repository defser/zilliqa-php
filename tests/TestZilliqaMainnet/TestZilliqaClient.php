<?php
/**
 * @file
 *  %Zilliqa Testing
 *
 * It allows testing against Zilliqa API via JsonRPC.
 *
 */

namespace TestZilliqaMainnet;

use Exception;
use Zilliqa\Zilliqa;
use TestZilliqaStatic\TestStatic;

/**
 * @defgroup zilliqaTests ZilliqaClientTest
 * @ingroup tests
 *
 * Testing via JsonRPC against %Zilliqa API.
 */

/**
 * Abstract base class for Tests
 *
 * @ingroup zilliqaTests
 *
 */
abstract class TestZilliqaClient extends TestStatic
{
    /**
     * @var Zilliqa
     */
    protected $web3;

    /**
     * %Zilliqa Test Base class
     *
     * @throws Exception
     *    If SERVER_URL are not defined env vars in phpunit.xml.
     */
    public static function setUpBeforeClass(): void
    {
        $serverUrl = getenv("SERVER_URL");
        if ($serverUrl) {
            if (!defined('SERVER_URL')) {
                define('SERVER_URL', $serverUrl);
            }
        } else {
            throw new Exception(
                'SERVER_URL must be defined in phpunit.xml or as ENV variable.'
            );
        }

        if (substr(SERVER_URL, 0, 4) !== 'http') {
            throw new Exception(
                'SERVER_URL must start with http or https. SERVER_URL started with ' . substr(SERVER_URL, 0, 12) . '...'
            );
        }
    }

    /**
     * Create Zilliqa instance.
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->web3 = new Zilliqa(SERVER_URL);
    }
}
