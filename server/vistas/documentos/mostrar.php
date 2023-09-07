<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <h1><?=$titulo?></h1>
<a href="?ctrl=CtrlDocumento&accion=nuevo">Nuevo Documento</a>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Id Documento Referencia</th>
            <th>Número</th>
            <th>Asunto</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Fecha Recepción</th>
            <th>Id Tipo de documento</th>
            <th>Id Oficina Actual</th>
            <th>Id Persona</th>
            <th>Opciones</th>
        </tr>
<?php
if (is_array($datos))
foreach ($datos as $d) {
    ?>
<tr>
    <td>
        <?=$d['id']?>
    </td>
    <td>
        <?=$d['idDocumento']?>
    </td>
    <td>
        <?=$d['numero']?>
    </td>
    <td>
        <?=$d['asunto']?>
    </td>
    <td>
        <?=$d['fecha']?>
    </td>
    <td>
        <?=$d['descripcion']?>
    </td>
    <td>
        <?=$d['fecha_recepcion']?>
    </td>
    <td>
        <?=$d['idTipo']?>
    </td>
    <td>
        <?=$d['idOficina']?>
    </td>
    <td>
        <?=$d['idPersona']?>
    </td>
    <td>
        <a href="?ctrl=CtrlDocumento&accion=editar&id=<?=$d['id']?>">
            Editar
        </a>
        <a href="?ctrl=CtrlDocumento&accion=eliminar&id=<?=$d['id']?>">Eliminar</a>
        
    </td>
</tr>

<?php
}
?>

    </table>

    <a href="?">Retornar</a>
</body>
</html>