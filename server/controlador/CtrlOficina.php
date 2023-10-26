<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Oficina.php';
require_once './modelo/ServidorPublico.php';

class CtrlOficina extends Controlador {
    public function index(){
        # echo "Hola Estado";
        $obj = new Oficina;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'titulo'=>'Estados de tramites',
            'datos'=>$data['data']
        ];

        $home = $this->mostrar('oficinas/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Oficinas',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
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
        $obj = new ServidorPublico();
        $dataSP = $obj->getTodo();
        $obj = new Oficina();
        $dataOf = $obj->getTodo();
        $datos = [
            'servidoresPublicos'=>$dataSP['data'],
            'oficinas'=>$dataOf['data'],
        ];

        $this->mostrar('oficinas/formulario.php', $datos);

        // $datos = [
        //     'titulo' => 'Nueva Oficina',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar(){
        $id = $_GET['id'];
        // echo "Editando: ".$id;
        $obj = new ServidorPublico();
        $dataSP = $obj->getTodo();
        $obj = new Oficina();
        $dataOf = $obj->getTodo();
        $obj = new Oficina($id);
        $data = $obj->editar();
        // var_dump("<pre>", $data, "</pre>");exit;
        // var_dump($data);exit;
        $datos = [
            'servidoresPublicos'=>$dataSP['data'],
            'oficinas'=>$dataOf['data'],
            'datos'=>$data['data'][0],
        ];
        $this->mostrar('oficinas/formulario.php', $datos);

        // $datos = [
        //     'titulo' => 'Editar Oficina',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar(){
        # echo "Guardando..";
        # var_dump($_POST);
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $idJefe = $_POST['idJefe'];
        $idMatriz = $_POST['idMatriz'];
        $esNuevo = $_POST['esNuevo'];



        // var_dump("<pre>", $_POST, "</pre>");exit;

        $obj = new Oficina (
            $id, 
            $idMatriz,
            $nombre,
            $idJefe,
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