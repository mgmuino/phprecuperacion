<?php
require_once 'conecta.php'; 

//Recoger datos de vuelta si los hay
$nombre = (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"";
$fecha_nacimiento = (isset($_REQUEST['fecha_nacimiento']))?$_REQUEST['fecha_nacimiento']:"";
$ciclo = (isset($_REQUEST['ciclo']))?$_REQUEST['ciclo']:"";
$nota_media = (isset($_REQUEST['nota_media']))?$_REQUEST['nota_media']:"";

//Errores
if (isset($_REQUEST['errornombre'])) {
    $msg_errornombre="ERROR: Nombre no valido...";
} else {
    $msg_errornombre="";
}
if (isset($_REQUEST['errorfecha'])) {
    $msg_errorfecha="ERROR: Fecha no valida...";
} else {
    $msg_errorfecha="";
}
if (isset($_REQUEST['errorciclo'])) {
    $msg_errorciclo="ERROR: Ciclo no valido...";
} else {
    $msg_errorciclo="";
}
if (isset($_REQUEST['errornota'])) {
    $msg_errornota="ERROR: Nota no valida...";
} else {
    $msg_errornota="";
}


?>

<html>
    <head>
        <title>Recuperacion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="formulario">&nbsp;</div>
        <h1>Alta alumno</h1>
           <ul>           
                <li><a href="listado_alumnos.php">Listado</a></li>
          </ul>        
        <form action="proceso_alta.php" method="GET">
            <div>Nombre completo: <input <?php if($msg_errornombre !="") echo "class='error'"; ?> type="text" name="nombre_completo" value="<?php echo $nombre ?>"/><?php echo $msg_errornombre ?>
            </div>
            <div> Fecha de Nacimiento<input <input <?php if($msg_errorfecha !="") echo "class='error'"; ?> type="date" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento ?>"/><?php echo $msg_errorfecha ?>
            </div>
            <div> Ciclo<input <input <?php if($msg_errorciclo !="") echo "class='error'"; ?> type="text" name="ciclo" value="<?php echo $ciclo ?>"/><?php echo $msg_errorciclo ?>
            </div>
            <div> Nota media<input <input <?php if($msg_errornota !="") echo "class='error'"; ?> type="text" name="nota_media" value="<?php echo $nota_media ?>"/><?php echo $msg_errornota ?>
            </div>
            <input type="submit" value="Grabar" />
        </form>
    </body>
</html>