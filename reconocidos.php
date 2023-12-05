<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fei UV</title>
</head>
<body>
    <h2>Historial de los Alumnos</h2>
    <h3>Aqui podra encontrar algunos resultados de nuestros alumnos en periodos anteriores<h3>

    <?php
        // Conectar a la base de datos (reemplaza con tus propios detalles de conexión)
        $conexion = new mysqli('localhost', 'fei_user', 'F3iUV', 'fei');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die('Error de conexión: (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error );
        }

        // Consulta SQL para obtener los productos
        $consulta = "SELECT Cursa.matricula_alumno, Oferta.nrc, Carrera.nombre AS nombre_carrera, Materia.nombre AS nombre_materia, Cursa.calificacion, PeriodoEscolar.nombre AS nombre_periodo
             FROM Cursa
             INNER JOIN Oferta ON Cursa.nrc_oferta = Oferta.nrc
             INNER JOIN Materia ON Oferta.codMateria_materia = Materia.codMateria
             INNER JOIN Carrera ON Carrera.codCarrera = Materia.codCarrera_carrera
             INNER JOIN PeriodoEscolar ON Oferta.codPeriodo_periodoEscolar = PeriodoEscolar.codPeriodo
             WHERE calificacion > 8
             ORDER BY matricula_alumno";

        $resultado = $conexion->query($consulta);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Mostrar los datos en una tabla
    echo "<table border='1'>";
    echo "<tr><th>Matrícula</th><th>NRC</th><th>Carrera</th><th>Materia</th><th>Calificación</th><th>Periodo</th></tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['matricula_alumno'] . "</td>";
        echo "<td>" . $fila['nrc'] . "</td>";
        echo "<td>" . $fila['nombre_carrera'] . "</td>";
        echo "<td>" . $fila['nombre_materia'] . "</td>";
        echo "<td>" . $fila['calificacion'] . "</td>";
        echo "<td>" . $fila['nombre_periodo'] . "</td>";
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
