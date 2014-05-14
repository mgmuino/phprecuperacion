<?php
//Recoger datos de vuelta silos hay
$email=(isset($_REQUEST['email']))?$_REQUEST['email']:"";
$password=(isset($_REQUEST['password']))?$_REQUEST['password']:"";


if (isset($_REQUEST['erroremail'])) {
    $msg_erroremail="ERROR: Email no valido...";
} else {
    $msg_erroremail="";
}
if (isset($_REQUEST['errorpassword'])) {
    $msg_errorpassword="ERROR: Password no valida...";
} else {
    $msg_errorpassword="";
}

?>
    
<html>
    <head>
        <link href="estilo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>Formulario 4</div>
        <form action="recoge.php" method="GET">          
        <div>Email: <input <?php if($msg_erroremail !="") echo "class='error'"; ?> type="text" name="email" value="<?php echo $email ?>"/><?php echo $msg_erroremail ?></div>
        <div>Password: <input <?php if($msg_errorpassword !="") echo "class='error'"; ?> type="password" name="password" value="<?php echo $password ?>"/><?php echo $msg_errorpassword ?></div>
        <div><input type="submit" value="enviar" /></div>
        </form>
    </body>
</html>
