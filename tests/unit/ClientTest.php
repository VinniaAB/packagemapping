<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 2016-05-19
 * Time: 15:30
 */

namespace Vinnia\PackageMapping\Tests;


use Vinnia\PackageMapping\Client;
use Vinnia\PackageMapping\SearchParameter;

class ClientTest extends AbstractTest
{

    /**
     * @var Client
     */
    public $client;

    /**
     * @var string[]
     */
    public $env;

    public function setUp()
    {
        parent::setUp();

        $this->env = require __DIR__ . '/../../env.php';
        $this->client = Client::make($this->env['web_service_key']);
    }

    public function testGetCarrierCodeList()
    {
        $res = $this->client->getCarrierCodeList($this->env['tracking_number']);
        $data = json_decode((string) $res->getBody(), true);

        codecept_debug($data);

        $this->assertTrue($data['Success']);
        $this->assertNotEmpty($data['CarrierInfo']);
    }

    public function testGetTrackList()
    {
        $res = $this->client->getTrackList([
            new SearchParameter($this->env['tracking_number']),
        ]);
        $data = json_decode((string) $res->getBody(), true);

        codecept_debug($data);

        $this->assertTrue($data['Success']);
        $this->assertNotEmpty($data['Tracks']);
    }

}
