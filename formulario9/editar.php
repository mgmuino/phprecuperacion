<?php
session_start();
require_once 'conecta.php';
require_once 'proceso_alta.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function validarDatosRegistro() {
    // Recuperar datos Enviados desde formulario_alta.php
    $datos = Array();
    $datos[0] = (isset($_REQUEST['nombre_completo']))?
            $_REQUEST['nombre_completo']:"";
    $datos[0] = limpiar($datos[0]);
    $datos[1] = (isset($_REQUEST['fecha_nacimiento']))?
            $_REQUEST['fecha_nacimiento']:"";
    $datos[2] = (isset($_REQUEST['ciclo']))?
            $_REQUEST['ciclo']:"";
    $datos[3] = (isset($_REQUEST['nota_media']))?
            $_REQUEST['nota_media']:"";

    //-----validar ---- //
    $errores = Array();
    $errores[0] = !validarNombre($datos[0]);
    $errores[1] = !validarEdad($datos[1]);
    $errores[2] = !validarCiclo($datos[2]);
    $errores[3] = !validarNota($datos[3]);

    // ----- Asignar a variables de Sesión ----//
    $_SESSION['datos'] = $datos;
    $_SESSION['errores'] = $errores;  
    $_SESSION['hayErrores'] = 
            ($errores[0] || $errores[1]);
    
}


// PRINCIPAL //
validarDatosRegistro();
if ($_SESSION['hayErrores']) {
    $url = "editar.php";
    header('Location:'.$url);
} else {

    $db = conectaBd();
    $nombre = $_SESSION['datos'][0];
    $fecha_nacimiento = $_SESSION['datos'][1];  
    $ciclo = $_SESSION['datos'][2];
    $nota_media = $_SESSION['datos'][3];
    $id = $_SESSION['id'];

   
    $consulta = "UPDATE alumno 
    set nombre_completo = :nombre_completo, 
    fecha_nacimiento= :fecha_nacimiento 
    ciclo = :ciclo,
    nota_media = :nota_media,
    WHERE id= :id";
    
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":nombre_completo" => $nombre,
        ":fecha_nacimiento" => $fecha_nacimiento, ":ciclo" => $ciclo, ":nota_media" => $nota_media,
        ":id" => $id))) {
            unset($_SESSION['datos']);
            unset($_SESSION['errores']);
            unset($_SESSION['hayErrores']);
            $url = "listado_alumnos.php";
            header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Grabar_Registro_Alumno";
        header('Location:'.$url);
    }

    $db = null;

}
?>