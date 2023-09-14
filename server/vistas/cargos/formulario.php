<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$nombre = isset($datos['nombre']) ? $datos['nombre'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo Cargo' : 'Editando Cargo';
?>
<h1><?= $titulo ?></h1>
<form class="form-group" action="?ctrl=CtrlCargo&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Cargo:
    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Guardar">

</form>

<!-- <a href="?ctrl=CtrlCargo">Retornar</a> -->