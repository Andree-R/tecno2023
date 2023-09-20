<?php
session_start();
require_once './core/Controlador.php';
# require_once './modelo/Oficina.php';

class CtrlPrincipal extends Controlador {
    public function index(){
        # echo "Hola mundo";
        $_SESSION['menu'] = $this->getMenu();

        $datos = [
            "usuario" => "Walter",
        ];

        $datos = [
            'titulo'=>'Pagina principal',
            'contenido'=>$this->mostrar('principal.php',$datos,true),
            'menu'=>$_SESSION['menu']
        ];
        $this->mostrar('./plantilla/home.php',$datos);
        /* $obj = new Oficina();
        $data = $obj->mostrar();

        # var_dump($data);exit;

        $datos = [
            'menu'=>$this->getMenu(),
            'titulo'=>'Sistema IES.',
            'usuario'=>'Walter',
            'datos'=>$data['data']
        ];

        $this->mostrar('home.php',$datos); */

    }

    public function getMenu(){
        return [
            'CtrlAnexoDocumento'=>'Anexos',
            'CtrlCargo'=>'Cargos',
            'CtrlEstado'=>'Estados',
            'CtrlEstudiante'=>'Estudiante',
            'CtrlServidorPublico'=>'Servidores Públicos',
            'CtrlOficina'=>'Oficinas',
            'CtrlTiposDocumentos'=>'Tipos de Documentos',
            'CtrlEstadosTramites'=>'Estados de tramites',
            'CtrlDocumento'=>'Documentos',
            'CtrlPersona'=>'Personas',
           #  'CtrlFactorForma'=>'Factores de Forma',
            'CtrlCtaContable'=>'Cuentas Contables',
            'CtrlConceptoPago'=>'Conceptos de Pago',
        ];
    }
}