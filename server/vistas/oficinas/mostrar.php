<a href="#" class="btn btn-primary nuevo">
    <i class="fa fa-plus"></i> 
    Nuevo Oficina
</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Oficina</th>
        <th>Jefe</th>
        <th>Matriz</th>
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
                <?= $d['jefe'] ?>
            </td>
            <td>
                <?= $d['matriz'] ?>
            </td>
            <td>
                <a class="btn btn-warning" href="?ctrl=CtrlOficina&accion=editar&id=<?= $d['id'] ?>">
                    Editar
                </a>
                <a class="btn btn-danger" href="?ctrl=CtrlOficina&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<!-- <a class="btn btn-secondary" href="?">Retornar</a -->