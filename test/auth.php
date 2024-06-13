<?php
session_start();

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Conectar a la base de datos
// $mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

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
    if ($rol == 1) {
        header("Location: index_paciente.php");
        exit();
    }
    else 
    {
        header("Location: index_administrativo.php");
        exit();        
    }
    

} else {
    // Mostrar mensaje de error y redireccionar de nuevo a la página de inicio de sesión
    echo "Usuario o contraseña incorrectos. Inténtelo nuevamente.";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "login.html"; }, 3000);';
    echo '</script>';    
    //header("refresh:3; url=login.html");
    exit();
}
?>