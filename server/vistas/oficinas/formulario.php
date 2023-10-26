<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$nombre = isset($datos['nombre']) ? $datos['nombre'] : '';
$idJefe = isset($datos['idJefe']) ? $datos['idJefe'] : '';
$idOficina = isset($datos['idOficina']) ? $datos['idOficina'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo estado de tramite' : 'Editando estado de tramite';

?>
<form class="form-group" action="?ctrl=CtrlOficina&accion=guardar" method="post">
    
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Nombre:
    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
    <br>
    Jefe:
    <select class="custom-select" name="idJefe" id="">

        <option value=<?= "NULL" ?>></option>

        <?php
        $esSeleccionado = null;
        if (is_array($servidoresPublicos))
            foreach ($servidoresPublicos as $persona) {
                $esSeleccionado = '';

                if ($idJefe === $persona['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $persona['id'] ?>"> <?= $persona['nombres'] . " " .  $persona["apellidos"] ?></option>
        <?php
        }
        ?>

    </select>
    <br>
    Matriz:
    <?php
    // var_dump("<pre>", $oficinas[0]['id'], $idOficina, $oficinas, $oficinas[0]['id'] == $idOficina, "</pre>");
    ?>
    <select class="custom-select" name="idMatriz" id="">
        <option value=<?= "NULL" ?>></option>
        <?php
        $esSeleccionado = null;
        $selected = true;
        if (is_array($oficinas))
            foreach ($oficinas as $oficina) {
                $esSeleccionado = '';
                if ($idOficina === $oficina['id'])
                    $esSeleccionado = 'selected';
                $selected = false;

        ?>
            <option <?= $esSeleccionado ?> value="<?= $oficina['id'] ?>"> <?= $oficina['nombre'] ?></option>
        <?php
            }
        ?>

    </select>
    <!-- 
    <?php
    var_dump("<pre>", $selected, "</pre>");
    ?> -->
    <br>
    <input class="btn btn-primary" type="submit" value="Guardar">

</form>

<!-- <a class="btn btn-primary" href="?ctrl=CtrlOficina">Retornar</a> -->