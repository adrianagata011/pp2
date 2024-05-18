<?php
session_start();

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}
// comentario
// Llamar al procedimiento almacenado VerificarUsuario
$query = "CALL VerificarUsuario('$usuario', '$contrasena', @existe, @rol)";
$result = $mysqli->query($query);

// Obtener el resultado del procedimiento almacenado
$select_result = $mysqli->query("SELECT @existe AS existe, @rol AS rol");
$row = $select_result->fetch_assoc();
$existe = $row['existe'];
$rol = $row['rol'];
$mysqli->close();

// Verificar el resultado del procedimiento almacenado
if ($existe == 1) {
    // Iniciar sesión
    $_SESSION['usuario'] = $usuario;
    $_SESSION['rol_id'] = $rol;
    // Redireccionar a la pantalla de menú
    header("Location: index.php");
    exit();
} else {
    // Mostrar mensaje de error y redireccionar de nuevo a la página de inicio de sesión
    echo "Usuario o contraseña incorrectos. Inténtelo nuevamente.";
    header("refresh:3; url=login.html");
    exit();
}
?>