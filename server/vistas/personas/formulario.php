<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$nombres = isset($datos['nombres']) ? $datos['nombres'] : '';
$apellidos = isset($datos['apellidos']) ? $datos['apellidos'] : '';
$dni = isset($datos['dni']) ? $datos['dni'] : '';
$correo = isset($datos['correo']) ? $datos['correo'] : '';
$direccion = isset($datos['direccion']) ? $datos['direccion'] : '';
$Telefono = isset($datos['Telefono']) ? $datos['Telefono'] : '';
$fechaNacimiento = isset($datos['fechaNacimiento']) ? $datos['fechaNacimiento'] : '';
$genero = isset($datos['genero']) ? $datos['genero'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo Cargo' : 'Editando Cargo';
?>
<form class="form-group" action="?ctrl=CtrlPersona&accion=guardar" method="post">
    id:
    <input class="form-control" type="text" name="id" value="<?= $id ?>">
    <input class="form-control" type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
    <br>
    Nombres:
    <input class="form-control" type="text" name="nombres" value="<?= $nombres ?>">
    <br>
    Apellidos:
    <input class="form-control" type="text" name="apellidos" value="<?= $apellidos ?>">
    <br>
    DNI:
    <input class="form-control" type="text" name="dni" value="<?= $dni ?>">
    <br>
    Correo:
    <input class="form-control" type="text" name="correo" value="<?= $correo ?>">
    <br>
    Dirección:
    <input class="form-control" type="text" name="direccion" value="<?= $direccion ?>">
    <br>
    Teléfono:
    <input class="form-control" type="text" name="Telefono" value="<?= $Telefono ?>">
    Fecha de Nacimiento:
    <input class="form-control" type="datetime-local" name="fechaNacimiento" value="<?= $fechaNacimiento ?>">
    <br>
    Genero:<br>
    <input type="radio" name="genero" <?= ($genero == 0) ? 'checked' : '' ?> value="0">Masculino
    <br>
    <input type="radio" name="genero" <?= ($genero == 1) ? 'checked' : '' ?> value="1">Femenino
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Guardar">

</form>

<!-- <a href="?ctrl=CtrlPersona">Retornar</a> -->