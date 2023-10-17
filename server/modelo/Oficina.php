<?php
require_once './core/Modelo.php';

class Oficina extends Modelo
{
    private $id;
    private $idOficina;
    private $nombre;
    private $idJefe;

    private $_tabla = 'oficinas';
    private $_vista = 'v_oficinas';

    public function __construct(
        $id = null,
        $idOficina = null,
        $nombre = null,
        $idJefe = null,
    ) {
        $this->id = $id;
        $this->idOficina = $idOficina;
        $this->nombre = $nombre;
        $this->idJefe = $idJefe;
        parent::__construct($this->_tabla);
    }
    public function getTodo()
    {
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function eliminar()
    {
        return $this->deleteById($this->id);
    }
    public function guardar()
    {
        var_dump("<pre>", $this->idJefe, "</pre>");
        $datos = [
            'id' => $this->id,
            'idOficina' => "$this->idOficina",
            'nombre' => "'$this->nombre'",
            'idJefe' => "$this->idJefe",
        ];
        return $this->insert($datos);
    }
    public function editar()
    {
        return $this->getById($this->id);
    }
    public function actualizar()
    {
        $datos = [
            'id' => $this->id,
            'idOficina' => "'$this->idOficina'",
            'nombre' => "'$this->nombre'",
            'idJefe' => "'$this->idJefe'",
        ];
        $wh = "id=$this->id";
        return $this->update($wh, $datos);
    }
}
