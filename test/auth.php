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
$query = "CALL VerificarUsuario('$usuario', '$contrasena', @existe)";
$result = $mysqli->query($query);

// Obtener el resultado del procedimiento almacenado
$select_result = $mysqli->query("SELECT @existe AS existe");
$row = $select_result->fetch_assoc();
$existe = $row['existe'];

// Verificar el resultado del procedimiento almacenado
if ($existe == 1) {
    // Iniciar sesión

    $select_result_rol = $mysqli->query("SELECT rol_id FROM usuarios WHERE usuario = $usuario");
    $row = $select_result_rol->fetch_assoc();
    $rol = $row['rol_id'];

    $_SESSION['usuario'] = $usuario;
    $_SESSION['rol_id'] = $rol
    // Cerrar conexión
    $mysqli->close();
    // Redireccionar a la pantalla de menú
    header("Location: index.php");

    exit();
} else {
    // Cerrar conexión
    $mysqli->close();
    // Mostrar mensaje de error y redireccionar de nuevo a la página de inicio de sesión
    echo "Usuario o contraseña incorrectos. Inténtelo nuevamente.";
    header("refresh:3; url=login.html");



    exit();
}
?>