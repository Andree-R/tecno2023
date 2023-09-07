<?php
require_once './core/Controlador.php';
require_once './modelo/TiposDocumentos.php';

class CtrlTiposDocumentos extends Controlador {
    public function index(){
        # echo "Hola Estado";
        $obj = new TiposDocumentos;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'titulo'=>'Tipos de documentos',
            'datos'=>$data['data']
        ];

        $this->mostrar('tiposDocumentos/mostrar.php',$datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new TiposDocumentos ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $this->mostrar('tiposDocumentos/formulario.php');
    }
    public function editar(){
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj = new TiposDocumentos($id);
        $data = $obj->editar();
        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0]
        ];
        $this->mostrar('tiposDocumentos/formulario.php',$datos);
    }
    public function guardar(){
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $esNuevo = $_POST['esNuevo'];

        $obj = new TiposDocumentos ($id, $tipo);

        switch ($esNuevo) {
            case 0: # Editar
            var_dump($tipo);
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