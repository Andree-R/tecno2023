<?php 

require_once "./core/Modelo.php";

class Curso extends Modelo{

  private $id;
  private $nombre;

  public function getTodo(){
    return $this->getAll();
}

}

?>