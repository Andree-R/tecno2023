<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/TramiteDocumentario.php';
require_once './modelo/Documento.php';
require_once './modelo/Oficina.php';
require_once './modelo/EstadosTramites.php';
require_once './modelo/TiposDocumentos.php';
require_once './modelo/TiposTramites.php';
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

    public function mostrarSolicitudes()
    {

        $tramites = new TramiteDocumentario();

        $dataTramites = $tramites->getTodo()["data"] != null ? array_reverse($tramites->getTodo()["data"]) : $tramites->getTodo()["data"];

        // var_dump("<pre>", $tramites->getTodo(), "</pre>");exit;
        
        $datos = [
            "title" => "",
            "solicitud" => "Nueva solicitud",
            "url" => "?ctrl=CtrlTramiteDocumentario&accion=nuevaSolicitud",
            "tramites" => $dataTramites,

        ];

        $home = $this->mostrar('tramitesDocumentarios/inbox.php', $datos, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function nuevaSolicitud()
    {

        $oficinas = new Oficina();

        $dataOficinas = $oficinas->getTodo();

        $tipoDocumento = new TiposDocumentos();
        $dataTipDoc = $tipoDocumento->getTodo();

        $tipTramite = new TiposTramites();

        $dataTipTramites = $tipTramite->getTodo();

        $datos = [
            "title" => "",
            "solicitud" => "Volver a la bandeja",
            "url" => "?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes",
            "oficinas" => $dataOficinas["data"],
            "tipoDoc" => $dataTipDoc["data"],
            "tipTramites" => $dataTipTramites["data"],
        ];
        // var_dump($persona);exit;



        $home = $this->mostrar('tramitesDocumentarios/compose.php', $datos, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function enviarSolicitud()
    {

        $idOficinaDestino = $_POST["oficina"];
        $idtipTramites = $_POST["tipTramites"];
        $descripcion = $_POST["descripcion"];
        $files = $_FILES;

        $response = [];

        if (empty($files["adjuntos"]["tmp_name"][0])) {
            array_push($response, "No se adjuntaron documentos");
            echo json_encode($response);exit;
        }

        // var_dump("<pre>", $adjunto, "</pre>");exit;


        $datetime = new DateTime();
        $now = $datetime->format("Y-m-d H:i:s");

        $obj = new TramiteDocumentario();

        $ubicacionArchivos = $obj->guardarSolicitud($now, $descripcion, $files["adjuntos"]);

        // $carpetaDestino = Documento::crearCarpeta($now);
        // var_dump("<pre>", $ubicacionArchivos, "</pre>");exit;
        $tramite = new TramiteDocumentario(
            $ubicacionArchivos["ultimoIdDisponible"],
            "null",
            $now,
            "null",
            "null",
            $idOficinaDestino,
            3,
            $ubicacionArchivos["ubicacionDescription"],
            $idtipTramites,
            $_SESSION["id"],
        );

        $tramite->guardar();


        for ($i=0; $i < count($ubicacionArchivos["ubicacionDocumentos"]); $i++) { 
            $documento = new Documento(
                "null",
                "null",
                null,
                null,
                $now,
                null,
                $now,
                "null",
                $idOficinaDestino,
                $ubicacionArchivos["ubicacionDocumentos"][$i],
                $ubicacionArchivos["ultimoIdDisponible"],
            );
            $documento->guardar();
        }

        

        // $formatTime = $datetime->format("Y-m-d_H:i:s");
        
        // $ubicacionDescription = $documento->crearArchivo($carpetaDestino, $descripcion, $formatTime);
        
        // $documento->moverDocumentos($adjunto, $carpetaDestino, $formatTime);


        if (isset($documento)) {


            
        }

        echo json_encode($response);
    }

    public function mostrarDetalleTramite()
    {

        $idTramite = $_GET["tramite"];

        $tramite = new TramiteDocumentario($idTramite);

        
        $dataTramite = $tramite->editar()["data"][0];

        $documentos = new Documento();

        $dataDocumentos = $documentos->getBy("idTramiteDocumentario", $idTramite)["data"];

        
        if (file_exists($dataTramite["description"])) {
            $datos = [
                "title" => "",
                "solicitud" => "Volver a la bandeja",
                "url" => "?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes",
                "dataTramite" => $dataTramite,
                "dataDocumentos" => $dataDocumentos
            ];
    
            $home = $this->mostrar('tramitesDocumentarios/read_tramite.php', $datos, true);
    
            $datos = [
                'contenido' => $home,
            ];
    
            $this->mostrar('./plantilla/home.php', $datos);
        }



        
        
    }
}
