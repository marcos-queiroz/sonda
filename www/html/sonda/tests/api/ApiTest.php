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
}
