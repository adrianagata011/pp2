<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['cantidadMinima']) || empty($_POST['cantidadMinima']) || !isset($_POST['cantidadExistente']) || empty($_POST['cantidadExistente']) ) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- apellido<br>";
    echo "- obra social<br>";
    echo "- grupo sanguineo<br>";
    $dni = $_POST['dni'];
    header("refresh:3; url=admin_nuevo_paciente.php?dni=$dni");
    exit();
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
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
$obraSocial = $_POST['obraSocial'];
$grupoSanguineo = $_POST['grupoSanguineo'];
if (!isset($_POST['observaciones']) || empty($_POST['observaciones'])) {
    $email = $_POST['observaciones'];
} else {
    $observaciones = '';
}


$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Ingreso una nueva Ficha Médica
$query = "INSERT INTO fichas_medicas (idHistoriaClinica, grupoSanguineo, observaciones) VALUES (NULL, '$grupoSanguineo', '$observaciones')";
$result = $mysqli->query($query);

// Obtengo el idFichaMedica del último registro 
$query1 = "SELECT idFichaMedica FROM fichas_medicas ORDER BY idFichaMedica DESC LIMIT 1;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$idFichaMedica = $row['idFichaMedica'];

// acá hay que hacer el insert a la tabla pacientes

$mysqli->close();


echo "Se ingresó un Nuevo Paciete";
header("refresh:3; url=index_administrativo.php");
exit();
?>