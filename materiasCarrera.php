<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fei UV</title>
</head>
<body>
    <h2>Lista de Materias por Carrera</h2>
    <h3>A cada carrera le corresponde solo ciertas materias<h3>

    <?php
        // Conectar a la base de datos (reemplaza con tus propios detalles de conexión)
        $conexion = new mysqli('localhost', 'fei_user', 'F3iUV', 'fei');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die('Error de conexión: (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error );
        }

        // Consulta SQL para obtener los productos
        $consulta = "SELECT Carrera.nombre AS nombre_carrera, Materia.nombre, Materia.descripcion FROM Carrera
        INNER JOIN Materia ON Materia.codCarrera_carrera = Carrera.codCarrera ORDER BY nombre_carrera";

        $resultado = $conexion->query($consulta);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Mostrar los datos en una tabla
    echo "<table border='1'>";
    echo "<tr><th>Nombre_Carrera</th><th>Nombre_Materia</th><th>Materia_descripcion</tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['nombre_carrera'] . "</td>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td>" . $fila['descripcion'] . "</td>";
        
        echo "</tr>";
    }

    echo "</table>";
}
 else {
            echo "No se encontraron productos.";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    ?>
</body>
</html>