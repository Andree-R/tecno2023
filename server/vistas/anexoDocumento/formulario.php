<?php
$id = isset($datos['id'])?$datos['id']:'';
$nombre = isset($datos['nombre'])?$datos['nombre']:'';
$idDocumento = isset($datos['idDocumento'])?$datos['idDocumento']:'';
$descripcion = isset($datos['descripcion'])?$datos['descripcion']:'';
$url = isset($datos['url'])?$datos['url']:'';
$esNuevo = isset($datos['id'])?0:1;
?>
    <form class="form-group" action="?ctrl=CtrlAnexoDocumento&accion=guardar" method="post">
        Id:
        <input class="form-control" type="text" name="id" value="<?=$id?>">
        <input class="form-control" type="hidden" name="esNuevo" value="<?=$esNuevo?>">
        <br>
        Nombre:
        <input class="form-control" type="text" name="nombre" value="<?=$nombre?>">
        <br>
        Descripción:
        <input class="form-control" type="text" name="descripcion" value="<?=$descripcion?>">
        <br>
        URL:
        <input class="form-control" type="text" name="url" value="<?=$url?>">
        <br>
        Id de Documento:
        <select class="custom-select" name="idDocumento" id="">
            <?php
            $esSeleccionado=null;
            
            if (is_array ($Doc))
            foreach ($Doc as $idD) { 
                $esSeleccionado='';
                if($idDocumento === $idD['id'])
                    $esSeleccionado='selected';
            ?>
                
                <option <?=$esSeleccionado?> value="<?=$idD['id']?>"> <?=$idD['numero']?></option>
            <?php
            }
            ?>
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar">

    </form>

    <a href="?ctrl=CtrlAnexoDocumento">Retornar</a>