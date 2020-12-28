<?php

use CodeIgniter\Test\CIUnitTestCase;

use App\Controllers\Sonda;
class SondaTest extends CIUnitTestCase
{   
    protected $sonda;

    public function setUp(): void
    {
        parent::setUp();

        $this->sonda = new Sonda;
    }
    
    public function testStart()
    {
        $this->sonda->start();

        $this->assertEquals('D', 'D');
    }

}
