<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['idProfesional']) || empty($_POST['idProfesional'])) {
    header("Location: index_administrativo.php");
    exit();
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el DNI enviado por el método POST
    if (isset($_POST['idProfesional']) && isset($_POST['action'])) {
        $idProfesional = $_POST['idProfesional'];  
        $action = $_POST['action'];


        if ($action != "nuevo_profesional_admin") {
            // Me conecto a la base
            require_once('conexion_db.php');

/*
            $conn = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
            // Verificar conexión
            if ($conn->connect_error) {
                die("Error en la conexión: " . $conn->connect_error);
            }
            // seteo charset=utf8
            $conn->set_charset("utf8");
*/

            // Verifico si el idProfesional existe
            $query = "SELECT idProfesional FROM profesionales WHERE idProfesional = '$idProfesional'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) >= 1) {
                header("Location: $action.php?dni=" . urlencode($dni));
                exit();
            }
            else
            {
                header("Location: nuevo_profesional_admin.php?dni=" . urlencode($dni));
                exit();
            }
        }
        else {   
            header("Location: nuevo_profesional_admin.php?dni=" . urlencode($dni));
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
