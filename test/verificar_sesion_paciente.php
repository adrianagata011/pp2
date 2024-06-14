<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] != 1 ) {
    // Si no está logueado, redirigir al usuario a la página de login
    echo '<script type="text/javascript">';
    echo 'window.location.href = "login.html";';
    echo '</script>';
    //header("Location: login.html");
    exit;
}
?>