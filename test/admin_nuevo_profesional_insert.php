<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['idServicio']) || empty($_POST['idServicio']) || !isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['apellido']) || empty($_POST['apellido']) || !isset($_POST['dni']) || empty($_POST['dni']) || !isset($_POST['numeroMatricula']) || empty($_POST['numeroMatricula']) || !isset($_POST['horarioIngreso']) || empty($_POST['horarioIngreso']) || !isset($_POST['horarioEgreso']) || empty($_POST['horarioEgreso'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- apellido<br>";
    echo "- dni<br>";
    echo "- Servicio<br>";
    echo "- numero de Matricula<br>";
    echo "- horario de Ingreso<br>";
    echo "- horario de Engreso<br>";
    header("refresh:3; url=nuevo_profesional_admin.php");
    exit();
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
if (!isset($_POST['telefono']) || empty($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
} else {
    $telefono = '';
}
if (!isset($_POST['domicilio']) || empty($_POST['domicilio'])) {
    $domicilio = $_POST['domicilio'];
} else {
    $domicilio = '';
}
if (!isset($_POST['email']) || empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = '';
}
$idServicio = $_POST['idServicio'];
$numeroMatricula = $_POST['numeroMatricula'];
$horarioIngreso = $_POST['horarioIngreso'];
$horarioEgreso = $_POST['horarioEgreso'];
$inicioActividad = $_POST['inicioActividad'];

/*
echo "Se ingresaron estos datos: <br>";
echo "$nombre<br>";
echo "$apellido<br>";
echo "$dni<br>";
echo "$telefono<br>";
echo "$domicilio<br>";
echo "$email<br>";
echo "$idServicio<br>";
echo "$numeroMatricula<br>";
echo "$horarioIngreso<br>";
echo "$horarioEgreso <br>";
echo "$inicioActividad <br>";*/

$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$query = "INSERT INTO profesionales (idServicio, nombre, apellido, dni, telefono, domicilio, email, numeroMatricula, horarioIngreso, horarioEgreso, inicioActividad) VALUES ($idServicio, '$nombre', '$apellido', '$dni', '$telefono', '$direccion', '$email', '$numeroMatricula', '$horarioIngreso', '$horarioEgreso', CURDATE());";
$result = $mysqli->query($query);
// Obtener el resultado del procedimiento almacenado
$mysqli->close();

echo "Se ingresó el Profesional Nuevo";
header("refresh:3; url=index_administrativo.php");
exit();
?>