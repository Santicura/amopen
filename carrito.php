<?php
session_start();
include('bd.php');
//Guarda los productos que eligas, la cantidad y el precio
$usuario_id = $_SESSION['user_id'];
$sql = "SELECT p.nombre, p.precio, ci.cantidad FROM carrito_items ci JOIN productos p ON ci.producto_id = p.id WHERE ci.carrito_id = (SELECT id FROM carrito WHERE usuario_id='$usuario_id')";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1><a href="index.php">Bienvenido a Nuestra Tienda</a></h1>
        <nav>
            <ul>
                <li><a href="catalogo.php">Catálogo de Productos</a></li>
                <li><a href="ofertas.php">Productos en Oferta</a></li>
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
    <h1>Carrito de Compra</h1>
    <div class="cart">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<h2>" . $row['nombre'] . "</h2>";
                echo "<p>Precio: $" . $row['precio'] . "</p>";
                echo "<p>Cantidad: " . $row['cantidad'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Tu carrito está vacío";
        }
        ?>
    </div>
    <form action="checkout.php" method="POST">
        <button type="submit">Finalizar Compra</button>
    </form>
</body>
</html>
