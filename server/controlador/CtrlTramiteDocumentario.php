<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/TramiteDocumentario.php';
require_once './modelo/Documento.php';
require_once './modelo/Oficina.php';
require_once './modelo/EstadosTramites.php';

class CtrlTramiteDocumentario extends Controlador {
    public function index(){
        # echo "Hola ConceptoPago";
        $obj = new TramiteDocumentario;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos'=>$data['data']
        ];

        $home = $this->mostrar('tramitesDocumentarios/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Tramites Documentarios',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new TramiteDocumentario ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $obj = new Documento();
        $dataDoc = $obj->getTodo();
        $obj = new Oficina();
        $dataOfi = $obj->getTodo();
        $obj = new EstadosTramites();
        $dataEsT = $obj->getTodo();
        
        $datos = [
            'documentos'=>$dataDoc['data'],
            'oficinas'=>$dataOfi['data'],
            'estadosTramites'=>$dataEsT['data'],
        ];
        # var_dump($datos);exit;

        $home = $this->mostrar('tramitesDocumentarios/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Conceptos de Pago',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar(){
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
            'datos'=>$dataTrD['data'][0],

            'documentos'=>$dataDoc['data'],
            'oficinas'=>$dataOfi['data'],
            'estadosTramites'=>$dataEsT['data'],
        ];

        $home = $this->mostrar('tramitesDocumentarios/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Editar Tramite Documentario',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar(){
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

        $obj = new TramiteDocumentario (
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
                $data=$obj->actualizar();
                break;
            
            default: # Nuevo
                $data=$obj->guardar();
                break;
        }

        
        # var_dump($data);exit;
        $this->index();

    }
}