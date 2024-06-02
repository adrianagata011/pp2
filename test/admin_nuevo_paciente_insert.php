<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['apellido']) || empty($_POST['apellido']) || !isset($_POST['obraSocial']) || empty($_POST['obraSocial']) || !isset($_POST['grupoSanguineo']) || empty($_POST['grupoSanguineo']) ) {
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
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];
$email = $_POST['email'];
$obraSocial = $_POST['obraSocial'];
$grupoSanguineo = $_POST['grupoSanguineo'];
$observaciones = $_POST['observaciones'];
$dni = $_POST['dni'];

require_once('conexion_db.php');

// Ingreso una nueva Ficha Médica
$query = "INSERT INTO fichas_medicas (idHistoriaClinica, grupoSanguineo, observaciones) VALUES (NULL, '$grupoSanguineo', '$observaciones')";
$result = $conn->query($query);

// Obtengo el idFichaMedica del último registro 
$query1 = "SELECT idFichaMedica FROM fichas_medicas ORDER BY idFichaMedica DESC LIMIT 1;";
$result = $conn->query($query1);
$row = $result->fetch_assoc();
$idFichaMedica = $row['idFichaMedica'];

// Ingreso un nuevo usuario
$usuario=trim(strtolower($nombre)).trim(strtolower($apellido)).$dni;
$query2="INSERT INTO usuarios (usuario,contrasena,rol) values ('$usuario','password01',1);";
$result = $conn->query($query2);

// Obtengo el idUsuario del último registro 
$query3 = "SELECT idUsuario FROM usuarios where usuario = '$usuario';";
$result = $conn->query($query3);
$row = $result->fetch_assoc();
$idUsuario = $row['idUsuario'];

// acá hay que hacer el insert a la tabla pacientes
$query4 = "INSERT INTO pacientes (idFichaMedica, idUsuario, nombre, apellido, dni, telefono, domicilio, email, obraSocial) VALUES ($idFichaMedica, $idUsuario, '$nombre', '$apellido', '$dni', '$telefono', '$domicilio', '$email', '$obraSocial');";
$result = $conn->query($query4);

$conn->close();

echo "Se ingresó un Nuevo Paciete";
header("refresh:3; url=index_administrativo.php");
exit();
?>