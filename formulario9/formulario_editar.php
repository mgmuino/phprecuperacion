<?php
session_start();
require_once 'conecta.php';
    // Estructura: campos del formulario
$_SESSION['datos'] = (isset($_SESSION['datos']))?
            $_SESSION['datos']:Array('','');
$_SESSION['errores'] = (isset($_SESSION['errores']))?
            $_SESSION['errores']:Array(FALSE,FALSE);
$_SESSION['hayErrores'] = (isset($_SESSION['hayErrores']))?
            $_SESSION['hayErrores']:FALSE;
/*
 * Cargar de la base de datos
 */
$_SESSION['id'] = (isset($_REQUEST['id']))?
            $_REQUEST['id']:$_SESSION['id'];

$bd = conectaBd();
$consulta = "SELECT * FROM alumno WHERE id=".$_SESSION['id'];
$resultado = $bd->query($consulta);

if (!$resultado) {
       $url = "error.php?msg_error=Error_Consulta_Editar";
       header('Location:'.$url);
} else { 
       $registro = $resultado->fetch(); 
       if(!$registro) {
           $url = "error.php?msg_error=Error_Registro_Alumno_inexistente";
           header('Location:'.$url);
       } else {
           $_SESSION['datos'][0] = $registro['nombre_completo'];
           $_SESSION['datos'][1] = $registro['fecha_nacimiento'];
           $_SESSION['datos'][2] = $registro['ciclo'];
           $_SESSION['datos'][3] = $registro['nota_media'];
       }
}




?>

<html>
    <head>
        <title>Editar Alumno</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>Editar Alumno</div>
        <form action="editar.php" method="GET">
            <div>Nombre completo: <input type="text" name="nombre_completo" 
                              value="<?php echo $_SESSION['datos'][0]; ?>"/>
            </div>
           <?php
                if ($_SESSION['errores'][0]) {
                    echo "<div class 'error'>".MSG_ERR_NOMBRE."</div>";
                }
            ?>
            <div>Fecha nacimiento: <input type="date" name="fecha_nacimiento" 
                            value="<?php echo $_SESSION['datos'][1]; ?>"/></div>
            </div>
            <?php
                if ($_SESSION['errores'][1]) {
                    echo "<div class 'error'>".MSG_ERR_FECHANACIMIENTO."</div>";
                }
            ?>
            <div>Ciclo: <input type="text" name="ciclo" 
                            value="<?php echo $_SESSION['datos'][2]; ?>"/></div>
            </div>
            <?php
                if ($_SESSION['errores'][2]) {
                    echo "<div class 'error'>".MSG_ERR_CICLO."</div>";
                }
            ?>
            <div>Nota media: <input type="text" name="nota_media" 
                            value="<?php echo $_SESSION['datos'][3]; ?>"/></div>
            </div>
            <?php
                if ($_SESSION['errores'][3]) {
                    echo "<div class 'error'>".MSG_ERR_NOTA."</div>";
                }
            ?>
            <input type="submit" value="Enviar" />
        </form>
    </body>
</html>