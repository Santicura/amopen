<?php
session_start();


// Compruebo si el usuario está logueado como administrador
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    echo "Acceso no autorizado.";
    exit();
}

$usuarios_id = $_GET['usuarios_id'];

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');
// Verifico si la conexión se cumplió
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtengo los datos del usuario
$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuarios_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];

    // Actualizo la base de datos con los nuevos datos
    $updateQuery = "UPDATE usuarios SET nombre = ?, dni = ?, email = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("sssi", $nombre, $dni, $email, $id_usuario);
    if ($stmt->execute()) {
        echo "Usuario actualizado con éxito.";
    } else {
        echo "Error al actualizar el usuario.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
        <h1><a href="index.php">Bienvenido a Nuestra Tienda</a></h1>
        <nav>
            <ul>
                <li><a href="catalogo.php">Catálogo de Productos</a></li>
                <li><a href="ofertas.php">Productos en Oferta</a></li>
                <li><a href="carrito.php">Carrito de Compra</a></li>
                <li><a href="pedidos.php">Pedidos Realizados</a></li>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                    <li><a href="admin.php"> Panel de Administración</a></li>
                    <li><a href="admin_clientes.php">Admin Clientes</a></li>
                    <li><a href="admin_editar.php">Admin editar Usuarios </a></li>
                    <li><a href="admin_pedidos.php">Admin Pedidos</a></li>
                    <li><a href="añadir_producto.php">Añadir Producto</a></li>
                <?php endif; ?>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
                <li><a href="logout.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido">DNI:</label>
                <input type="text" id="dni" name="apellido" value="<?= htmlspecialchars($usuario['dni']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <button type="submit" class="btn">Actualizar</button>
        </form>
    </div>
</body>

</html>

<?php
$conexion->close();
?>