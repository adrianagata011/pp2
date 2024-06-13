<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir al usuario a la página de login
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "login.html"; }, 3000);';
    echo '</script>'; 
    // header("Location: login.html");
    exit;
}
?>