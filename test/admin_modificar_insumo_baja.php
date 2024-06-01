<?php
require_once('verificar_sesion_admin.php');

if (isset($_GET['idInsumo'])) {
    $idInsumo = $_GET['idInsumo'];
    require_once('conexion_db.php');
    $query = "UPDATE insumos set baja = 1 where idInsumo = $idInsumo;";
    if ($conn->query($query) === TRUE) {
        echo "Se dió de baja al Insumo";
        header("refresh:3; url=index_administrativo.php");
        exit();
    } else {
        echo "Error al dar de baja al Insumo";
        header("refresh:3; url=index_administrativo.php");
        exit();
    }
    $conn->close();
}
?>