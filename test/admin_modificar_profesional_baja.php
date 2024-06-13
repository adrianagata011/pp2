<?php
require_once('verificar_sesion_admin.php');

if (isset($_GET['idProfesional'])) {
    $idProfesional = $_GET['idProfesional'];
    require_once('conexion_db.php');
    $query = "UPDATE profesionales set finActividad = CURDATE() where idProfesional = $idProfesional;";
    if ($conn->query($query) === TRUE) {
        echo "Se dió de baja al Profesional";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
        echo '</script>';
        //header("refresh:3; url=index_administrativo.php");
        exit();
    } else {
        echo "Error al dar de baja al Profesional";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
        echo '</script>';
        //header("refresh:3; url=index_administrativo.php");
        exit();
    }
    $conn->close();
}
?>