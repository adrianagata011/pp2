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
        if ($action != "admin_nuevo_paciente") {
            // Me conecto a la base
            require_once('conexion_db.php');
            // Verifico si el DNI existe
            $query = "SELECT idpaciente FROM pacientes WHERE dni = '$dni'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) >= 1) {
                header("Location: $action.php?dni=" . urlencode($dni));
                exit();
            }
            else
            {
                header("Location: admin_nuevo_paciente.php?dni=" . urlencode($dni));
                exit();
            }
        }
        else {
            require_once('conexion_db.php');
            $query = "SELECT idpaciente FROM pacientes WHERE dni = '$dni'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                header("Location: $action.php?dni=" . urlencode($dni));
                exit();
            }
            else 
            {
                header("Location: admin_modificar_paciente.php?dni=" . urlencode($dni));
                exit();
            }
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
