<?php
require_once('verificar_sesion_admin.php');

if (!isset($_POST['dni']) || empty($_POST['dni'])) {
    header("Location: index_administrativo.php");
    exit();
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el DNI enviado por el método POST
    if (isset($_POST['dni']) && isset($_POST['action'])) {
        $dni = $_POST['dni'];  
        $action = $_POST['action'];


        if ($action != "nuevo_paciente-ale") {
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

            // Verifico si el DNI existe
            $query = "SELECT idpaciente FROM pacientes WHERE dni = '$dni'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) >= 1) {
                header("Location: $action.php?dni=" . urlencode($dni));
                exit();
                }
            }
            else {   
                header("Location: nuevo_paciente_admin.php" . urlencode($dni));
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
