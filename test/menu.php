<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redireccionar a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menú</title>
</head>
<body>

<h2>Bienvenido, <?php echo $usuario; ?>!</h2>

<ul>
    <li><a href="#">Opción 1</a></li>
    <li><a href="#">Opción 2</a></li>
    <li><a href="#">Opción 3</a></li>
    <li><a href="/logout.php">Cerrar Sesión</a></li>
</ul>

</body>
</html>