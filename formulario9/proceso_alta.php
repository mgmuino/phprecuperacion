<?php
require_once 'conecta.php'; 

function limpiarEntradaTexto($entrada) {
    $tmp=strip_tags(trim($entrada));
    if (get_magic_quotes_gpc()) { 
        $tmp = stripslashes($tmp); 
     } 
    return $tmp;
}

function validarNombre($nombre){
     $patron = "/^[a-zA-Z1]{3,}([[:space:]][[:alpha:]]{2,})*$/";
     //QUEDAMOS AKIIIII NO VA CON Ñ ni con palabras con tilde
     return preg_match($patron, $nombre);
}

$nombre = (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"No Definido";
$fecha_nacimiento = (isset($_REQUEST['fecha_nacimiento']))?$_REQUEST['fecha_nacimiento']:"No Definido";
$ciclo = (isset($_REQUEST['ciclo']))?$_REQUEST['ciclo']:"No Definido";
$nota_media = (isset($_REQUEST['nota_media']))?$_REQUEST['nota_media']:"No Definido";



//Validar nombre
$nombre= limpiarEntradaTexto($nombre);  
if (!validarNombre($nombre)){
    $errornombre="(ERROR EN NOMBRE)";//Hay error
    $hayErrores =True;
    $errores .= "&errornombre";
} else {
    $errornombre="";
}
//Validar ciclo
$ciclo= limpiarEntradaTexto($ciclo);  


if ($hayErrores) {
    //echo "Hay errores...<br>";
    //echo $_SERVER['QUERY_STRING'];
    $url = "formulario_alta.php?".$_SERVER['QUERY_STRING'].$errores;
    header("Location: ".$url);
}



$db = conectaBd();
    $nombre = $_REQUEST['nombre_completo'];
    $fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
    $ciclo =  $_REQUEST['ciclo'];
    $nota_media =  $_REQUEST['nota_media'];
    
    $consulta = "INSERT INTO alumno
    (nombre_completo,Fecha_nacimiento, ciclo,nota_media)
    VALUES (:nombre_completo, :fecha_nacimiento, :ciclo, :nota_media)";
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":nombre_completo" => $nombre, ":fecha_nacimiento" => $fecha_nacimiento,
        ":ciclo" => $ciclo,":nota_media" => $nota_media))) {
        $url = "listado_alumnos.php";
        header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Grabar_Nuevo_Alumno";
        header('Location:'.$url);
    }

    $db = null;


?>