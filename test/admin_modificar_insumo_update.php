<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idInsumo']) || empty($_POST['idInsumo'])) {
    echo "No trajo el idInsumo";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_modificar_Insumo.php"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=admin_modificar_Insumo.php");
    exit();
}

if (!isset($_POST['nombre']) || empty($_POST['nombre']) ||
    !isset($_POST['cantidadMinima']) || empty($_POST['cantidadMinima']) ||
    !isset($_POST['cantidadExistente']) || empty($_POST['cantidadExistente'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- nombre<br>";
    echo "- cantidad minima<br>";
    echo "- cantidad existente<br>";
    $idInsumo = $_POST['idInsumo'];
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_modificar_insumo.php?idInsumo='.$idInsumo.'"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=admin_modificar_insumo.php?idInsumo=$idInsumo");
    exit();
}

// Obtener los datos del formulario

$idInsumo = $_POST['idInsumo'];
$nombre = $_POST['nombre'];
$cantidadMinima = $_POST['cantidadMinima'];
$cantidadExistente = $_POST['cantidadExistente'];
$descripcion = $_POST['descripcion'];
$observaciones = $_POST['observaciones'];
require_once('conexion_db.php');
$query = "UPDATE insumos SET nombre = '$nombre',cantidadMinima = '$cantidadMinima',cantidadExistente = '$cantidadExistente',descripcion = '$descripcion',observaciones = '$observaciones' WHERE idInsumo = $idInsumo;";
if ($conn->query($query) === TRUE) {
    echo "Se actualizó la inforamción del Insumo";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=index_administrativo.php");
    exit();
} else {
    echo "Error al actualizar la información del Insumo";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
    echo '</script>';
    //header("refresh:3; url=index_administrativo.php");
    exit();
}
$conn->close();
?>