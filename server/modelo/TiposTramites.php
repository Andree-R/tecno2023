<?php
require_once './core/Modelo.php';

class TiposTramites extends Modelo {
    private $id;
    private $tipo;
    private $_tabla='tipos_tramites';

    public function __construct($id=null,$nombre=null){
        $this->id = $id;
        $this->tipo=$nombre;
        parent::__construct($this->_tabla);
    }
    public function getTodo(){
        return $this->getAll();
    }
    public function eliminar(){
        return $this->deleteById($this->id);
    }
    public function guardar(){
        $datos = [
            'id'=>$this->id,
            'tipo'=>"'$this->tipo'",
        ];
        return $this->insert($datos);
    }
    public function editar(){
        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'tipo'=>"'$this->tipo'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }
}