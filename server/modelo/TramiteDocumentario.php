<?php
require_once './core/Modelo.php';

class TramiteDocumentario extends Modelo
{
    private $id;
    private $fecha;
    private $fechaEnvio;
    private $fechaRecepcion;

    private $idOficinaOrigen;
    private $idOficinaDestino;
    private $idtipoTramite;
    private $idEstado;
    private $description;
    private $idPersona;

    private $_tabla = 'tramites_documentarios';
    private $_vista = 'v_tramites_documentarios';

    private const CARPETA_SOLICITUDES = "solicitudes";
    private const ARCHIVO_DESCRIPTION_NAME = "description";
    private const ARCHIVO_EXTENSION = "html";
    private const SEPARATOR = "__";
    private const SEPARATOR_EXTENSION = ".";

    public function __construct(
        $id = null,
        $fecha = null,
        $fechaEnvio = null,
        $fechaRecepcion = null,

        $idOficinaOrigen = null,
        $idOficinaDestino = null,
        $idEstado = null,
        $description = null,
        $idtipoTramite = null,
        $idPersona = null,
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaRecepcion = $fechaRecepcion;

        $this->idOficinaOrigen = $idOficinaOrigen;
        $this->idOficinaDestino = $idOficinaDestino;
        $this->idEstado = $idEstado;
        $this->description = $description;
        $this->idtipoTramite = $idtipoTramite;
        $this->idPersona = $idPersona;

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

            'idOficinaOrigen' => ($this->idOficinaOrigen === "null") ? "null" :  "$this->idOficinaOrigen",
            'idOficinaDestino' => "$this->idOficinaDestino",
            'idEstado' => "$this->idEstado",
            'description' => "'$this->description'",
            'idTipoTramite' => "'$this->idtipoTramite'",
            'idPersona' => "'$this->idPersona'",
        ];
        return $this->insert($datos);
    }
    public function editar()
    {
        $this->setTabla($this->_vista);

        return $this->getById($this->id);
    }
    public function actualizar()
    {
        $datos = [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'fecha_envio' => "'$this->fechaEnvio'",
            'fecha_recepcion' => "'$this->fechaRecepcion'",

            'idOficinaOrigen' => "$this->idOficinaOrigen",
            'idOficinaDestino' => "$this->idOficinaDestino",
            'idEstado' => "$this->idEstado",
            'description' => "'$this->description'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh, $datos);
    }

    public function mostrarSolicitudes()
    {
        $this->setTabla($this->_vista);


        return $this->getAll();
    }

    public function guardarSolicitud($now, $descripcion, $adjuntos)
    {

        $carpetaDestino = self::CARPETA_SOLICITUDES . DIRECTORY_SEPARATOR . $_SESSION["dni"] . DIRECTORY_SEPARATOR . $now;

        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        $nombreDeArchivo = self::ARCHIVO_DESCRIPTION_NAME .
            self::SEPARATOR .
            $now .
            self::SEPARATOR_EXTENSION .
            self::ARCHIVO_EXTENSION;

        $ubicacionDescripcion = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreDeArchivo;

        file_put_contents($ubicacionDescripcion, $descripcion);

        // var_dump("<pre>", $adjuntos, "</pre>");
        // exit;

        $ubicacionDocumentos = [];

        if (!empty($adjuntos["tmp_name"][0]) and file_exists($carpetaDestino)) {
            for ($i=0; $i < count($adjuntos['name']); $i++) { 
                $fileInfo = pathinfo($adjuntos["name"][$i]);
                $nuevoNombreDeArchivo = $fileInfo["filename"] .
                    self::SEPARATOR .
                    $now .
                    self::SEPARATOR_EXTENSION .
                    $fileInfo["extension"];

                $ubicacion = $carpetaDestino . DIRECTORY_SEPARATOR . $nuevoNombreDeArchivo;
                move_uploaded_file($adjuntos["tmp_name"][$i], $ubicacion);

                array_push($ubicacionDocumentos, $ubicacion);
            }
        }

        $sql = "SELECT MAX(id) AS ultimo_id FROM tramites_documentarios";
        $this->setSql($sql);
        $ultimoID = $this->ejecutarSql()["data"][0]["ultimo_id"] != null ? $this->ejecutarSql()["data"][0]["ultimo_id"] : 0;


        $ubicacionArchivos = [
            "ultimoIdDisponible" => $ultimoID + 1,
            "ubicacionDocumentos" => $ubicacionDocumentos,
            "ubicacionDescription" => $ubicacionDescripcion,
        ];

        return $ubicacionArchivos;
    }
}
