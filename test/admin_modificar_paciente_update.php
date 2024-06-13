<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['apellido']) || empty($_POST['apellido']) || !isset($_POST['obraSocial']) || empty($_POST['obraSocial']) || !isset($_POST['grupoSanguineo']) || empty($_POST['grupoSanguineo']) || !isset($_POST['contrasena']) || empty($_POST['contrasena']) ) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- apellido<br>";
    echo "- obra social<br>";
    echo "- grupo sanguineo<br>";
    echo "- contraseña<br>";
    $dni = $_POST['dni'];
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_modificar_paciente.php?dni='.$dni.'"; }, 3000);';
    echo '</script>';
    //header("refresh:3; url=admin_modificar_paciente.php?dni=$dni");
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
$contrasena = $_POST['contrasena'];

require_once('conexion_db.php');

/*
1) traigo idPaciente, idFichaMedica, idUsuario de pacientes
2) update pacientes
3) update fichas_medicas
4) update usuarios
*/

$query = "SELECT idPaciente,idFichaMedica,idUsuario FROM pacientes WHERE dni = '$dni'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$idPaciente = $row['idPaciente'];
$idFichaMedica = $row['idFichaMedica'];
$idUsuario = $row['idUsuario'];

$query1 = "UPDATE pacientes SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', domicilio = '$domicilio', email = '$email', obraSocial = '$obraSocial' WHERE idPaciente = $idPaciente;";
$result = $conn->query($query1);

$query2 = "UPDATE fichas_medicas SET grupoSanguineo = '$grupoSanguineo', observaciones = '$observaciones' WHERE idFichaMedica = $idFichaMedica;";
$result = $conn->query($query2);

$query3 = "UPDATE usuarios SET contrasena = '$contrasena' WHERE idUsuario = $idUsuario;";
$result = $conn->query($query3);

$conn->close();

echo "Se modificaron los datos del Paciente";
echo '<script type="text/javascript">';
echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
echo '</script>';
//header("refresh:3; url=index_administrativo.php");
exit();
?>