<a class="btn btn-success" href="?ctrl=CtrlPersona&accion=nuevo">Nueva Persona</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>DNI</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Fecha de Nacimiento</th>
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
                <?= $d['nombres'] ?>
            </td>
            <td>
                <?= $d['apellidos'] ?>
            </td>
            <td>
                <?= $d['dni'] ?>
            </td>
            <td>
                <?= $d['correo'] ?>
            </td>
            <td>
                <?= $d['direccion'] ?>
            </td>
            <td>
                <?= $d['Telefono'] ?>
            </td>
            <td>
                <?= $d['fechaNacimiento'] ?>
            </td>
            <td>
                <a class="btn btn-warning" href="?ctrl=CtrlPersona&accion=editar&id=<?= $d['id'] ?>">
                    Editar
                </a>
                <a class="btn btn-danger" href="?ctrl=CtrlPersona&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<!-- <a class="btn btn-secondary" href="?">Retornar</a> -->