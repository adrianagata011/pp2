<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['cantidadMinima']) || empty($_POST['cantidadMinima']) || !isset($_POST['cantidadExistente']) || empty($_POST['cantidadExistente']) ) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- cantidad mínima<br>";
    echo "- cantidad existente<br>";
    header("refresh:3; url=admin_nuevo_insumo.php");
    exit();
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$cantidadMinima = $_POST['cantidadMinima'];
$cantidadExistente = $_POST['cantidadExistente'];
if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
} else {
    $descripcion = '';
}
if (!isset($_POST['observaciones']) || empty($_POST['observaciones'])) {
    $observaciones = $_POST['observaciones'];
} else {
    $observaciones = '';
}

$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$query = "INSERT INTO insumos (nombre, cantidadMinima, cantidadExistente, descripcion, observaciones) VALUES ('$nombre', $cantidadMinima, $cantidadExistente, '$descripcion', '$observaciones');";
$result = $mysqli->query($query);

$mysqli->close();

echo "Se ingresó un Insumo Nuevo";
header("refresh:3; url=index_administrativo.php");
exit();
?>