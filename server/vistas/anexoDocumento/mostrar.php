
<a href="?ctrl=CtrlAnexoDocumento&accion=nuevo">Nuevo Anexo de Documento</a>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Url</th>
            <th>Id de Documento</th>
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
        <?=$d['nombre']?>
    </td>
    <td>
        <?=$d['descripcion']?>
    </td>
    <td>
        <?=$d['url']?>
    </td>
    <td>
        <?=$d['idDocumento']?>
    </td>
    <td>
        <a href="?ctrl=CtrlAnexoDocumento&accion=editar&id=<?=$d['id']?>">
            Editar
        </a>
        <a href="?ctrl=CtrlAnexoDocumento&accion=eliminar&id=<?=$d['id']?>">Eliminar</a>
        
    </td>
</tr>

<?php
}
?>

    </table>

    <a href="?">Retornar</a>
