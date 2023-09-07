<?php
require_once './core/Modelo.php';

class Documento extends Modelo {
    private $id;
    private $idDocumento;
    private $numero;
    private $asunto;
    private $fecha;
    private $descripcion;
    private $fecha_recepcion;
    private $idTipo;
    private $idOficina;
    private $idPersona;
    private $_tabla='documentos';
    private $_vista='v_documentos';

    public function __construct(
        $id=null,
        $idDocumento=null,
        $numero=null,
        $asunto=null,
        $fecha=null,
        $descripcion=null,
        $fechaRecepcion=null,
        $idTipo=null,
        $idOficina=null,
        $idPersona=null
        ){
        $this->id = $id;
        $this->idDocumento=$idDocumento;
        $this->numero=$numero;
        $this->asunto=$asunto;
        $this->fecha=$fecha;
        $this->descripcion=$descripcion;
        $this->fecha_recepcion=$fechaRecepcion;
        $this->idTipo=$idTipo;
        $this->idOficina=$idOficina;
        $this->idPersona=$idPersona;
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
            'numero'=>"'$this->numero'",
            'asunto'=>"'$this->asunto'",
            'fecha'=>"'$this->fecha'",
            'descripcion'=>"'$this->descripcion'",
            'fecha_recepcion'=>"'$this->fecha_recepcion'",
            'idTipo'=>"'$this->idTipo'",
            'idOficina'=>"'$this->idOficina'",
            'idPersona'=>"'$this->idPersona'",
        ];
        return $this->insert($datos);
    }
    public function editar(){
        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'nombre'=>"'$this->nombre'",
            'monto'=>"'$this->monto'",
            'idCta'=>"$this->idCta",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }
}