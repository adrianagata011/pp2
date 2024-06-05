<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['idTurno']) || empty($_POST['idTurno']) ||
    !isset($_POST['idServicio']) || empty($_POST['idServicio']) ||
    !isset($_POST['observacion']) || empty($_POST['observacion']) ||
    !isset($_POST['fecha']) || empty($_POST['fecha']) ) {
        echo "Uno de los campos obligatorios está vacío:<br>";
        echo "- Servicio<br>";
        echo "- Turno<br>";
        echo "- Fecha<br>";
        echo "- Observacion<br>";
        header("refresh:3; url=index_administrativo.php");
        exit();
    }

if (isset($_POST['idTurno']) && isset($_POST['idServicio']) && isset($_POST['fecha']) && isset($_POST['observacion'])) {
    $idServicio = $_POST['idServicio'];
    $idTurno = $_POST['idTurno'];
    $fecha = $_POST['fecha'];
    $observacion = $_POST['observacion'];

    // Me conecto a la base
    require_once('conexion_db.php');
    
    // Obtener los datos del formulario

    $query = "INSERT INTO historias_clinicas (idServicio,idTurno,fecha,observacion) VALUES ($idServicio,$idTurno,'$fecha','$observacion');";
    $result = $conn->query($query);
    $conn->close();

    echo "Atención Registrada";
    header("refresh:3; url=index_administrativo.php");
    exit();
}
?>