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
    private $ubicacion;
    private $idTramiteDocumentario;

    private const CARPETA_SOLICITUDES = "solicitudes";
    private const ARCHIVO_DESCRIPTION_NAME = "description";
    private const ARCHIVO_EXTENSION = "html";
    private const SEPARATOR = "__";
    private const SEPARATOR_EXTENSION = ".";

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
        $ubicacion=null,
        $idTramiteDocumentario=null,
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
        $this->ubicacion=$ubicacion;
        $this->idTramiteDocumentario=$idTramiteDocumentario;
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
            'idTipo'=>"$this->idTipo",
            'idOficina'=>"'$this->idOficina'",
            'ubicacion'=>"'$this->ubicacion'",
            'idTramiteDocumentario'=>"'$this->idTramiteDocumentario'",
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
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }

    public static function crearCarpeta($datetime)
    {
        $carpetaDestino = self::CARPETA_SOLICITUDES . DIRECTORY_SEPARATOR . $_SESSION["dni"] . DIRECTORY_SEPARATOR . $datetime;

        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        return $carpetaDestino;
    }


    public function crearArchivo($carpetaDestino, $contenido, $formatTime){

        $nombreDeArchivo = self::ARCHIVO_DESCRIPTION_NAME . 
        self::SEPARATOR . 
        $formatTime . 
        self::SEPARATOR_EXTENSION . 
        self::ARCHIVO_EXTENSION;

        $ubicacionArchivo = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreDeArchivo;

        file_put_contents($ubicacionArchivo, $contenido);
        return  $ubicacionArchivo;
        
    }

    public function moverDocumentos($adjunto, $carpetaDestino, $format)
    {
        if (!empty($adjunto["tmp_name"]) and isset($carpetaDestino)) {

            $fileInfo = pathinfo($adjunto["name"]);

            $nuevoNombreDeArchivo = $fileInfo["filename"] .
                self::SEPARATOR .
                $format .
                self::SEPARATOR_EXTENSION .
                $fileInfo["extension"];

            $ubicacion = $carpetaDestino . DIRECTORY_SEPARATOR . $nuevoNombreDeArchivo;
            move_uploaded_file($adjunto["tmp_name"], $ubicacion);
        }
    }
}