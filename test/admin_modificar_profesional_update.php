<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idProfesional']) || empty($_POST['idProfesional'])) {
    echo "No trajo el idProfesional";
    header("refresh:3; url=admin_modificar_profesional.php");
    exit();
}

if ( !isset($_POST['idServicio']) || empty($_POST['idServicio']) ||
    !isset($_POST['nombre']) || empty($_POST['nombre']) ||
    !isset($_POST['apellido']) || empty($_POST['apellido']) ||
    !isset($_POST['dni']) || empty($_POST['dni']) ||
    !isset($_POST['numeroMatricula']) || empty($_POST['numeroMatricula']) ||
    !isset($_POST['horarioIngreso']) || empty($_POST['horarioIngreso']) ||
    !isset($_POST['horarioEgreso']) || empty($_POST['horarioEgreso'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- apellido<br>";
    echo "- dni<br>";
    echo "- Servicio<br>";
    echo "- numero de Matricula<br>";
    echo "- horario de Ingreso<br>";
    echo "- horario de Engreso<br>";
    $idProfesional = $_POST['idProfesional'];
    header("refresh:3; url=admin_modificar_profesional.php?idProfesional=$idProfesional");
    exit();
}

// Obtener los datos del formulario

$idProfesional = $_POST['idProfesional'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];
$email = $_POST['email'];
$idServicio = $_POST['idServicio'];
$numeroMatricula = $_POST['numeroMatricula'];
$horarioIngreso = $_POST['horarioIngreso'];
$horarioEgreso = $_POST['horarioEgreso'];
$inicioActividad = $_POST['inicioActividad'];

require_once('conexion_db.php');
$query = "UPDATE profesionales SET nombre = '$nombre',apellido = '$apellido',dni = '$dni',telefono = '$telefono',domicilio = '$domicilio',email = '$email',idServicio = $idServicio,numeroMatricula = '$numeroMatricula',horarioIngreso = $horarioIngreso,horarioEgreso = $horarioEgreso,inicioActividad = '$inicioActividad' WHERE idProfesional = $idProfesional;";
if ($conn->query($query) === TRUE) {
    echo "Se actualizó la inforamción del Profesional";
    header("refresh:3; url=index_administrativo.php");
    exit();
} else {
    echo "Error al actualizar la información del Profesional";
    header("refresh:3; url=index_administrativo.php");
    exit();
}
$conn->close();
?>