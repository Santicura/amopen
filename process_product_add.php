<?php
include('bd.php');
//Funcion de registro con encriptacion de contraseña para que no se vea ni en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos (id, nombre, descripcion, precio) VALUES ('$id', '$nombre', '$descripcion', '$precio')";
    if ($conn->query($sql) === TRUE) {
        header('Location: catalogo.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
