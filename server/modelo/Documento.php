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
    private $ubicacion;

    private const CARPETA_SOLICITUDES = "solicitudes";

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
        $idPersona=null,
        $ubicacion=null
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
        $this->ubicacion=$ubicacion;
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
            'idDocumento'=>$this->idDocumento,
            'numero'=>"'$this->numero'",
            'asunto'=>"'$this->asunto'",
            'fecha'=>"'$this->fecha'",
            'descripcion'=>"'$this->descripcion'",
            'fecha_recepcion'=>"'$this->fecha_recepcion'",
            'idTipo'=>"'$this->idTipo'",
            'idOficina'=>"'$this->idOficina'",
            'idPersona'=>"'$this->idPersona'",
            'ubicacion'=>"'$this->ubicacion'",
        ];
        return $this->insert($datos);
    }

    public function getDoc(){
        return $this->getBy("ubicacion", $this->ubicacion);
    }

    public function editar(){

        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'idDocumento'=>"$this->idDocumento",
            'numero'=>"'$this->numero'",
            'asunto'=>"'$this->asunto'",
            'fecha'=>"'$this->fecha'",
            'descripcion'=>"'$this->descripcion'",
            'fecha_recepcion'=>"'$this->fecha_recepcion'",
            'idTipo'=>"'$this->idTipo'",
            'idOficina'=>"'$this->idOficina'",
            'idPersona'=>"'$this->idPersona'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }

    public static function crearCarpeta()
    {
        $carpetaDestino = self::CARPETA_SOLICITUDES . DIRECTORY_SEPARATOR . $_SESSION["dni"];

        if (!file_exists(
            $carpetaDestino = self::CARPETA_SOLICITUDES . DIRECTORY_SEPARATOR . $_SESSION["dni"]
        )) {
            mkdir($carpetaDestino, 0755);
        }

        return $carpetaDestino;
    }

    public function moverDocumentos($adjunto, $carpetaDestino, $datetime)
    {
        if (!empty($adjunto["tmp_name"]) and isset($carpetaDestino)) {
            $format_datetime = $datetime->format("Y-m-d_H:i:s");

            $fileInfo = pathinfo($adjunto["name"]);
            $separatorName = "__";
            $separatorExtension = ".";

            $nuevoNombreDeArchivo = $fileInfo["filename"] .
                $separatorName .
                $format_datetime .
                $separatorExtension .
                $fileInfo["extension"];

            $ubicacion = $carpetaDestino . DIRECTORY_SEPARATOR . $nuevoNombreDeArchivo;
            move_uploaded_file($adjunto["tmp_name"], $ubicacion);
        }
    }
}