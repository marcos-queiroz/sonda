<?php namespace App\Controllers;
class Sonda extends BaseController
{
	private $ground = array();

	public function start() : void
	{
		for($y = 4; $y >= 0; $y--){
			for($x = 0; $x <= 4; $x++){
				$this->ground[$x][$y] = 0;
			}
		}

		$this->ground[0][0] = 1;
		
		$this->session->set([
			'ground' => $this->ground,
			'face' => "D",
			'coodX' => 0,
			'coodY' => 0
		]);
	}

	public function command($arrayCommand) : array
	{
		foreach($arrayCommand as $command){
			switch ($command) {
				case 'GD':
					$result = $this->turnRight();
					break;
				case 'GE':
					$result = $this->turnLeft();
					break;
				case 'M':
					$result = $this->move();
					break;
			}

			if(!$result['status']){
				return array(
					'status' => FALSE,
					'erro' => "Um movimento inválido foi detectado, infelizmente a sonda ainda não possui a habilidade de alcançar a posição (". $result['position'] .")"
				);
			}
		}

		return array(
			'status' => TRUE,
			'position' => array(
				'x' => $this->session->coodX,
				'y' => $this->session->coodY
			)
		);
	}

	public function move() : array
	{

		$this->ground = $this->session->ground;
		
		switch ($this->session->face) {
			case 'D':

				if(isset($this->ground[$this->session->coodX + 1][$this->session->coodY])){					
					$this->ground[$this->session->coodX + 1][$this->session->coodY] = 1;
				}else{
					return array(
						'status' => FALSE,
						'position' => 'x: '. ($this->session->coodX + 1) .', y: '. $this->session->coodY
					);
				}

				break;
			case 'B':

				if(isset($this->ground[$this->session->coodX][$this->session->coodY - 1])){
					$this->ground[$this->session->coodX][$this->session->coodY - 1] = 1;
				}else{
					return array(
						'status' => FALSE,
						'position' => 'x: '. $this->session->coodX .', y: '. ($this->session->coodY - 1)
					);
				}

				break;
			case 'E':

				if(isset($this->ground[$this->session->coodX - 1][$this->session->coodY])){
					$this->ground[$this->session->coodX - 1][$this->session->coodY] = 1;
				}else{
					return array(
						'status' => FALSE,
						'position' => 'x: '. ($this->session->coodX - 1) .', y: '. $this->session->coodY
					);
				}

				break;
			case 'C':

				if(isset($this->ground[$this->session->coodX][$this->session->coodY + 1])){
					$this->ground[$this->session->coodX][$this->session->coodY + 1] = 1;
				}else{
					return array(
						'status' => FALSE,
						'position' => 'x: '. $this->session->coodX .', y: '. ($this->session->coodY + 1)
					);
				}

				break;
		}

		$this->ground[$this->session->coodX][$this->session->coodY] = 0;

		$this->session->ground = $this->ground;

		for($y = 4; $y >= 0; $y--){
			for($x = 0; $x <= 4; $x++){
				if($this->session->ground[$x][$y]){
					$this->session->coodX = $x;
					$this->session->coodY = $y;
				}
			}
		}

		return array(
			'status' => TRUE,
			'position' => 'x: '.$this->session->coodX .', y: '. $this->session->coodY
		);
	}

	public function turnLeft() : array
	{
		switch ($this->session->face) {
			case 'D':
				$this->session->face = 'C';
				break;
			case 'C':
				$this->session->face = 'E';
				break;
			case 'E':
				$this->session->face = 'B';
				break;
			case 'B':
				$this->session->face = 'D';
				break;
		}

		return array(
			'status' => TRUE,
			'position' => 'x: '.$this->session->coodX .', y: '. $this->session->coodY
		);
	}

	public function turnRight() : array
	{
		switch ($this->session->face) {
			case 'D':
				$this->session->face = 'B';
				break;
			case 'B':
				$this->session->face = 'E';
				break;
			case 'E':
				$this->session->face = 'C';
				break;
			case 'C':
				$this->session->face = 'D';
				break;
		}

		return array(
			'status' => TRUE,
			'position' => 'x: '.$this->session->coodX .', y: '. $this->session->coodY
		);
	}
}
