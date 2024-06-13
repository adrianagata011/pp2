<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idInsumo']) || empty($_POST['idInsumo'])) {
    echo "No trajo el idInsumo";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_ingresar_Insumo.php"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=admin_ingresar_Insumo.php");
    exit();
}

if (!isset($_POST['cantidad']) || empty($_POST['cantidad'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- cantidad<br>";
    $idInsumo = $_POST['idInsumo'];
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "admin_ingresar_insumo.php?idInsumo='.$idInsumo.'"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=admin_ingresar_insumo.php?idInsumo=$idInsumo");
    exit();
}

// Obtener los datos del formulario

$idInsumo = $_POST['idInsumo'];
$cantidad= $_POST['cantidad'];
$cantidadExistente= $_POST['cantidadExistente'];
$sumaCantidades = $cantidad + $cantidadExistente;
require_once('conexion_db.php');
$query = "UPDATE insumos SET cantidadExistente = $sumaCantidades WHERE idInsumo = $idInsumo;";
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