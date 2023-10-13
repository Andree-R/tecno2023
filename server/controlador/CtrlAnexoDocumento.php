<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/AnexoDocumento.php';
require_once './modelo/Documento.php';

class CtrlAnexoDocumento extends Controlador {
    public function index(){
        # echo "Hola CtaContable";
        $obj = new AnexoDocumento;
        $data = $obj->getTodo();

        # var_dump($data);exit;

        $datos = [
            'datos'=>$data['data']
        ];
        
        $home = $this->mostrar('anexoDocumento/mostrar.php', $datos, true);

        $datos = [
            'titulo' => 'Anexos de Documentos',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }

    public function eliminar(){
        $id = $_GET['id'];
        # echo "eliminando: ".$id;
        $obj =new AnexoDocumento ($id);
        $obj->eliminar();

        $this->index();
    }
    public function nuevo(){
        # echo "Agregando..";
        $obj1 = new Documento();
        $Doc = $obj1->getTodo();
        $datos = [
            "Doc" => $Doc["data"],
        ];
        $this->mostrar('anexoDocumento/formulario.php', $datos, null);

        // $datos = [
        //     'titulo' => 'Nuevo anexo de documento',
        //     'contenido' => $home,
        //     'menu' => $_SESSION['menu']
        // ];

        // $this->mostrar('./plantilla/home.php', $datos);
    }
    public function editar(){
        $id = $_GET['id'];
        # echo "Editando: ".$id;
        $obj = new AnexoDocumento($id);
        $data = $obj->editar();

        $obj = new Documento();
        $dataDoc = $obj->getTodo();
        # var_dump($data);exit;
        $datos = [
            'datos'=>$data['data'][0],
            'Doc'=>$dataDoc['data']
        ];
        $home = $this->mostrar('anexoDocumento/formulario.php', $datos, true);

        $datos = [
            'titulo' => 'Editando anexo de documento',
            'contenido' => $home,
            'menu' => $_SESSION['menu']
        ];

        $this->mostrar('./plantilla/home.php', $datos);
    }
    public function guardar(){
        # echo "Guardando..";
        $id = $_POST['id'];
        $nombre= $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $url = $_POST['url'];
        $idDocumento = $_POST['idDocumento'];
        $esNuevo = $_POST['esNuevo'];

        $obj = new AnexoDocumento (
            $id,
            $idDocumento,
            $nombre,
            $descripcion,
            $url
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