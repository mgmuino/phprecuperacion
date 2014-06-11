<?php
session_start();
require_once 'conecta.php';


$db = conectaBd();
   $id = $_SESSION['id'];
    
    
    $consulta = "DELETE FROM alumno 
        WHERE id= :id";
    
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":id" => $id))) {
        //vaciamos las variables de sesión si todo va bien.
        unset ($_SESSION['id']);
       // redirigimos a la página del listado 
        $destino = "listado_alumnos.php";
        header('Location:'.$destino);
    } else {
        $destino = "error.php?msg_error=Error_Borrar_Alumno";
        header('Location:'.$destino);
    }

    $db = null;
