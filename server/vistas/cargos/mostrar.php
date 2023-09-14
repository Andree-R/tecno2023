<a class="btn btn-success" href="?ctrl=CtrlCargo&accion=nuevo">Nuevo Cargo</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Cargo</th>
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
                <?= $d['nombre'] ?>
            </td>
            <td>
                <a class="btn btn-warning" href="?ctrl=CtrlCargo&accion=editar&id=<?= $d['id'] ?>">
                    Editar
                </a>
                <a class="btn btn-danger" href="?ctrl=CtrlCargo&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<!-- <a class="btn btn-secondary" href="?">Retornar</a> -->