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
        $result = $this->sonda->start();

        $this->assertEquals('D', $result['face']);
        $this->assertEquals(0, $result['coordinateX']);
        $this->assertEquals(0, $result['coordinateY']);
    }

    public function testCommand()
    {
        $this->sonda->start();

        $commands = array(
            'GE', 'M', 'M', 'M', 'GD', 'M', 'M'
        );

        $result = $this->sonda->command($commands);

        $this->assertEquals(TRUE, $result['status']);
        $this->assertEquals(2, $result['position']['x']);
        $this->assertEquals(3, $result['position']['y']);
    }

    public function testMove()
    {
        $this->sonda->start();

        $result = $this->sonda->move();

        $this->assertEquals(TRUE, $result['status']);
        $this->assertEquals('D', $result['face']);
        $this->assertEquals(1, $result['x']);
        $this->assertEquals(0, $result['y']);
    }

    public function testTurnLeft()
    {
        $this->sonda->start();

        $result = $this->sonda->turnLeft();

        $this->assertEquals(TRUE, $result['status']);
        $this->assertEquals('C', $result['face']);
        $this->assertEquals(0, $result['x']);
        $this->assertEquals(0, $result['y']);
    }

    public function testTurnRight()
    {
        $this->sonda->start();

        $result = $this->sonda->turnRight();

        $this->assertEquals(TRUE, $result['status']);
        $this->assertEquals('B', $result['face']);
        $this->assertEquals(0, $result['x']);
        $this->assertEquals(0, $result['y']);
    }

}
