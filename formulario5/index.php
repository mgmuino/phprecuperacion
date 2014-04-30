<?php
//Recoger datos de vuelta silos hay
$nombre=(isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"";
$fechanacimiento=(isset($_REQUEST['fechanacimiento']))?$_REQUEST['fechanacimiento']:"";
$email=(isset($_REQUEST['email']))?$_REQUEST['email']:"";
$sexo=(isset($_REQUEST['sexo']))?$_REQUEST['sexo']:"";
$familianumerosa=(isset($_REQUEST['familianumerosa']))?True:False;

//Errores
if (isset($_REQUEST['errornombre'])) {
    $msg_errornombre="ERROR: Nombre no valido...";
} else {
    $msg_errornombre="";
}
if (isset($_REQUEST['erroredad'])) {
    $msg_erroredad="ERROR: Fecha no valida...";
} else {
    $msg_erroredad="";
}
if (isset($_REQUEST['erroremail'])) {
    $msg_erroremail="ERROR: Email no valido...";
} else {
    $msg_erroremail="";
}
if (isset($_REQUEST['errorsexo'])) {
    $msg_errorsexo="ERROR: Sexo no seleccionado...";
} else {
    $msg_errorsexo="";
}


?>
    
<html>
    <head>
        <link href="estilo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>Formulario 4</div>
        <form action="recoge.php" method="GET"> 
        <div>
        <p>Nombre: <input <?php if($msg_errornombre !="") echo "class='error'"; ?> type="text" name="nombre" value="<?php echo $nombre ?>"/><?php echo $msg_errornombre ?></p>
        </div>
        <p>Fecha de nacimiento: <input <?php if($msg_erroredad !="") echo "class='error'"; ?> type="date" name="fechanacimiento" value="<?php echo $fechanacimiento ?>"/><?php echo $msg_erroredad ?></p>
        <p>Email: <input <?php if($msg_erroremail !="") echo "class='error'"; ?> type="text" name="email" value="<?php echo $email ?>"/><?php echo $msg_erroremail ?></p>
        <p>Sexo:<select <?php if($msg_errorsexo !="") echo "class='error'"; ?> name="sexo">
                    <option <?php if($sexo == "Selecciona") echo "selected='selected'"; ?> value="Selecciona">Selecciona...</option>
                    <option <?php if($sexo == "Mujer") echo "selected='selected'";?> value="Mujer">Mujer</option>
                    <option <?php if($sexo == "Hombre") echo "selected='selected'";?> value="Hombre">Hombre</option>
                </select><?php echo $msg_errorsexo ?></p>
        <p>Familia Numerosa:    <input type="checkbox" <?php if($familianumerosa) echo "checked='checked'"; ?>name="familianumerosa" value="Si"</>
        </p>
        <p><input type="submit" value="enviar" /></p>
        </form>
    </body>
</html>
