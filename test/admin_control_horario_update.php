<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idProfesional']) || empty($_POST['idProfesional'])) {
    echo "No trajo el idInsumo";
    header("refresh:3; url=index_administrativo.php");
    exit();
}

if (!isset($_POST['tipoFichada']) || empty($_POST['tipoFichada'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- tipoFichada<br>";
    $idProfesional = $_POST['idProfesional'];
    header("refresh:3; url=admin_control_horario.php?idInsumo=$idProfesional");
    exit();
}

// Obtener los datos del formulario

$idProfesional = $_POST['idProfesional'];
$tipoFichada= $_POST['tipoFichada'];

// si tipoFichada = ingreso
// reviso si ya no hay uno para el día de hoy
// si hay rechazo, si no hay insert

// si tipoFichada = egreso
// reviso si hay un tipoFichada = ingreso para este día
//      si hay reviso si hay un tipoFichada = egreso para este día
//           si hay rechazo, si no hay insert
//      si no hay rechazo




if ($cantidad > $cantidadExistente) {
    echo "No se puede egresar una cantidad mayor a la Existente ($cantidadExistente)<br>";
    $idInsumo = $_POST['idInsumo'];
    header("refresh:3; url=admin_egresar_insumo.php?idInsumo=$idInsumo");
    exit();
}
else
{
    $restaCantidades = $cantidadExistente - $cantidad;
    require_once('conexion_db.php');
    $query = "UPDATE insumos SET cantidadExistente = $restaCantidades WHERE idInsumo = $idInsumo;";
    if ($conn->query($query) === TRUE) {
        echo "Se actualizó la inforamción del Insumo";
        header("refresh:3; url=index_administrativo.php");
        exit();
    } else {
        echo "Error al actualizar la información del Insumo";
        header("refresh:3; url=index_administrativo.php");
        exit();
    }
    $conn->close();
}
?>