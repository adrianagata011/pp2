<?php
// usar si es una pagina para el paciente
require_once('verificar_sesion_admin.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Registrar Atención</title>
    <link rel="icon" href="img/logo.ico" sizes="32x32" type="image/ico">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">

                            <!-- Columna simple centrada con Card Body -->
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrar Atención</h1>
                            </div>
                            <hr>
                            <form id="profForm" class="user" method="post" action="admin_registrar_atencion_update.php">
                                <div class="form-group">
<?php
if (isset($_POST['idPaciente']) && isset($_POST['idServicio'])) {
    $dni = $_POST['dni'];
    $idPaciente = $_POST['idPaciente'];
    $idServicio = $_POST['idServicio'];
    $idTurno = $_POST['idTurno'];
    $idProfesional = $_POST['idProfesional'];
    $fecha = $_POST['fecha'];
    echo "<div class='text-center'><h1 class='h4 text-gray-900 mb-4'>DNI: $dni</h1></div><hr>";

    require_once('conexion_db.php');

    // Muestro paciente
    $query = "SELECT nombre,apellido from pacientes where idPaciente = $idPaciente;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    echo "<b>Paciente:</b> $nombre $apellido<br>";

    // Muestro profesional
    $query = "SELECT nombre,apellido from profesionales where idProfesional = $idProfesional;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    echo "<b>Profesional:</b> $nombre $apellido<br>";

    // Muestro servicio
    $query = "SELECT nombre from servicios where idServicio = $idServicio;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    echo "<b>Servicio:</b> $nombre<br>";

    // Muestro turno
    echo "<b>Turno:</b> $fecha<br>";

    $conn->close();
}
?>
                                </div>
                                <label for="observacion">Registre la atención (máximo 100 caracteres):</label><br>
                                <textarea id="observacion" name="observacion" maxlength="100" rows="2" cols="50" placeholder="Registre la atención médica" required></textarea>
                                <input type="hidden" id="idServicio" name="idServicio" value="<?php echo $idServicio; ?>">
                                <input type="hidden" id="idTurno" name="idTurno" value="<?php echo $idTurno; ?>">
                                <input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
                                <button type="submit" value="registrarAtencion" class="btn btn-primary btn-user btn-block"> Registrar Atención </button>
                            </form>
                            <hr>
                            <div class="form-group">                            
                                <a href="index_administrativo.php" class="btn btn-primary btn-user btn-block">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>