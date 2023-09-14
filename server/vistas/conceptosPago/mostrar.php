
<a class="btn btn-success" href="?ctrl=CtrlConceptoPago&accion=nuevo">Nuevo Concepto Pago</a>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Monto</th>
            <th>Cuenta</th>
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
        <?=$d['nombre']?>
    </td>
    <td>
        <?=$d['monto']?>
    </td>
    <td>
        <?=$d['idCta']?>
    </td>
    <td>
        <a class="btn btn-warning" href="?ctrl=CtrlConceptoPago&accion=editar&id=<?=$d['id']?>">
            Editar
        </a>
        <a class="btn btn-danger" href="?ctrl=CtrlConceptoPago&accion=eliminar&id=<?=$d['id']?>">Eliminar</a>
        
    </td>
</tr>

<?php
}
?>

    </table>

    <!-- <a href="?">Retornar</a> -->
