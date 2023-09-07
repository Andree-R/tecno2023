<?php
$id = isset($datos['id']) ? $datos['id'] : '';
$tipo = isset($datos['tipo']) ? $datos['tipo'] : '';
$esNuevo = isset($datos['id']) ? 0 : 1;
$titulo = $esNuevo == 1 ? 'Nuevo tipo de documento' : 'Editando el tipo de documento';
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
    <form action="?ctrl=CtrlTiposDocumentos&accion=guardar" method="post">
        id:
        <input type="text" name="id" value="<?= $id ?>">
        <input type="hidden" name="esNuevo" value="<?= $esNuevo ?>">
        <br>
        Tipo de documento:
        <input type="text" name="tipo" value="<?= $tipo ?>">
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar">

    </form>

    <a class="btn btn-primary" href="?ctrl=CtrlTiposDocumentos">Retornar</a>
</body>

</html>