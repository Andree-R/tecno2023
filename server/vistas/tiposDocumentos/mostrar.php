<a class="btn btn-success" href="?ctrl=CtrlTiposDocumentos&accion=nuevo">Nuevo tipo</a>
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
                <?= $d['tipo'] ?>
            </td>
            <td>
                <a class="btn btn-warning" href="?ctrl=CtrlTiposDocumentos&accion=editar&id=<?= $d['id'] ?>">
                    Editar
                </a>
                <a class="btn btn-danger" href="?ctrl=CtrlTiposDocumentos&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<!-- <a class="btn btn-secondary" href="?">Retornar</a> -->