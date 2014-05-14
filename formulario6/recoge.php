<?php 
//print_r($_REQUEST);
define('PASS_MIN', 5);
define('PASS_MAX', 15);

function enRango($inicio, $fin, $valor) {
    return ($valor>=$inicio && $valor<=$fin);
}
 
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

function validarPassword($password) {
    $patron = "/^[[:alnum:]]*[._-]+[[:alnum:]]*$/";
    $longitud = strlen($password);
    return (enRango(PASS_MIN, PASS_MAX, $longitud)
             && preg_match($patron, $password));
}


$password = (isset($_REQUEST['password']))?$_REQUEST['password']:"No Definido";
$email = $_REQUEST['email'];

//Variable para indicar si hay errrores
$hayErrores = False;
$errores="";


//Validar EMAIL
if (!validarEmail($email)){
    $erroremail= "(ERROR EMAIL)"; //Hay error
    $hayErrores =True;
    $errores .= "&erroremail";
} else {
    $erroremail=""; //No hay error
}

//Validar PASSWORD
if (!validarPassword($password)){
    $errorpassword= "(ERROR PASSWORD)";
    $hayErrores =True;
    $errores .="&errorpassword";
} else {
    $errorpassword="";
}


if ($hayErrores) {
    //echo "Hay errores...<br>";
    //echo $_SERVER['QUERY_STRING'];
    $url = "index.php?".$_SERVER['QUERY_STRING'].$errores;
    header("Location: ".$url);
}





//print "<p>Su email es                   $email.$erroremail</p>";





?>

