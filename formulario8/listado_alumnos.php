<?php require_once 'conecta.php'; ?>

<html>
    <head>
        <title>Alumnos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>Listado de Alumnos</div>
        <?php
            $bd = conectaBd();
            $consulta = "SELECT * FROM alumno";
            $resultado = $bd->query($consulta);
            if (!$resultado) {
                echo "Error en la consulta";
            } else {
                if ($resultado->rowCount()==0) {
                    echo "No hay alumnos";
                } else {
                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<th>Id</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Fecha Nacimiento</th>";
                    echo "<th>Ciclo</th>";
                    echo "<th>Nota media</th>";
                    echo "</tr>";
                    foreach($resultado as $registro) {
                        echo "<tr>";
                        echo "<td>".$registro['id']."</td>";
                        echo "<td align=right>".$registro['nombre_completo']."</td>";
                        echo "<td align=right>".$registro['fecha_nacimiento']."</td>";
                        echo "<td align=right>".$registro['ciclo']."</td>";
                        echo "<td align=right>".$registro['nota_media']."</td>";
                    }
                    echo "</table>";                    
                }                
            }            
            $bd = null;
        ?>   
    </body>
</html>