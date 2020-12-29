<?php namespace App\Controllers;
class Sonda extends BaseController
{
	protected $ground = array();
	protected $session;

	function __construct() {
		$this->session = \Config\Services::session();
	}

	public function start() : array
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
			'coordinateX' => 0,
			'coordinateY' => 0,
			'sequence' => 'A sonda',
			'sequenceControl' => '',
			'movement' => '',
			'control' => 0
		]);

		return $this->session->get();
	}

	public function command($arrayCommand) : array
	{
		if(is_array($arrayCommand)){
			for($x = 0; $x < count($arrayCommand); $x++){
				
				switch ($arrayCommand[$x]) {
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

				if($x == (count($arrayCommand) - 1) && $arrayCommand[$x] == 'M'){
					$this->session->sequence .= $this->session->sequenceControl; // captura a ultima sequencia de M
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
					'x' => $this->session->coordinateX,
					'y' => $this->session->coordinateY,
					'sequence' => $this->session->sequence
				)
			);
		} else {
			return array(
				'status' => FALSE,
				'erro' => "Não foi possível identificar um movimento válido foi detectado."
			);
		}
	}

	public function move() : array
	{
		$this->session->movement = 'M';
		$this->ground = $this->session->ground;
		
		switch ($this->session->face) {
			case 'D':

				if(isset($this->ground[$this->session->coordinateX + 1][$this->session->coordinateY])){					
					$this->ground[$this->session->coordinateX + 1][$this->session->coordinateY] = 1;
										
					if($this->session->control > 0){
						$this->session->sequenceControl = ", se moveu ".($this->session->control + 1)." casas no eixo X";
					} else {
						$this->session->sequenceControl = ", se moveu 1 casa no eixo X";
					}
					
					$this->session->control += 1;
					
				}else{
					return array(
						'status' => FALSE,
						'face' => $this->session->face,
						'x' => $this->session->coordinateX + 1,
						'y' => $this->session->coordinateY
					);
				}

				break;
			case 'B':

				if(isset($this->ground[$this->session->coordinateX][$this->session->coordinateY - 1])){
					$this->ground[$this->session->coordinateX][$this->session->coordinateY - 1] = 1;

					if($this->session->control > 0){
						$this->session->sequenceControl = ", se moveu ".($this->session->control + 1)." casas no eixo Y";
					} else {
						$this->session->sequenceControl = ", se moveu 1 casa no eixo Y";
					}
					
					$this->session->control += 1;
				}else{
					return array(
						'status' => FALSE,
						'face' => $this->session->face,
						'x' => $this->session->coordinateX,
						'y' => $this->session->coordinateY - 1
					);
				}

				break;
			case 'E':

				if(isset($this->ground[$this->session->coordinateX - 1][$this->session->coordinateY])){
					$this->ground[$this->session->coordinateX - 1][$this->session->coordinateY] = 1;

					if($this->session->control > 0){
						$this->session->sequenceControl = ", se moveu ".($this->session->control + 1)." casas no eixo X";
					} else {
						$this->session->sequenceControl = ", se moveu 1 casa no eixo X";
					}
					
					$this->session->control += 1;
				}else{
					return array(
						'status' => FALSE,
						'face' => $this->session->face,
						'x' => $this->session->coordinateX - 1,
						'y' => $this->session->coordinateY
					);
				}

				break;
			case 'C':

				if(isset($this->ground[$this->session->coordinateX][$this->session->coordinateY + 1])){
					$this->ground[$this->session->coordinateX][$this->session->coordinateY + 1] = 1;

					if($this->session->control > 0){
						$this->session->sequenceControl = ", se moveu ".($this->session->control + 1)." casas no eixo Y";
					} else {
						$this->session->sequenceControl = ", se moveu 1 casa no eixo Y";
					}
					
					$this->session->control += 1;
				}else{
					return array(
						'status' => FALSE,
						'face' => $this->session->face,
						'x' => $this->session->coordinateX,
						'y' => $this->session->coordinateY + 1
					);
				}

				break;
		}

		// limpa a posicao anterior
		$this->ground[$this->session->coordinateX][$this->session->coordinateY] = 0;

		// carrega o tabuleiro/terreno
		$this->session->ground = $this->ground;

		// remapeia as coordenadas no tabuleiro/terreno
		for($y = 4; $y >= 0; $y--){
			for($x = 0; $x <= 4; $x++){
				if($this->session->ground[$x][$y]){
					$this->session->coordinateX = $x;
					$this->session->coordinateY = $y;
				}
			}
		}

		return array(
			'status' => TRUE,
			'face' => $this->session->face,
			'x' => $this->session->coordinateX,
			'y' => $this->session->coordinateY
		);
	}

	public function turnLeft() : array
	{
		$this->session->movement = 'GE';
		$this->session->control = 0;
		$this->session->sequence .= $this->session->sequenceControl;

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

		$this->session->sequence = $this->session->sequence.", girou para esquerda";

		return array(
			'status' => TRUE,
			'face' => $this->session->face,
			'x' => $this->session->coordinateX,
			'y' => $this->session->coordinateY
		);
	}

	public function turnRight() : array
	{
		$this->session->movement = 'GD';
		$this->session->control = 0;
		$this->session->sequence .= $this->session->sequenceControl;

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

		$this->session->sequence = $this->session->sequence.", girou para direita";

		return array(
			'status' => TRUE,
			'face' => $this->session->face,
			'x' => $this->session->coordinateX,
			'y' => $this->session->coordinateY
		);
	}
}
