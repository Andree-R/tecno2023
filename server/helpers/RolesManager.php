<?php

class RolesManager extends Modelo
{

  private static $instance;
  private $observers = [];
  private $perfiles = [];

  private $_tabla = "perfiles";

  private function __construct()
  {
    parent::__construct($this->_tabla);
  }

  public static function getInstance() {
    if (!self::$instance) {
        self::$instance = new RolesManager();
    }
    return self::$instance;
}


  public function addObserver(Observer $observer)
  {
    $this->observers[] = $observer;
  }

  public function getRolesFromDatabase(){
    
  }

  public function updatePermissions()
  {
    // Lógica para actualizar los permisos (por ejemplo, cuando cambian los roles)
    // Notificar a los observadores
    foreach ($this->observers as $observer) {
      $observer->update();
    }
  }
}

?>

