<?php
session_start();
require_once 'conecta.php';
?>
<html>
    <head>
        <title>Recuperacion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="formulario">&nbsp;</div>
        <h1>Confirmar Borrado</h1>
        <ul>
        <li><a href="index.php">Inicio</a></li>            
        <li><a href="listado_alumnos.php">Listado</a></li>
        </ul>
      
        <?php

$_SESSION['id'] = (isset ($_REQUEST['id']))?
        $_REQUEST['id']:0;

$bd = conectaBd();

$consulta = "SELECT * FROM alumno WHERE id=".$_SESSION['id'];
$resultado = $bd ->query($consulta);

if (!$resultado){
    $url = "error.php?msg_error=error_Consulta_Editar";
   header('Location:', $url);
    
} else {
       $registro = $resultado->fetch();
       
      if(!$registro) {
         $url = "error.php?msg_error=Error_Registro_Producto_inexistente";
        header('Location:'.$url);
           
       } else {
           
           echo "<table border=1>";
           echo "<tr>";
           echo "<td>Id</td>"; 
           echo "<td>";
           echo $registro['id'];
           echo "</td>";
           echo "</tr>";
           
            echo "<tr>";
           echo "<td>Nombre completo</td>";
           echo "<td>";
           echo $registro['nombre_completo'];
           echo "</td>";
           echo "</tr>";
           
           echo "<tr>";
           echo "<td>Fecha nacimiento</td>"; 
           echo "<td>";
           echo $registro['fecha_nacimiento'];
           echo "</td>";
           echo "</tr>";
           
           echo "<tr>";
           echo "<td>Ciclo</td>"; 
           echo "<td>";
           echo $registro['ciclo'];
           echo "</td>";
           echo "</tr>";
           
           echo "<tr>";
           echo "<td>Nota media</td>"; 
           echo "<td>";
           echo $registro['nota_media'];
           echo "</td>";
           echo "</tr>";
        
                   
           echo "</table>";
       }
  }
?>
                <ul>
        <li><a href="borrar.php">Borrar</a></li>            
        </ul>
    </body>
</html>
