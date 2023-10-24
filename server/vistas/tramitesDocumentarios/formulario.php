<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$fecha_recepcion = isset($datos['fecha_recepcion']) ? $datos['fecha_recepcion'] : '';
$fecha_envio = isset($datos['fecha_envio']) ? $datos['fecha_envio'] : '';
$idOficinaOrigen = isset($datos['idOficinaOrigen']) ? $datos['idOficinaOrigen'] : '';
$idOficinaDestino = isset($datos['idOficinaDestino']) ? $datos['idOficinaDestino'] : '';
$idEstado = isset($datos['idEstado']) ? $datos['idEstado'] : '';
$idDocumento = isset($datos['idDocumento']) ? $datos['idDocumento'] : '';

$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo Cargo' : 'Editando Cargo';

?>

<form class="form-group" action="?ctrl=CtrlTramiteDocumentario&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Documento:
    <select class="custom-select" name="idDocumento" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($documentos))
            foreach ($documentos as $c) {
                $esSeleccionado = '';
                if ($idDocumento === $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['numero'] ?></option>
        <?php
            }
        ?>

    </select>
    <br>
    Fecha de recepcion:
    <input class="form-control" type="datetime-local" name="fecha_recepcion" value="<?= $fecha_recepcion ?>">
    <br>
    Fecha de envio:
    <input class="form-control" type="datetime-local" name="fecha_envio" value="<?= $fecha_envio ?>">
    <br>
    Oficina Origen:
    <select class="custom-select" name="idOficinaOrigen" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($oficinas))
            foreach ($oficinas as $c) {
                $esSeleccionado = '';
                if ($idOficinaOrigen === $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['nombre'] ?></option>
        <?php
            }
        ?>

    </select>
    Oficina Destino:
    <select class="custom-select" name="idOficinaDestino" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($oficinas))
            foreach ($oficinas as $c) {
                $esSeleccionado = '';
                if ($idOficinaDestino === $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['nombre'] ?></option>
        <?php
            }
        ?>

    </select>
    Estado:
    <select class="custom-select" name="idEstado" id="">
        <?php
        $esSeleccionado = null;
        if (is_array($estadosTramites))
            foreach ($estadosTramites as $c) {
                $esSeleccionado = '';
                if ($idEstado === $c['id'])
                    $esSeleccionado = 'selected';
        ?>

            <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['estado'] ?></option>
        <?php
            }
        ?>

    </select>
    
    <!-- <input type="text" name="idCta" value="<?= $idCta ?>"> -->
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Guardar">

</form>

<!-- <a href="?ctrl=CtrlTramiteDocumentario">Retornar</a> -->