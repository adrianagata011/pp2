<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idInsumo']) || empty($_POST['idInsumo'])) {
    echo "No trajo el idInsumo";
    header("refresh:3; url=admin_ingresar_Insumo.php");
    exit();
}

if (!isset($_POST['cantidad']) || empty($_POST['cantidad'])) {
    echo "Uno de los campos obligatorios está vacío:<br>";
    echo "- cantidad<br>";
    $idInsumo = $_POST['idInsumo'];
    header("refresh:3; url=admin_ingresar_insumo.php?idInsumo=$idInsumo");
    exit();
}

// Obtener los datos del formulario

$idInsumo = $_POST['idInsumo'];
$cantidad= $_POST['cantidad'];
$cantidadExistente= $_POST['cantidadExistente'];
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