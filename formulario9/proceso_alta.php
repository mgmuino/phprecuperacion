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
     $patron = "/^[a-zA-Z]{3,}([[:space:]][[:alpha:]]{2,})*$/";
     //QUEDAMOS AKIIIII NO VA CON Ñ ni con palabras con tilde
     return preg_match($patron, $nombre);
}

 /*function validarEdad($fecha_nacimiento) {
   $date1 = new DateTime($fecha_nacimiento); 
   $date2 = new DateTime("now"); 
   $interval = $date1->diff($date2); 
   $diff = $interval->format('%y'); 
   return $diff;  
}
*/
function validarNota($nota_media){
     if (is_numeric($nota_media)) {
         $nota = intval($nota_media);
         if ($nota>=0 && $nota<=10) {return True;}
         else {return False;}
     } else {
         return False;
     }     
}


$nombre = (isset($_REQUEST['nombre_completo']))?$_REQUEST['nombre_completo']:"No Definido";
$fecha_nacimiento = (isset($_REQUEST['fecha_nacimiento']))?$_REQUEST['fecha_nacimiento']:"No Definido";
$ciclo = (isset($_REQUEST['ciclo']))?$_REQUEST['ciclo']:"No Definido";
$nota_media = (isset($_REQUEST['nota_media']))?$_REQUEST['nota_media']:"No Definido";

//Validar nombre
$nombre= limpiarEntradaTexto($nombre);  
if (!validarNombre($nombre)){
    $errornombre="(ERROR EN NOMBRE)";//Hay error
    $hayErrores = True;
    $errores .= "&errornombre";
} else {
    $errornombre="";
}
/*
//Validar edad
$edad = validarEdad($fecha_nacimiento);
if ($edad<18){
    $errorfecha = "(ERROR EDAD)";//hay error
    $hayErrores =True;
    $errores .= "&errorfecha";
}else {
    $errorfecha ="";//no hay error
}
*/
//Validar ciclo
$ciclo= limpiarEntradaTexto($ciclo);  

//Validar nota media
$nota_media= limpiarEntradaTexto($nota_media);  
if (!validarNota($nota_media)){
    $errornota="(ERROR EN NOTA MEDIA)";//Hay error
    $hayErrores = True;
    $errores .= "&errornota";
} else {
    $errornota="";
}

if ($hayErrores) {
    //echo "Hay errores...<br>";
    //echo $_SERVER['QUERY_STRING'];
    $url = "formulario_alta.php?".$_SERVER['QUERY_STRING'].$errores;
    header("Location: ".$url);
    exit();
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