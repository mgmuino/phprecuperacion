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

    //-----validar ---- //
    $errores = Array();
    $errores[0] = !validarTitulo($datos[0]);
    $errores[1] = !validarURL($datos[1]);

    // ----- Asignar a variables de Sesión ----//
    $_SESSION['datos'] = $datos;
    $_SESSION['errores'] = $errores;  
    $_SESSION['hayErrores'] = 
            ($errores[0] || $errores[1]);
    
}


// PRINCIPAL //
validarDatosRegistro();
if ($_SESSION['hayErrores']) {
    $url = "formulario_editar_software.php";
    header('Location:'.$url);
} else {

    $db = conectaBd();
    $titulo = $_SESSION['datos'][0];
    $url = $_SESSION['datos'][1];    
    $id = $_SESSION['id'];

   
    
    $consulta = "UPDATE software 
    set titulo = :titulo, 
    url= :url 
    WHERE id= :id";
    
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":titulo" => $titulo,
        ":url" => $url, 
        ":id" => $id))) {
            unset($_SESSION['datos']);
            unset($_SESSION['errores']);
            unset($_SESSION['hayErrores']);
            $url = "listado_software.php";
            header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Grabar_Registro_Software";
        header('Location:'.$url);
    }

    $db = null;

}
?>