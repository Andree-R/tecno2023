<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/TramiteDocumentario.php';
require_once './modelo/Documento.php';
require_once './modelo/Oficina.php';
require_once './modelo/EstadosTramites.php';
require_once './modelo/TiposDocumentos.php';
require_once './modelo/Persona.php';

class CtrlTramiteDocumentario extends Controlador
{

    public function index()
    {
        # echo "Hola ConceptoPago";
        $obj = new TramiteDocumentario;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos' => $data['data']
        ];

        $home = $this->mostrar('tramitesDocumentarios/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Tramites Documentarios',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj = new TramiteDocumentario($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo()
    {
        # echo "Agregando..";
        $obj = new Documento();
        $dataDoc = $obj->getTodo();
        $obj = new Oficina();
        $dataOfi = $obj->getTodo();
        $obj = new EstadosTramites();
        $dataEsT = $obj->getTodo();

        $datos = [
            'documentos' => $dataDoc['data'],
            'oficinas' => $dataOfi['data'],
            'estadosTramites' => $dataEsT['data'],
        ];
        # var_dump($datos);exit;

        $this->mostrar('tramitesDocumentarios/formulario.php', $datos);

        // $datos = [
        //     'titulo' => 'Conceptos de Pago',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar()
    {
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj = new TramiteDocumentario($id);
        $dataTrD = $obj->editar();

        // var_dump("<pre>", $dataTrD, "</pre>");exit;

        $obj = new Documento();
        $dataDoc = $obj->getTodo();
        $obj = new Oficina();
        $dataOfi = $obj->getTodo();
        $obj = new EstadosTramites();
        $dataEsT = $obj->getTodo();

        $datos = [
            'datos' => $dataTrD['data'][0],

            'documentos' => $dataDoc['data'],
            'oficinas' => $dataOfi['data'],
            'estadosTramites' => $dataEsT['data'],
        ];

        $this->mostrar('tramitesDocumentarios/formulario.php', $datos);

        // $datos = [
        //     'titulo' => 'Editar Tramite Documentario',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar()
    {
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $idDocumento = $_POST['idDocumento'];
        $fecha_recepcion = $_POST['fecha_recepcion'];
        $fecha_envio = $_POST['fecha_envio'];
        $idOficinaOrigen = $_POST['idOficinaOrigen'];
        $idOficinaDestino = $_POST['idOficinaDestino'];
        $idEstado = $_POST['idEstado'];
        $esNuevo = $_POST['esNuevo'];

        $obj = new TramiteDocumentario(
            $id,
            "null",
            $fecha_envio,
            $fecha_recepcion,
            $idDocumento,
            $idOficinaOrigen,
            $idOficinaDestino,
            $idEstado,
        );

        switch ($esNuevo) {
            case 0: # Editar
                $data = $obj->actualizar();
                break;

            default: # Nuevo
                $data = $obj->guardar();
                break;
        }


        # var_dump($data);exit;
        $this->index();
    }

    public function inbox()
    {

        $tramites = new TramiteDocumentario();

        $dataTramites = $tramites->getTodo()["data"] != null ? array_reverse($tramites->getTodo()["data"]) : $tramites->getTodo()["data"];


        $datos = [
            "title" => "Bandeja",
            "solicitud" => "Enviar solicitud",
            "url" => "?ctrl=CtrlTramiteDocumentario&accion=solicitud",
            "tramites" => $dataTramites,

        ];

        $home = $this->mostrar('tramitesDocumentarios/inbox.php', $datos, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function solicitud()
    {

        $oficinas = new Oficina();

        $dataOficinas = $oficinas->getTodo();

        $tipoDocumento = new TiposDocumentos();
        $dataTipDoc = $tipoDocumento->getTodo();



        $datos = [
            "title" => "Solicitud",
            "solicitud" => "Volver a la bandeja",
            "url" => "?ctrl=CtrlTramiteDocumentario&accion=inbox",
            "oficinas" => $dataOficinas["data"],
            "tipoDoc" => $dataTipDoc["data"],
        ];
        // var_dump($persona);exit;



        $home = $this->mostrar('tramitesDocumentarios/compose.php', $datos, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function mostrarTramite()
    {

        $idTramite = $_GET["tramite"];

        $tramite = new TramiteDocumentario($idTramite);
        
        $dataTramite = $tramite->editar()["data"][0];

        
        if (file_exists($dataTramite["ubicacion"])) {
            $adjuntos = readfile($dataTramite["ubicacion"], true);
            var_dump("<pre>", $adjuntos, "</pre>");
        }


        // var_dump("<pre>", $dataTramite, "</pre>");exit;

        
        $datos = [
            "title" => "Tramite",
            "solicitud" => "Volver a la bandeja",
            "url" => "?ctrl=CtrlTramiteDocumentario&accion=inbox",
            "dataTramite" => $dataTramite,
        ];

        $home = $this->mostrar('tramitesDocumentarios/read_tramite.php', $datos, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function enviarTramite()
    {


        // var_dump("<pre>", $_POST, "</pre>");
        // var_dump("<pre>", $_FILES, "</pre>");exit;

        $idOficinaDestino = $_POST["oficina"];
        $idTipoDoc = $_POST["tipoDoc"];
        $descripcion = $_POST["descripcion"];
        $adjunto = $_FILES["adjunto"];

        $response = [];

        $datetime = new DateTime();
        $now = $datetime->format("Y-m-d H:i:s");

        $carpetaDestino = Documento::crearCarpeta($now);

        $documento = new Documento(
            "null",
            "null",
            null,
            null,
            $now,
            null,
            $now,
            $idTipoDoc,
            $idOficinaDestino,
            $_SESSION["id"],
            $carpetaDestino
        );

        $formatTime = $documento->setFormat($datetime);
        
        $ubicacionDescription = $documento->crearArchivo($carpetaDestino, $descripcion, $formatTime);
        $documento->moverDocumentos($adjunto, $carpetaDestino, $formatTime);
        $documento->guardar();

        if (isset($documento)) {

            $idDocumento = $documento->getDoc()["data"][0]["id"];

            $tramite = new TramiteDocumentario(
                "null",
                "null",
                $now,
                "null",
                $idDocumento,
                "null",
                $idOficinaDestino,
                3,
                $ubicacionDescription
            );

            $tramite->guardar();
        }

        echo json_encode($response);
    }
    public function boardDocumentos()
    {

        $datos = [];

        $home = $this->mostrar('plantilla/interactiveChart.php', $datos, true);

        $datos = [
            'titulo' => 'Board Documentos',
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
}
