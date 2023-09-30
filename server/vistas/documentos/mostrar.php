<a class="btn btn-success" href="?ctrl=CtrlDocumento&accion=nuevo">Nuevo Documento</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Id Documento Referencia</th>
        <th>Número</th>
        <th>Asunto</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Fecha Recepción</th>
        <th>Tipo de documento</th>
        <th>Oficina Actual</th>
        <th>Persona</th>
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
                <?= $d['idDocumento'] ?>
            </td>
            <td>
                <?= $d['numero'] ?>
            </td>
            <td>
                <?= $d['asunto'] ?>
            </td>
            <td>
                <?= $d['fecha'] ?>
            </td>
            <td>
                <?= $d['descripcion'] ?>
            </td>
            <td>
                <?= $d['fecha_recepcion'] ?>
            </td>
            <td>
                <?= $d['idTipo'] ?>
            </td>
            <td>
                <?= $d['idOficina'] ?>
            </td>
            <td>
                <?= $d['idPersona'] ?>
            </td>
            <td>
                <a class="btn btn-warning" href="?ctrl=CtrlDocumento&accion=editar&id=<?= $d['id'] ?>">
                    Editar
                </a>
                <a class="btn btn-danger" href="?ctrl=CtrlDocumento&accion=eliminar&id=<?= $d['id'] ?>">Eliminar</a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<!-- <a href="?">Retornar</a> -->