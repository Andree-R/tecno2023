<table class="table">
  <tr>
    <th>Módulo</th>
    <th>Perfil</th>
    <th>Opciones</th>
  </tr>



<?php

foreach ($datos as $d) {
?>
  <tr>
    <td><?= $d["modulo"] ?></td>
    <td><?= $d["perfil"] ?></td>
    <td><a href="?ctrl=CtrlPersona&accion=accederModulo&idModulo=<?= $d["idmodulo"] ?>&idPerfil=<?= $d["idperfil"] ?>&id=<?= $d["idpersona"] ?>">Acceder</a></td>
  </tr>
<?php

}
?>
</table>
