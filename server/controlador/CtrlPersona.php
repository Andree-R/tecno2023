<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Persona.php';
require_once "./helpers/helper.php";

class CtrlPersona extends Controlador
{

    public function index()
    {
        // $this->verificarLogin();
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


    public function showLogin()
    {
        $home = $this->mostrar('personas/login.php', null, true);

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function validar()
    {
        # echo "Validando datos";
        $user = $_POST['usuario'];
        $contraseña = $_POST['clave'];
        $obj = new Persona();
        $data = $obj->validar($user, $contraseña);

        $_SESSION["id"] = $data[0]["id"];

        // var_dump("<pre>",$data,"</pre>");exit;
        /* if (!is_null($data)) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['usuario'] = $data['usuario'];
            $_SESSION['nombre'] = $data['nombres'] . ' ' . $data['apellidos'];

            $_SESSION['menu'] = $this->getMenu();

            # var_dump($_SESSION);exit;
        } */

        if (is_null($data)) {
            header("Location: ?");
        } else{
            $datos = [
                'datos' => $data
            ];
            $home = $this->mostrar('personas/perfiles.php', $datos, true);
    
            $datos = [
                'titulo' => 'Opciones de perfil',
                'contenido' => $home,
                // 'menu' => $_SESSION['menu']
            ];
    
            $this->mostrar('./plantilla/home.php', $datos);
        }
    }

    public function accederModulo(){
        $idModulo = $_GET["idModulo"];
        $idPerfil = $_GET["idPerfil"];
        $idPersona = $_GET["id"];

        $_SESSION["menu"] = Helper::getMenu($idModulo,$idPerfil);
        header("Location: ?");

    }

    public function logout()
    {
        // echo "Ce";exit;
        session_destroy();
        header("Location: ?");
    }

    public function inbox(){
        $home = $this->mostrar('personas/inbox.php', null, true);

        

        $datos = [
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function getMessages(){

    }

    public function getMenu()
    {
        return [
            'CtrlPersona&accion=inbox' => 'Inbox',
            'CtrlAnexoDocumento' => 'Anexos',
            'CtrlCargo' => 'Cargos',
            'CtrlEstado' => 'Estados',
            'CtrlEstudiante' => 'Estudiante',
            'CtrlServidorPublico' => 'Servidores Públicos',
            'CtrlOficina' => 'Oficinas',
            'CtrlTiposDocumentos' => 'Tipos de Documentos',
            'CtrlTramiteDocumentario' => 'Tramites documentarios',
            'CtrlEstadosTramites' => 'Estados de tramites',
            'CtrlDocumento' => 'Documentos',
            'CtrlPersona' => 'Personas',
            #  'CtrlFactorForma'=>'Factores de Forma',
            'CtrlCtaContable' => 'Cuentas Contables',
            'CtrlAnexoDocumento' => 'Anexos de Documentos',
            'CtrlConceptoPago' => 'Conceptos de Pago',
        ];
    }
}
