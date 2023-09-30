
<a class="btn btn-success" href="?ctrl=CtrlTramiteDocumentario&accion=nuevo">Nuevo Tramite Documentario</a>
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
        <?=$d['id']?>
    </td>
    <td>
        <?=$d['documento']?>
    </td>
    <td>
        <?=$d['fecha_recepcion']?>
    </td>
    <td>
        <?=$d['fecha_envio']?>
    </td>
    <td>
        <?=$d['oficinaOrigen']?>
    </td>
    <td>
        <?=$d['oficinaDestino']?>
    </td>
    <td>
        <?=$d['estado']?>
    </td>
    <td>
        <a class="btn btn-warning" href="?ctrl=CtrlTramiteDocumentario&accion=editar&id=<?=$d['id']?>">
            Editar
        </a>
        <a class="btn btn-danger" href="?ctrl=CtrlTramiteDocumentario&accion=eliminar&id=<?=$d['id']?>">Eliminar</a>
        
    </td>
</tr>

<?php
}
?>

    </table>

    <!-- <a href="?">Retornar</a> -->
