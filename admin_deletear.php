<?php
session_start();

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !='admin') {
    echo "Acceso no autorizado.";
    exit();
}
//Para borrar usuarios
$id_usuarios = $_GET['id'];

$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexion fallida: " - $conexion->connect_error);
}

$query = "DELETE FROM usuarios WHERE id_usuarios = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuarios);
if ($stmt->execute()) {
    echo "Usuario eliminado con exito.";
} else {
    echo "Error al eliminar el usuario";
}

$conexion->close();

header("Location: admin.php");
exit();