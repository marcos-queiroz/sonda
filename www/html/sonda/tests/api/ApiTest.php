<?php

use CodeIgniter\Test\CIUnitTestCase;

class ApiTest extends CIUnitTestCase
{   
    public function setUp(): void
    {
        parent::setUp();
    }
    
    public function testStart()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', base_url('api/init'));

        $this->assertEquals('201', $response->getStatusCode());
    }

    // public function testReceivesCommand()
    // {
    //     $client = \Config\Services::curlrequest();
    //     $response = $client->request('POST', base_url('api/receivesCommand'), ['json' => ['movimentos' => ["GE", "M", "M", "M", "GD", "M", "M"]]]);

    //     // $body = $response->getBody();

    //     $this->assertEquals('201', $response->getStatusCode());
    // }

    // public function testDisplaysCoordinates()
    // {
    //     $client = \Config\Services::curlrequest();
    //     $response = $client->request('GET', base_url('api/init'));

    //     // $body = $response->getBody();

    //     $this->assertEquals('201', $response->getStatusCode());
    // }
}
