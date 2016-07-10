<?php

require('vendor/autoload.php');

/**
 * Created by PhpStorm.
 * User: jacektrefon
 * Date: 10/07/2016
 * Time: 18:43
 */
class ServerTest extends PHPUnit_Framework_TestCase
{

    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:1337'
        ]);
    }

    public function testGet_ValidInput_BookObject()
    {
        $response = $this->client->get('/#q=test');

        $this->assertEquals(200, $response->getStatusCode());
    }

    }