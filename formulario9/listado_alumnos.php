<?php
require_once 'conecta.php'; 
?>

<html>
    <head>
        <title>Alumnos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>    
    <body>
        <h1>Listado de Alumnos</h1>
        <ul>         
            <li><a href="formulario_alta.php">Alta Alumno</a></li>
        </ul>        
        <?php
            $bd = conectaBd();
            $consulta = "SELECT * FROM alumno order by Id";
            $resultado = $bd->query($consulta);
            if (!$resultado) {
                echo "Error";
            } else {
                if ($resultado->rowCount()==0) {
                   echo "No hay alumnos";
                }else{
                        echo "<table border=1>";
                        echo "<tr>";
                        echo "<th>Id</th>";
                        echo "<th>Nombre</th>";
                        echo "<th>Fecha de Nacimiento</th>";
                        echo "<th>Ciclo </th>";
                        echo "<th>Nota media</th>";
                        echo "</tr>";
                         foreach($resultado as $registro) {
                            echo "<tr>";
                            echo "<td>".$registro['id']."</td>";
                            echo "<td align=right>".$registro['nombre_completo']."</td>";
                            echo "<td>";
                            $fechanac = new DateTime($registro['fecha_nacimiento']);
                            echo $fechanac->format('d-m-Y');
                            echo "</td>";
                            echo "<td align=right>".$registro['ciclo']."</td>";
                            echo "<td align=right>".$registro['nota_media']."</td>";
                            $irBorrar = "cborrar.php?id=".$registro['id'];
                            echo "<td><a href=".$irBorrar.">Borrar</a></td>";
                            $irEditar="formulario_editar.php?id=".$registro['id'];
                            echo "<td><a href=".$irEditar.">Editar</a></td>";
                        }
                        echo "</table>";
                }
            }
            
            $bd = null;
        ?>   
    </body>
</html>