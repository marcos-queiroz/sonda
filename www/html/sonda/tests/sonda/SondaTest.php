<?php

use CodeIgniter\Test\CIUnitTestCase;

class SondaTest extends CIUnitTestCase
{   

    public function setUp(): void
    {
        parent::setUp();
    }
    
    public function testStart()
    {       
        $this->assertEquals('D', 'D');
    }
}
