<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
                <li><a href="login.php">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <h1>Registro de Usuario</h1>
    <form action="process_register.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="dni">DNI:</label>
        <input type="dni" id="dni" name="dni"required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
