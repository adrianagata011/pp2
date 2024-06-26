<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idProfesional'])) {
//    || empty($_POST['idProfesional'])
    header("Location: index_administrativo.php");
    exit();
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el DNI enviado por el método POST
    if (isset($_POST['idProfesional']) && isset($_POST['action'])) {
        $idProfesional = $_POST['idProfesional'];  
        $action = $_POST['action'];
        if ($action != "admin_nuevo_profesional") {
            // Me conecto a la base
            require_once('conexion_db.php');
            // Verifico si el idProfesional existe
            $query = "SELECT idProfesional FROM profesionales WHERE idProfesional = '$idProfesional'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) >= 1) {
                header("Location: $action.php?idProfesional=" . urlencode($idProfesional));
                exit();
            }
            else
            {
                header("Location: index_administrativo.php");
                exit();
            }
        }
        else {   
            header("Location: admin_nuevo_profesional.php");
            exit();
        }
    }    
    else {
        // O no se envía DNI o no se envia action y se redirige a la página de administración
        header("Location: index_administrativo.php");
        exit();
    }
}
else {
    // Si no se recibió una solicitud POST, redirigir de nuevo a la página de administración
    header("Location: index_administrativo.php");
    exit();
}

?>
