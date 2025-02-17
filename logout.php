<?php
session_start(); //Se inicia la sesion
session_destroy(); // hace BOOM la sesion activa

header("Location: index.php"); //te redirige a la pagina principal
exit(); //the cake is a lie