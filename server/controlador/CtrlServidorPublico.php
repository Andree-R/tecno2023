<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/ServidorPublico.php';
require_once './modelo/Cargo.php';

class CtrlServidorPublico extends Controlador {
    public function index(){
        # echo "Hola ServidorPublico";
        $obj = new ServidorPublico;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos'=>$data['data']
        ];

        // var_dump("<pre>", $data, "</pre>");exit;
        
        $home = $this->mostrar('servidoresPublicos/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Servidores Públicos',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new ServidorPublico ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $obj = new Cargo();
        $dataCta = $obj->getTodo();
        $datos = [
            'cargos'=>$dataCta['data']
        ];
        # var_dump($datos);exit;

        $home = $this->mostrar('servidoresPublicos/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Nuevo servidor publico',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar(){
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj = new ServidorPublico($id);
        $data = $obj->editar();
        # Recuperamos los datos las Cuentas Contables
        $obj = new Cargo();
        $dataCta = $obj->getTodo();

        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0],
            'ctasContables'=>$dataCta['data']
        ];

        $home = $this->mostrar('servidoresPublicos/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Conceptos de Pago',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar(){
        # echo "Guardando..";
        // var_dump($_POST);exit;
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $telefono = $_POST['telefono'];
        $idCargo = $_POST['idCargo'];
        $esNuevo = $_POST['esNuevo'];

        $obj = new ServidorPublico (
          $id, 
          $nombres,
          $apellidos,
          $dni,
          $correo,
          $fechaNacimiento,
          $direccion,
          $telefono,
          $genero,
          $idCargo,
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