<?php
session_start();
include('bd.php');
//Funcion para revisar si tienes pedidos pendientes incluso si eres invitado
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM pedidos WHERE usuario_id='$usuario_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos Realizados</title>
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
    <h1>Pedidos Realizados</h1>
    <div class="orders">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='order'>";
                echo "<h2>Pedido #" . $row['id'] . "</h2>";
                echo "<p>Fecha: " . $row['fecha'] . "</p>";
                echo "<p>Total: $" . $row['total'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No has realizado ningún pedido";
        }
        ?>
    </div>
</body>
</html>
