<?php
$id = isset($datos['id'])?$datos['id']:'';
$idDocumento = isset($datos['idDocumento'])?$datos['idDocumento']:'';
$numero = isset($datos['numero'])?$datos['numero']:'';
$asunto = isset($datos['asunto'])?$datos['asunto']:'';
$fecha = isset($datos['fecha'])?$datos['fecha']:'';
$descripcion = isset($datos['descripcion'])?$datos['descripcion']:'';
$fecha_recepcion = isset($datos['fecha_recepcion'])?$datos['fecha_recepcion']:'';
$idTipo = isset($datos['idTipo'])?$datos['idTipo']:'';
$idOficina = isset($datos['idOficina'])?$datos['idOficina']:'';
$idPersona = isset($datos['idPersona'])?$datos['idPersona']:'';
$esNuevo = isset($datos['id'])?0:1;
$titulo = $esNuevo==1?'Nuevo Documento':'Editando el Documento';
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
    <form action="?ctrl=CtrlDocumento&accion=guardar" method="post">
        id:
        <input type="text" name="id" value="<?=$id?>">
        <input type="hidden" name="esNuevo" value="<?=$esNuevo?>">
        <br>
        Id Documento Referencia:
        <input type="text" name="idDocumento" value="<?=$idDocumento?>">
        <br>
        Número:
        <input type="text" name="numero" value="<?=$numero?>">
        <br>
        Asunto:
        <input type="text" name="asunto" value="<?=$asunto?>">
        <br>
        Fecha:
        <input type="date" name="fecha" value="<?=$fecha?>">
        <br>
        Descripción:
        <input type="text" name="descripcion" value="<?=$descripcion?>">
        <br>
        Fecha Recepción:
        <input type="datetime-local" name="fecha_recepcion" value="<?=$fecha_recepcion?>">
        <br>
        Id Tipo de documento:
        <select name="idTipo" id="">
            <?php
            $esSeleccionado=null;
            if (is_array ($tipDoc))
            foreach ($tipDoc as $tip) { 
                $esSeleccionado='';
                if($idTipo==$tip['id'])
                    $esSeleccionado='selected';
            ?>
                
                <option <?=$esSeleccionado?> value="<?=$tip['id']?>"> <?=$tip['tipo']?></option>
            <?php
            }
            ?>

        </select>
        <br>
        Id Oficina Actual:
        <select name="idOficina" id="">
            <?php
            $esSeleccionado=null;
            if (is_array($oficinas))
            foreach ($oficinas as $ofic) { 
                $esSeleccionado='';
                if($idOficina==$ofic['id'])
                    $esSeleccionado='selected';
            ?>
                
                <option <?=$esSeleccionado?> value="<?=$ofic['id']?>"> <?=$ofic['nombre']?></option>
            <?php
            }
            ?>

        </select>
        <br>
        Id Persona:
        <select name="idPersona" id="">
            <?php
            $esSeleccionado=null;

            if (is_array ($personas))
            foreach ($personas as $person) { 
                $esSeleccionado='';
                if($idPersona==$person['id'])
                    $esSeleccionado='selected';
            ?>
                
                <option <?=$esSeleccionado?> value="<?=$person['id']?>"> <?=$person['nombres'] . " " . $person["apellidos"]?></option>
            <?php
            }
            ?>

        </select>
        <br>
        <input type="submit" value="Guardar">

    </form>

    <a href="?ctrl=CtrlDocumento">Retornar</a>
</body>
</html>