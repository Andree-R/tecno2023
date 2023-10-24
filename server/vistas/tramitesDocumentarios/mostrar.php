<a href="#" class="btn btn-primary nuevo">
    <i class="fa fa-plus"></i>
    Nuevo Tramite Documentario
</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Documento</th>
        <th>Fecha de Recepcion</th>
        <th>Fecha de Envio</th>
        <th>Oficina Origen</th>
        <th>Oficina Destino</th>
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
                <?= $d['documento'] ?>
            </td>
            <td>
                <?= $d['fecha_recepcion'] ?>
            </td>
            <td>
                <?= $d['fecha_envio'] ?>
            </td>
            <td>
                <?= $d['oficinaOrigen'] ?>
            </td>
            <td>
                <?= $d['oficinaDestino'] ?>
            </td>
            <td>
                <?= $d['estado'] ?>
            </td>
            <td>
                <a data-id="<?= $d["id"] ?>" href="#" class="btn btn-success editar">
                    <i class="fa fa-edit"></i>
                    Editar
                </a>
                <a data-id="<?= $d["id"] ?>" data-nombre="<?= $d["documento"] ?>" href="#" class="btn btn-danger eliminar">
                    <i class="fa fa-trash"></i>
                    Eliminar
                </a>

            </td>
        </tr>

    <?php
        }
    ?>

</table>

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
<!-- <a href="?">Retornar</a> -->