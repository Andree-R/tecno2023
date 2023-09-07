<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$estado = isset($datos['estado']) ? $datos['estado'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo estado de tramite' : 'Editando estado de tramite';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>

<body>
    <h1><?= $titulo ?></h1>
    <form action="?ctrl=CtrlEstadosTramites&accion=guardar" method="post">
        id:
        <input type="text" name="id" value="<?= $id ?>">
        <input type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
        <br>
        nombre:
        <input type="text" name="estado" value="<?= $estado ?>">
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar">

    </form>

    <a class="btn btn-primary" href="?ctrl=CtrlEstadosTramites">Retornar</a>
</body>

</html>