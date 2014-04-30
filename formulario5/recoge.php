<?php 
//print_r($_REQUEST);

function limpiarEntradaTexto($entrada) {
    $tmp=strip_tags(trim($entrada));
    if (get_magic_quotes_gpc()) { 
        $tmp = stripslashes($tmp); 
     } 
    return $tmp;
}

function validarEmail($email) {
     return (filter_var($email, FILTER_VALIDATE_EMAIL ));
 } 

 function edad($fechanacimiento) {
   $date1 = new DateTime($fechanacimiento); 
   $date2 = new DateTime("now"); 
   $interval = $date1->diff($date2); 
   $diff = $interval->format('%y'); 
   return $diff;  
}
function validarnombre($nombre){
     $patron = "/^[a-zA-Z1]{3,}([[:space:]][[:alpha:]]{2,})*$/";
     //QUEDAMOS AKIIIII NO VA CON Ñ ni con palabras con tilde
     return preg_match($patron, $nombre);
}


$nombre = (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"No Definido";
$fechanacimiento = (isset($_REQUEST['fechanacimiento']))?$_REQUEST['fechanacimiento']:"No Definido";
$email = $_REQUEST['email'];
$sexo = (isset($_REQUEST['sexo']))?$_REQUEST['sexo']:"ERROR SEXO OBLIGATORIO";
$familianumerosa = (isset($_REQUEST['familianumerosa']))?$_REQUEST['familianumerosa']:"No";
$edad = edad($fechanacimiento);

//Validar nombre
  $nombre= limpiarEntradaTexto($nombre);  
  if (!validarnombre($nombre)){
        $errornombre="(ERROR EN NOMBRE)";//Hay error
        }else{
        $errornombre="";
        }
//Validar EMAIL
if (!validarEmail($email)){
    $erroremail= "(ERROR EMAIL)"; //Hay error
} else {
    $erroremail=""; //No hay error
}
//Validar edad
if ($edad<18){
    $erroredad = "(ERROR EDAD)";//hay error
}else {
    $erroredad ="";//no hay error
}


$nombre= limpiarEntradaTexto($nombre);


print "<p>Su nombre limpio es           $nombre $errornombre</p>"; 
print "<p>Su fecha de nacimiento es     $fechanacimiento. (Edad $edad)$erroredad</p>"; 
print "<p>Su email es                   $email.$erroremail</p>";
print "<p>Su sexo es                    $sexo</p>";
print "<p>Familia Numerosa              $familianumerosa</p>";




?>

