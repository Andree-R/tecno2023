<?php
# require_once './core/Modelo.php';
require_once 'Persona.php';

class ServidorPublico extends Persona
{
    private $id;
    private $idCargo;
    private $fecha_inicio;
    private $fecha_fin;
    private $_tabla = 'servidores_publicos';
    private $_vista = 'v_servidores_publicos ';

    public function __construct(
        $id = null,
        $nombres = null,
        $apellidos = null,
        $DNI = null,
        $correo = null,
        $fechaNacimiento = null,
        $direccion = null,
        $telefono = null,
        $genero = null,

        $idCargo = null,
        $fecha_inicio = null,
        $fecha_fin = null,
    ) {
        $this->id = $id;
        $this->idCargo = $idCargo;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;

        parent::__construct(
            $id,
            $nombres,
            $apellidos,
            $DNI,
            $correo,
            $direccion,
            $telefono,
            $fechaNacimiento,
            $genero,
        );

        #  parent::__construct($this->_tabla);
    }
    public function getTodo()
    {
        $this->setTabla($this->_vista);
        return $this->getAll();
    }

    public function eliminar()
    {
        $this->setTabla($this->_tabla);
        $this->deleteById($this->id);
        # var_dump($this->_tabla);exit;
        $this->setTabla('servidores_publicos');
        parent::eliminar();
    }
    public function guardar()
    {
        parent::guardar();
        $datos = [
            'id' => $this->id,
            'idCargo' => "$this->idCargo",
            // 'fecha_inicio' => "$this->fecha_inicio",
            // 'fecha_fin' => "$this->fecha_fin",
        ];
        $this->setTabla('servidores_publicos');
        return $this->insert($datos);
    }
    public function editar()
    {
        $this->setTabla($this->_vista);
        return $this->getById($this->id);
    }
    public function actualizar()
    {
        parent::actualizar();
        $datos = [
            'id' => $this->id,
            'idCargo' => "$this->idCargo",
            'fecha_inicio' => "$this->fecha_inicio",
            'fecha_fin' => "$this->fecha_fin",
        ];
        $this->setTabla('estudiantes');
        $wh = "id=$this->id";
        return $this->update($wh, $datos);
    }
}
