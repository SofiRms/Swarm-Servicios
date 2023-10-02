
<!DOCTYPE html>
<html>
<head>
    <title>Desde sitio en Apache
    </title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Consulta de Alumnos Desde web1</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>DNI</th>
    </tr>

    <?php
    $servername = "172.17.0.5";
    $username = "root";
    $password = "root1";
    $dbname = "prueba";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT id, apellidos, nombres, dni FROM alumnos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos en la tabla HTML
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["apellidos"] . "</td>";
            echo "<td>" . $row["nombres"] . "</td>";    
            echo "<td>" . $row["dni"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</table>

</body>
</html>