<?php 

class Carrito{
  private $_elementos;

  public function __construct(){
    $this->_elementos = [];
  }

  public function agregar($id, $cant=1){
    if (!isset($this->_elementos[$id])) {
      $this->_elementos[$id]=0;
    }
    $this->_elementos[$id]+=$cant;
  }

  public function sacar($id, $cant=1){
    if ($cant<=$this->_elementos[$id]) {
      $this->_elementos[$id]-=$cant;
    }
    if ($this->_elementos[$id]==0) {
      unset($this->_elementos[$id]);
    }
  }
}


// abstract class Index{
  

//   static public function ejecutar(){
//     $micarrito = new Carrito();

//   }

class CtrlCarrito extends Controlador{


  public function agregar(){
    $id = $_GET["id"];
    $_SESSION["carrito"] =  new Carrito();
    $_SESSION["carrito"]->agregar($id);
  }
}

?>