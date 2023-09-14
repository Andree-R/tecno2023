<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$tipo = isset($datos['tipo']) ? $datos['tipo'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo tipo de documento' : 'Editando el tipo de documento';
?>
<form class="form-group" action="?ctrl=CtrlTiposDocumentos&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Tipo de documento:
    <input class="form-control" type="text" name="tipo" value="<?= $tipo ?>">
    <br>
    <input class="btn btn-primary mb-2" class="btn btn-primary" type="submit" value="Guardar">

</form>

<!-- <a class="btn btn-primary" href="?ctrl=CtrlTiposDocumentos">Retornar</a> -->