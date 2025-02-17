<?php
session_start();
include('bd.php');
//Revisa la id para saber que carrito seleccionar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['user_id'];

    $sql = "SELECT id FROM carrito WHERE usuario_id='$usuario_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $carrito_id = $row['id'];
//recoge toda la informacion del carrito
        $sql = "SELECT ci.producto_id, ci.cantidad, p.precio, p.en_oferta FROM carrito_items ci JOIN productos p ON ci.producto_id = p.id WHERE ci.carrito_id='$carrito_id'";
        $result = $conn->query($sql);

        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $precio = $row['en_oferta'] ? $row['precio'] * 0.9 : $row['precio'];
            $total += $precio * $row['cantidad'];
        }
//Introduce la informacion en pedidos y te confirma la compra
        $sql = "INSERT INTO pedidos (usuario_id, fecha, total) VALUES ('$usuario_id', NOW(), '$total')";
        if ($conn->query($sql) === TRUE) {
            $pedido_id = $conn->insert_id;
            
            $sql = "INSERT INTO items_pedido (pedido_id, producto_id, cantidad, precio) SELECT '$pedido_id', producto_id, cantidad, precio FROM carrito_items WHERE carrito_id='$carrito_id'";
            if ($conn->query($sql) === TRUE) {
                $sql = "DELETE FROM carrito_items WHERE carrito_id='$carrito_id'";
                $conn->query($sql);
                
                header('Location: compra_realizada.php');
            }
        }
    }
}
?>
