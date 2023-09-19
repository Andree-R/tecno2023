<?php
$id = isset($datos['id'])?$datos['id']:'';
$nombre = isset($datos['nombre'])?$datos['nombre']:'';
$idDocumento = isset($datos['idDocumento'])?$datos['idDocumento']:'';
$descripcion = isset($datos['descripcion'])?$datos['descripcion']:'';
$url = isset($datos['url'])?$datos['url']:'';
$esNuevo = isset($datos['id'])?0:1;
$titulo = $esNuevo==1?'Nuevo Anexo de Documento':'Editando el Anexo de Documento';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?=$titulo?></h1>
    <form action="?ctrl=CtrlAnexoDocumento&accion=guardar" method="post">
        Id:
        <input type="text" name="id" value="<?=$id?>">
        <input type="hidden" name="esNuevo" value="<?=$esNuevo?>">
        <br>
        Nombre:
        <input type="text" name="nombre" value="<?=$nombre?>">
        <br>
        Descripción:
        <input type="text" name="descripcion" value="<?=$descripcion?>">
        <br>
        URL:
        <input type="text" name="url" value="<?=$url?>">
        <br>
        Id de Documento:
        <select name="idDocumento" id="">
            <?php
            $esSeleccionado=null;
            
            if (is_array ($Doc))
            foreach ($Doc as $idD) { 
                $esSeleccionado='';
                if($Doc==$idD['id'])
                    $esSeleccionado='selected';
            ?>
                
                <option <?=$esSeleccionado?> value="<?=$idD['id']?>"> <?=$idD['idDocumento']?></option>
            <?php
            }
            ?>
        <br>
        <input type="submit" value="Guardar">

    </form>

    <a href="?ctrl=CtrlAnexoDocumento">Retornar</a>
</body>
</html>