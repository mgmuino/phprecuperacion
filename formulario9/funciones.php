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

function validarCiclo($ciclo){
     $patron = "/^[a-zA-Z]{3,}([[:space:]][[:alpha:]]{2,})*$/";
     //QUEDAMOS AKIIIII NO VA CON Ñ ni con palabras con tilde
     return preg_match($patron, $ciclo);
}

 function validarEdad($fecha_nacimiento) {
   $date1 = new DateTime($fecha_nacimiento); 
   $date2 = new DateTime("now"); 
   $interval = $date1->diff($date2); 
   $diff = $interval->format('%y'); 
   return $diff;  
}

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

?>