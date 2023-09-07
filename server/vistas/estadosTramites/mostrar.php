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
    <a class="btn btn-success" href="?ctrl=CtrlEstadosTramites&accion=nuevo">Nuevo Estado</a>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        <?php
        if (is_array($datos))
            foreach ($datos as $d) {
        ?>
            <tr>
                <td>
                    <?= $d['id'] ?>
                </td>
                <td>
                    <?= $d['estado'] ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="?ctrl=CtrlEstadosTramites&accion=editar&id=<?= $d['id'] ?>">
                        Editar
                    </a>
                    <a class="btn btn-danger" href="?ctrl=CtrlEstadosTramites&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

                </td>
            </tr>

        <?php
            }
        ?>

    </table>

    <a class="btn btn-secondary" href="?">Retornar</a>
</body>

</html>