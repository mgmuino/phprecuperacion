<?php 
print_r($_REQUEST);

$nombre = (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"No Definido";
$fechanacimiento = (isset($_REQUEST['fechanacimiento']))?$_REQUEST['fechanacimiento']:"No Definido";
$email = (isset($_REQUEST['email']))?$_REQUEST['email']:"No Definido";
$sexo = (isset($_REQUEST['sexo']))?$_REQUEST['sexo']:"No Definido";

print "<p>Su nombre es                  $nombre</p>"; 
print "<p>Su fecha de nacimiento es     $fechanacimiento</p>"; 
print "<p>Su email es                   $email</p>";
print "<p>Su sexo es                   $sexo</p>";



?>

