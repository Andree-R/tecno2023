<?php
require_once './core/Controlador.php';
require_once './modelo/Oficina.php';

class CtrlPersona extends Controlador {
    public function index(){
        # echo "Hola Estado";
        $obj = new Oficina;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'titulo'=>'Estados de tramites',
            'datos'=>$data['data']
        ];

        $this->mostrar('estadosTramites/mostrar.php',$datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new Oficina ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $this->mostrar('estadosTramites/formulario.php');
    }
    public function editar(){
        $id = $_GET['id'];
        // echo "Editando: ".$id;
        $obj = new Oficina($id);
        $data = $obj->editar();
        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0]
        ];
        $this->mostrar('estadosTramites/formulario.php',$datos);
    }
    public function guardar(){
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $estado = $_POST['nombre'];
        $id_jefe = $_POST['id_jefe'];
        $esNuevo = $_POST['esNuevo'];

        

        $obj = new Oficina ($id, $estado);

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