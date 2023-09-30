<a class="btn btn-success" href="?ctrl=CtrlEstadosTramites&accion=nuevo">Nuevo Estado de Tramite</a>
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