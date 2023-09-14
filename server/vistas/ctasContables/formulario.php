<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$nombre = isset($datos['cuenta']) ? $datos['cuenta'] : '';
$descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nueva Cta. Contable' : 'Editando Cta. Contable';
?>
<form class="form-group" action="?ctrl=CtrlCtaContable&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Cta. Contable:
    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
    <br>
    Descripción:
    <input class="form-control" type="text" name="descripcion" value="<?= $descripcion ?>">
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Guardar">

</form>

<!-- <a href="?ctrl=CtrlCtaContable">Retornar</a> -->