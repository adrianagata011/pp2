<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idProfesional']) || empty($_POST['idProfesional'])) {
    echo "No trajo el idInsumo";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=index_administrativo.php");
    exit();
}

if (!isset($_POST['tipoFichada']) || empty($_POST['tipoFichada'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- tipoFichada<br>";
    $idProfesional = $_POST['idProfesional'];
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=admin_control_horario.php?idInsumo=$idProfesional");
    exit();
}

// Obtener los datos del formulario

$idProfesional = $_POST['idProfesional'];
$tipoFichada = $_POST['tipoFichada'];

require_once('conexion_db.php');

if ($tipoFichada == "ingreso"){
    $query = "SELECT fechaHoraIngreso FROM control_horario WHERE idProfesional = $idProfesional AND DATE(fechaHoraIngreso) = CURDATE();";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "Ya hay un ingreso para el día de hoy";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
        echo '</script>'; 
        //header("refresh:3; url=admin_control_horario.php?idProfesional=$idProfesional");
        exit();
    } else {
        $query1 = "INSERT INTO control_horario (idProfesional, fechaHoraIngreso) VALUES ($idProfesional, NOW());";
        $result = $conn->query($query1);
        echo "Se fichó el ingreso";
        // Buscar un consultorio libre idConsultorio 
        $query2 = "SELECT idConsultorio from consultorios where idProfesional IS NULL LIMIT 1;";
        $result = $conn->query($query2);
        $row = $result->fetch_assoc();
        $idConsultorio = $row['idConsultorio'];
        // Update idProfesional en tabla consultorios
        $query3 = "UPDATE consultorios set idProfesional = $idProfesional where idConsultorio = $idConsultorio;";
        $row = $result->fetch_assoc();
        $result = $conn->query($query3);
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
        echo '</script>'; 
        //header("refresh:3; url=admin_control_horario.php?idProfesional=$idProfesional");
        exit();
    }
} else {
    $query = "SELECT fechaHoraIngreso FROM control_horario WHERE idProfesional = $idProfesional AND DATE(fechaHoraIngreso) = CURDATE();";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $query1 = "SELECT fechaHoraEgreso FROM control_horario WHERE idProfesional = $idProfesional AND DATE(fechaHoraEgreso) = CURDATE();";
        $result = $conn->query($query1);
        if ($result->num_rows > 0) {
            echo "Ya hay un egreso para el día de hoy";
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
            echo '</script>';             
            //header("refresh:3; url=admin_control_horario.php?idProfesional=$idProfesional");
            exit();
        } else {
            $query2 = "UPDATE control_horario SET fechaHoraEgreso = NOW() WHERE idProfesional = $idProfesional AND DATE(fechaHoraIngreso) = CURDATE();";
            $result = $conn->query($query2);
            echo "Se fichó el egreso";
            // Buscar el consultorio donde esta el idProfesional
            $query2 = "SELECT idConsultorio from consultorios where idProfesional = $idProfesional;";
            $result = $conn->query($query2);
            $row = $result->fetch_assoc();
            $idConsultorio = $row['idConsultorio'];
            // Update idProfesional = null en tabla consultorios
            $query3 = "UPDATE consultorios set idProfesional = null where idConsultorio = $idConsultorio;";
            $row = $result->fetch_assoc();
            $result = $conn->query($query3);
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
            echo '</script>'; 
            // header("refresh:3; url=admin_control_horario.php?idProfesional=$idProfesional");
            exit();
        }
    } else {
        echo "No hay ingreso para el día de hoy";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "admin_control_horario.php?idProfesional='.$idProfesional.'"; }, 3000);';
        echo '</script>';         
        //header("refresh:3; url=admin_control_horario.php?idProfesional=$idProfesional");
        exit();
    }    
}
$conn->close();

// si tipoFichada = ingreso
// reviso si ya no hay uno para el día de hoy
// si hay rechazo, si no hay insert

// si tipoFichada = egreso
// reviso si hay un tipoFichada = ingreso para este día
//      si hay reviso si hay un tipoFichada = egreso para este día
//           si hay rechazo, si no hay insert
//      si no hay rechazo

?>