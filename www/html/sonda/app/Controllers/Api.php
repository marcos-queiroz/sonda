<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Api extends Home
{
    use ResponseTrait;
    
    public function init()
    {
      $this->start();

      if(isset($this->session->face)){
        return $this->displaysCoordinates();
      } else {
        return $this->respond(['error' => 'Não foi possível iniciar o terreno para a sonda.']);
      }
    }

    public function receivesCommand()
    {
      $command = $this->request->getJSON()->movimentos;

      $respond = $this->command($command);

      if($respond['status']){
        return $this->respond($respond['position']);
      } else {
        return $this->respond(['error' => $respond['erro']]);
      }
    }

    public function displaysCoordinates()
    {
      $respond = array(
        'x' => $this->session->coodX,
        'y' => $this->session->coodY,
        'face' => $this->session->face
      );

      return $this->respond($respond);
    }
}