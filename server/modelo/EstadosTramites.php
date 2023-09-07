<?php
require_once './core/Modelo.php';

class EstadosTramites extends Modelo {
    private $id;
    private $estado;
    private $_tabla='estados_tramites';

    public function __construct($id=null,$nombre=null){
        $this->id = $id;
        $this->estado=$nombre;
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
            'estado'=>"'$this->estado'",
        ];
        return $this->insert($datos);
    }
    public function editar(){
        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'estado'=>"'$this->estado'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }
}