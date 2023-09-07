<?php
require_once './core/Modelo.php';

class Persona extends Modelo {
    private $id;
    private $nombres;
    private $apellidos;
    private $dni;
    private $correo;
    private $fechaNacimiento;
    private $usuario;
    private $password;
    private $direccion;
    private $telefono;
    private $_tabla='personas';

    public function __construct(
        $id=null,
        $nombres=null,
        $apellidos=null,
        $dni=null,
        $correo=null,
        $fechaNacimiento=null,
        $usuario=null,
        $password=null,
        $direccion=null,
        $telefono=null
        ){
        $this->id = $id;
        $this->nombres=$nombres;
        $this->apellidos=$apellidos;
        $this->dni=$dni;
        $this->correo=$correo;
        $this->fechaNacimiento=$fechaNacimiento;
        $this->usuario=$usuario;
        $this->password=$password;
        $this->direccion=$direccion;
        $this->telefono=$telefono;
        parent::__construct($this->_tabla);
    }
    public function getTodo(){
        return $this->getAll();
    }
    public function eliminar(){
        return $this->deleteById($this->id);
    }
    public function guardar(){
        $datos = [
            'id'=>$this->id,
            'nombre'=>"'$this->estado'",
            'idJefe'=>"'$this->estado'",
        ];
        return $this->insert($datos);
    }
    public function editar(){
        return $this->getById($this->id);
    }
    public function actualizar(){
        $datos = [
            'id'=>$this->id,
            'estado'=>"'$this->estado'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh,$datos);
    }
}