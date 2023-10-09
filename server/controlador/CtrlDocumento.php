<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Documento.php';
require_once './modelo/TiposDocumentos.php';
require_once './modelo/Oficina.php';
require_once './modelo/Persona.php';

class CtrlDocumento extends Controlador
{
    public function index()
    {
        # echo "Hola CtaContable";
        $obj = new Documento;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos' => $data['data']
        ];

        // var_dump("<pre>", $datos, "</pre>");
        // exit;

        $home = $this->mostrar('documentos/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Documentos',
            'contenido' => $home,
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj = new Documento($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo()
    {
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

        $home = $this->mostrar('documentos/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Documentos',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar()
    {
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj1 = new Documento($id);
        $dataDoc = $obj1->editar();

        $obj2 = new TiposDocumentos();
        $dataTipDoc = $obj2->getTodo();
        $obj3 = new Oficina();
        $dataOfic = $obj3->getTodo();
        $obj4 = new Persona();
        $dataPerson = $obj4->getTodo();

        $datos = [
            'datos' => $dataDoc['data'][0],
            "tipDoc" => $dataTipDoc["data"],
            "oficinas" => $dataOfic["data"],
            "personas" => $dataPerson["data"]
        ];


        $home = $this->mostrar('documentos/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Documentos',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar()
    {
        # echo "Guardando..";
        // var_dump("<pre>", $_POST, "</pre>");
        // exit;
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

        $obj = new Documento(
            $id,
            $idDocumento,
            $numero,
            $asunto,
            $fecha,
            $descripcion,
            $fecha_recepcion,
            $idTipo,
            $idOficina,
            $idPersona
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
