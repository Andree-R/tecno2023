<a href="#" class="btn btn-primary nuevo">
    <i class="fa fa-plus"></i>
    Nuevo Documento
</a>
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
                <a data-id="<?= $d["id"] ?>" href="#" class="btn btn-success editar">
                    <i class="fa fa-edit"></i>
                    Editar
                </a>
                <a data-id="<?= $d["id"] ?>" data-nombre="<?= $d["numero"] ?>" href="#" class="btn btn-danger eliminar">
                    <i class="fa fa-trash"></i>
                    Eliminar
                </a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

<a href="?">Retornar</a>

<div class="modal fade " id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cargos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Cargando Cargos...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(() => {

        $('#nuevo').click(function(e) {
            e.preventDefault();
            // alert('nuevo')

            $('#modal-lg').modal('show')
        });
    });
</script>