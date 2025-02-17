<?php
session_start();

// Compruebo si el usuario está logueado
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    echo "Acceso no autorizado. Solo los administradores pueden ver esta página.";
    exit();
}
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

// Verifico si la conexión se cunplió
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtengo todos los usuarios
$query = "SELECT * FROM usuarios";
$resultado = $conexion->query($query);

// Verifico si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    // Muestro la tabla de usuarios
    echo "<h2>Gestión de Usuarios</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
            </tr>";
    // Muestro cada usuario
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $fila['usuarios_id'] . "</td>
                <td>" . htmlspecialchars($fila['nombre']) . "</td>
                <td>" . htmlspecialchars($fila['dni']) . "</td>
                <td>" . htmlspecialchars($fila['email']) . "</td>
                <td>
                    <a href='admin_editar.php?id=" . $fila['usuarios_id'] . "'>Editar</a> | 
                    <a href='admin_deletear.php?id=" . $fila['usuarios_id'] . "'>Eliminar</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No hay usuarios disponibles.";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    

</body>

</html>