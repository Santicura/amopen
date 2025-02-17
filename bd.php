<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";
//Conexion con la base de datos de tienda
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
