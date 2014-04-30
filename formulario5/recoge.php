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
//$sexo = (isset($_REQUEST['sexo']))?$_REQUEST['sexo']:"Error . Debe usted seleccionar sexo";
$sexo = $_REQUEST['sexo'];
$familianumerosa = (isset($_REQUEST['familianumerosa']))?$_REQUEST['familianumerosa']:"No";
$edad = edad($fechanacimiento);

//Variable para indicar si hay errrores
$hayErrores = False;
$errores="";

//Validar nombre
$nombre= limpiarEntradaTexto($nombre);  
if (!validarnombre($nombre)){
    $errornombre="(ERROR EN NOMBRE)";//Hay error
    $hayErrores =True;
    $errores .= "&errornombre";
} else {
    $errornombre="";
}
//Validar EMAIL
if (!validarEmail($email)){
    $erroremail= "(ERROR EMAIL)"; //Hay error
    $hayErrores =True;
    $errores .= "&erroremail";
} else {
    $erroremail=""; //No hay error
}
//Validar edad
if ($edad<18){
    $erroredad = "(ERROR EDAD)";//hay error
    $hayErrores =True;
    $errores .= "&erroredad";
}else {
    $erroredad ="";//no hay error
}
//Validar Sexo
if ($sexo=="Selecciona"){
    $errorsexo= "Error sexo no definido"; //Hay error
    $sexo="";
    $hayErrores =True;
    $errores .= "&errorsexo";
} else {
    $errorsexo=""; //No hay error
}

if ($hayErrores) {
    //echo "Hay errores...<br>";
    //echo $_SERVER['QUERY_STRING'];
    $url = "index.php?".$_SERVER['QUERY_STRING'].$errores;
    header("Location: ".$url);
}

$nombre= limpiarEntradaTexto($nombre);


print "<p>Su nombre limpio es           $nombre $errornombre</p>"; 
print "<p>Su fecha de nacimiento es     $fechanacimiento. (Edad $edad)$erroredad</p>"; 
print "<p>Su email es                   $email.$erroremail</p>";
print "<p>Su sexo es                    $sexo</p>";
print "<p>Familia Numerosa              $familianumerosa</p>";




?>

