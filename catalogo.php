<?php
session_start();
include('bd.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1><a href="index.php">Bienvenido a Nuestra Tienda</a></h1>
        <nav>
            <ul>
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
    <h1>Catálogo de Productos</h1>
    <div class="products">
        <?php
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='../img/" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
                echo "<h2>" . $row['nombre'] . "</h2>";
                echo "<p>" . $row['descripcion'] . "</p>";
                echo "<p>Precio: $" . $row['precio'] . "</p>";
                if ($row['en_oferta']) {
                    echo "<p>En oferta!</p>";
                };
                echo "<button onclick='addToCart(" . $row['id'] . ")'>Agregar al Carrito</button>";
                echo "</div>";
            }
        } else {
            echo "No hay productos disponibles";
        }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
