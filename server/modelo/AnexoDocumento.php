<?php
require_once './core/Modelo.php';

class AnexoDocumento extends Modelo {
    private $id;
    private $idDocumento;
    private $nombre;
    private $descripcion;
    private $url;
    private $_tabla='anexos_documento';
    private $_vista='v_anexoDocumento';

    public function __construct(
        $id=null,
        $idDocumento=null,
        $nombre=null,
        $descripcion=null,
        $url=null
        ){
        $this->id = $id;
        $this->idDocumento=$idDocumento;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->url=$url;
        parent::__construct($this->_tabla);
    }
    public function getTodo(){
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function eliminar(){
        return $this->deleteById($this->id);
    }
    public function guardar(){
        $datos = [
            'id'=>$this->id,
            'idDocumento'=>"'$this->idDocumento'",
            'nombre'=>"'$this->nombre'",
            'descripcion'=>"'$this->descripcion'",
            'url'=>"'$this->url'",
        ];
        return $this->insert($datos);
    }
    public function editar(){
        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'idDocumento'=>"'$this->idDocumento'",
            'nombre'=>"'$this->nombre'",
            'descripcion'=>"'$this->descripcion'",
            'url'=>"'$this->url'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }
}