<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/EstadosTramites.php';

class CtrlEstadosTramites extends Controlador {
    public function index(){
        # echo "Hola Estado";
        $obj = new EstadosTramites;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos'=>$data['data']
        ];

        $home = $this->mostrar('estadosTramites/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Estados de tramites',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new EstadosTramites ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $this->mostrar('estadosTramites/formulario.php');

        // $datos = [
        //     'titulo' => 'Estados de tramites',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar(){
        $id = $_GET['id'];
        // echo "Editando: ".$id;
        $obj = new EstadosTramites($id);
        $data = $obj->editar();
        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0]
        ];
        $this->mostrar('estadosTramites/formulario.php', $datos);

        // $datos = [
        //     'titulo' => 'Estados de tramites',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar(){
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $esNuevo = $_POST['esNuevo'];

        

        $obj = new EstadosTramites ($id, $estado);

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