<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$estado = isset($datos['estado']) ? $datos['estado'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo estado de tramite' : 'Editando estado de tramite';

?>

<form class="form-group" action="?ctrl=CtrlEstadosTramites&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Estado de tramites:
    <input class="form-control" type="text" name="estado" value="<?= $estado ?>">
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Guardar">

</form>

<!-- <a class="btn btn-primary" href="?ctrl=CtrlEstadosTramites">Retornar</a> -->