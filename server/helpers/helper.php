<?php

abstract class Helper
{
    public static function verificarLogin()
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ?");
            exit();
        }
    }
    public static function getMenu($idM, $idP)
    {

        switch ($idM) {
            case 1:   # Tramite Documentario
                switch ($idP) {
                    case 1:   #Administrador
                        $menu = self::getMenuTramiteAdmin();
                        break;
                    case 2:   #Docente
                        $menu = self::getMenuTramiteDocente();
                        break;
                    case 3:   #Estudiante
                        $menu = self::getMenuTramiteEstudiante();
                        break;
                    case 4:   #Administrativo
                        $menu = self::getMenuTramiteAdministrativo();
                        break;

                    default:    #Visitante
                        $menu = self::getMenuTramiteVisitante();
                        break;
                }

                break;
            case '2':   # Caja
                switch ($idP) {
                    case '1':   #Administrador
                        $menu = self::getMenuCajaAdmin();
                        break;
                    case '2':   #Docente
                        $menu = self::getMenuCajaDocente();
                        break;
                    case '3':   #Estudiante
                        $menu = self::getMenuCajaEstudiante();
                        break;
                    case '4':   #Administrativo
                        $menu = self::getMenuCajaAdministrativo();
                        break;

                    default:    #Visitante
                        $menu = self::getMenuCajaVisitante();
                        break;
                }
                break;

            default:
                # code...
                break;
        }

        return $menu;
    }
    private static function getMenuTramiteAdmin()
    {
        return [
            'CtrlCargo' => 'Cargos',
            'CtrlEstado' => 'Estados',
            #  'CtrlFactorForma'=>'Factores de Forma',
            'CtrlCtaContable' => 'Cuentas Contables',
            'CtrlConceptoPago' => 'Conceptos de Pago',
            'CtrlEstudiante' => 'Estudiante',
        ];
    }
    private static function getMenuTramiteAdministrativo()
    {
        return [
            'CtrlAnexoDocumento' => 'Anexos',
            'CtrlTiposDocumentos' => 'Tipos de Documentos',
            'CtrlOficina' => 'Oficinas',
            'CtrlDocumento' => 'Documentos',
            'CtrlTramiteDocumentario' => 'Tramites documentarios',
            'CtrlEstadosTramites' => 'Estados de tramites',


        ];
    }
    private static function getMenuTramiteDocente()
    {
        return [
            'CtrlCargo' => 'Cargos',
            'CtrlEstado' => 'Estados',

        ];
    }
    private static function getMenuTramiteEstudiante()
    {
        return [

            'CtrlPersona&accion=inbox' => 'Bandeja',
            'CtrlEstado' => 'Estados',
            'CtrlEstado' => 'Estados',

        ];
    }
    private static function getMenuTramiteVisitante()
    {
        return [];
    }
    private static function getMenuCajaAdmin()
    {
        return [
            'CtrlCargo' => 'Cargos',
            'CtrlEstado' => 'Estados',
            #  'CtrlFactorForma'=>'Factores de Forma',
            'CtrlCtaContable' => 'Cuentas Contables',
            'CtrlConceptoPago' => 'Conceptos de Pago',
            'CtrlEstudiante' => 'Estudiante',
        ];
    }
    private static function getMenuCajaAdministrativo()
    {
        return [
            #  'CtrlFactorForma'=>'Factores de Forma',
            'CtrlCtaContable' => 'Cuentas Contables',
            'CtrlConceptoPago' => 'Conceptos de Pago',
            'CtrlEstudiante' => 'Estudiante',
        ];
    }
    private static function getMenuCajaDocente()
    {
        return [
            'CtrlCargo' => 'Cargos',
            'CtrlEstado' => 'Estados',

        ];
    }
    private static function getMenuCajaEstudiante()
    {
        return [

            'CtrlEstado' => 'Estados',

        ];
    }
    private static function getMenuCajaVisitante()
    {
        return [];
    }

    private static function getSocket()
    {
        $clients = array();
        $port = 8181;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($socket, '127.0.0.1', $port);
        socket_listen($socket);
        socket_set_nonblock($socket);

        while (true) {
            if (($newc = socket_accept($socket)) !== false) {
                echo "Client $newc has connected\n";
                $clients[] = $newc;
            }
        }
    }

    
}
