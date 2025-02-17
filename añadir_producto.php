<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Productos</title>
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
    <h1>Registro de Producto</h1>
    <form action="process_product_add.php" method="POST">
        <label for="id">Numero de identificacion:</label>
        <input type="id" id="id" name="id" required>
        <label for="Nombre">Nombre:</label>
        <input type="nombre" id="nombre" name="nombre"required>
        <label for="Descripcion">Descripcion:</label>
        <input type="descripcion" id="descripcion" name="descripcion" required>
        <label for="precio">Precio:</label>
        <input type="precio" id="precio" name="precio" required>
        <button type="submit">Añadir</button>
    </form>
</body>
</html>