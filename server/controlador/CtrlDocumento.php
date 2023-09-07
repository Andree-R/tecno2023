<?php
require_once './core/Controlador.php';
require_once './modelo/Documento.php';
require_once './modelo/TiposDocumentos.php';
require_once './modelo/Oficina.php';
require_once './modelo/Persona.php';

class CtrlDocumento extends Controlador {
    public function index(){
        # echo "Hola CtaContable";
        $obj = new Documento;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'titulo'=>'Documentos',
            'datos'=>$data['data']
        ];

        $this->mostrar('documentos/mostrar.php',$datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new Documento ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $obj1 = new TiposDocumentos();
        $dataTipDoc = $obj1->getTodo();
        $obj2 = new Oficina();
        $dataofic = $obj2->getTodo();
        $obj3 = new Persona();
        $dataperson = $obj3->getTodo();
        
        $datos = [
            "tipDoc" => $dataTipDoc["data"],
            "oficinas" => $dataofic["data"],
            "personas" => $dataperson["data"],
        ];
        $this->mostrar('documentos/formulario.php', $datos);
    }
    public function editar(){
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj = new Documento($id);
        $data = $obj->editar();
        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0]
        ];
        $this->mostrar('documentos/formulario.php',$datos);
    }
    public function guardar(){
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $idDocumento = $_POST['idDocumento'];
        $numero = $_POST['numero'];
        $asunto = $_POST['asunto'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $fecha_recepcion = $_POST['fecha_recepcion'];
        $idTipo = $_POST['idTipo'];
        $idOficina = $_POST['idOficina'];
        $idPersona = $_POST['idPersona'];
        $esNuevo = $_POST['esNuevo'];

        $obj = new Documento (
            $id,
            $idDocumento,
            $numero,
            $asunto,
            $fecha,
            $descripcion,
            $fecha_recepcion,
            $idTipo,
            $idOficina,
            $idPersona,
            $numero
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