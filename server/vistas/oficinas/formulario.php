<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$nombre = isset($datos['nombre']) ? $datos['nombre'] : '';
$jefe = isset($datos['jefe']) ? $datos['jefe'] : '';
$matriz = isset($datos['matriz']) ? $datos['matriz'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo estado de tramite' : 'Editando estado de tramite';

?>
<form class="form-group" action="?ctrl=CtrlOficina&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    nombre:
    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
    <br>
    Jefe:
    <select class="custom-select" name="idJefe" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($servidoresPublicos))
            foreach ($servidoresPublicos as $c) {
                $esSeleccionado = '';
                if ($idCta == $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['nombres'] ." " .  $c["apellidos"] ?></option>
        <?php
            }
        ?>

    </select>
    <br>
    Matriz:
    <select class="custom-select" name="idMatriz" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($oficinas))
            foreach ($oficinas as $c) {
                $esSeleccionado = '';
                if ($idCta == $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['nombre'] ?></option>
        <?php
            }
        ?>

    </select>
    <br>
    <input class="btn btn-primary" type="submit" value="Guardar">

</form>

<!-- <a class="btn btn-primary" href="?ctrl=CtrlOficina">Retornar</a> -->