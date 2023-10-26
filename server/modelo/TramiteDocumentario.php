<?php
require_once './core/Modelo.php';

class TramiteDocumentario extends Modelo
{
    private $id;
    private $fecha;
    private $fechaEnvio;
    private $fechaRecepcion;

    private $idDocumento;
    private $idOficinaOrigen;
    private $idOficinaDestino;
    private $idEstado;

    private $_tabla = 'tramites_documentarios';
    private $_vista = 'v_tramites_documentarios';

    public function __construct(
        $id = null,
        $fecha = null,
        $fechaEnvio = null,
        $fechaRecepcion = null,

        $idDocumento = null,
        $idOficinaOrigen = null,
        $idOficinaDestino = null,
        $idEstado = null,
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaRecepcion = $fechaRecepcion;

        $this->idDocumento = $idDocumento;
        $this->idOficinaOrigen = $idOficinaOrigen;
        $this->idOficinaDestino = $idOficinaDestino;
        $this->idEstado = $idEstado;

        parent::__construct($this->_tabla);
    }
    public function getTodo()
    {
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function eliminar()
    {
        return $this->deleteById($this->id);
    }
    public function guardar()
    {
        $datos = [
            'id' => $this->id,
            'fecha' => ($this->fecha === "null") ? "null" : "'$this->fecha'",
            'fecha_envio' => "'$this->fechaEnvio'",
            'fecha_recepcion' => ($this->fechaRecepcion === "null") ? "null" : "'$this->fechaRecepcion'",
            
            'idDocumento' => "$this->idDocumento",
            'idOficinaOrigen' => ($this->idOficinaOrigen === "null") ? "null" :  "$this->idOficinaOrigen",
            'idOficinaDestino' => "$this->idOficinaDestino",
            'idEstado' => "$this->idEstado",
        ];
        return $this->insert($datos);
    }
    public function editar()
    {
        return $this->getById($this->id);
    }
    public function actualizar()
    {
        $datos = [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'fecha_envio' => "'$this->fechaEnvio'",
            'fecha_recepcion' => "'$this->fechaRecepcion'",
            
            'idDocumento' => "$this->idDocumento",
            'idOficinaOrigen' => "$this->idOficinaOrigen",
            'idOficinaDestino' => "$this->idOficinaDestino",
            'idEstado' => "$this->idEstado",
        ];
        $wh = "id=$this->id";
        return $this->update($wh, $datos);
    }
}
