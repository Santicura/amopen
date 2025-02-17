<?php
session_start();
include 'bd.php';

//Funcion para añadir objetos a la cesta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_id = $_POST['producto_id'];
    $usuarios_id = $_SESSION['user_id'];

    $sql = "SELECT id FROM carrito WHERE usuarios_id='$usuarios_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        $sql = "INSERT INTO carrito (usuarios_id) VALUES ('$usuarios_id')";
        $conn->query($sql);
        $carrito_id = $conn->insert_id;
    } else {
        $row = $result->fetch_assoc();
        $carrito_id = $row['id'];
    }

    $sql = "INSERT INTO carrito_items (carrito_id, producto_id, cantidad) VALUES ('$carrito_id', '$producto_id', 1)
            ON DUPLICATE KEY UPDATE cantidad = cantidad + 1";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
