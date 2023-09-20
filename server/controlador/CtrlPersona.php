<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Persona.php';

class CtrlPersona extends Controlador
{
    public function index()
    {
        # echo "Hola Estado";
        $obj = new Persona;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos' => $data['data']
        ];

        $home = $this->mostrar('personas/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Personas',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj = new Persona($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo()
    {
        # echo "Agregando..";
        $home = $this->mostrar('personas/formulario.php', null, true);

        $datos = [
            'titulo' => 'Nueva Persona',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar()
    {
        $id = $_GET['id'];
        // echo "Editando: ".$id;
        $obj = new Persona($id);
        $data = $obj->editar();
        # var_dump($data);exit;
        $datos = [
            'datos' => $data['data'][0]
        ];
        $home = $this->mostrar('personas/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Editar persona',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar()
    {
        # echo "Guardando..";
        # var_dump($_POST);exit;
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $Telefono = $_POST['Telefono'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $esNuevo = $_POST['esNuevo'];



        $obj = new Persona(
            $id, 
            $nombres,
            $apellidos,
            $dni,
            $correo,
            $direccion,
            $Telefono,
            $fechaNacimiento,
            $genero
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
}
