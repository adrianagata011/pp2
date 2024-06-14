<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['idPaciente']) || empty($_POST['idPaciente']) ||
    !isset($_POST['idServicio']) || empty($_POST['idServicio']) ||
    !isset($_POST['idProfesional']) || empty($_POST['idProfesional']) ||
    !isset($_POST['fecha']) || empty($_POST['fecha']) ||
    !isset($_POST['horario']) || empty($_POST['horario'])) {
        echo "Uno de los campos obligatorios está vacío:<br>";
        echo "- Profesional<br>";
        echo "- Servicio<br>";
        echo "- Paciente<br>";
        echo "- Fecha<br>";
        echo "- Horario<br>";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
        echo '</script>';
        //header("refresh:3; url=index_administrativo.php");
        exit();
    }

if (isset($_POST['idPaciente']) && isset($_POST['idServicio']) && isset($_POST['idProfesional']) && isset($_POST['fecha']) && isset($_POST['horario'])) {
    $idPaciente = $_POST['idPaciente'];
    $idServicio = $_POST['idServicio'];
    $idProfesional = $_POST['idProfesional'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];

    // Me conecto a la base
    require_once('conexion_db.php');
    
    // Obtener los datos del formulario

    $query = "INSERT INTO turnos (idProfesional,idServicio,idPaciente,fechaHora,sobreturno) VALUES ($idProfesional,$idServicio,$idPaciente,STR_TO_DATE('$fecha $horario', '%Y-%m-%d %H:%i'),0);";
    $result = $conn->query($query);
    $conn->close();

    echo "Turno Reservado";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
    echo '</script>';
    //header("refresh:3; url=index_administrativo.php");
    exit();
}
?>