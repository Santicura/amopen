<?php
session_start();
include('bd.php');
//Funcion para iniciar sesion la cual revisa que el mail y la contraseña son correctas ademas de checkear si tienes rol de admin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['rol'];
            header('Location: index.php');
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that email";
    }
}
?>
