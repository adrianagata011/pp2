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

    <title>Sistema Clínica - Atención sin turno</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Atención sin turno</h1>
                            </div>
                            <hr>
                            <form id="estudioForm" class="user" method="post" action="admin_atencion_estudio_insert.php">
                                <div class="form-group">
<?php
if (isset($_POST['idPaciente']) && isset($_POST['idServicio'])) {
    $dni = $_POST['dni'];
    $idPaciente = $_POST['idPaciente'];
    $idServicio = $_POST['idServicio'];
    echo "<div class='text-center'><h1 class='h4 text-gray-900 mb-4'>DNI: $dni</h1></div>";
    // Me conecto a la base
    require_once('conexion_db.php');

    // Muestro listado de servicios

    $query = "SELECT nombre from servicios where idServicio = $idServicio;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    echo "Estudios: $nombre<br>";

    // Muestro listado de profesionales

    $query = "SELECT idProfesional,nombre,apellido from profesionales where idServicio = $idServicio order by apellido ASC;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<label for='idProfesional'> Profesional: </label>";
        echo "<select name='idProfesional' id='idProfesional'>";
        while($row = $result->fetch_assoc()) {
            $idProfesional = $row['idProfesional'];
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            echo "<option value='$idProfesional'>$apellido, $nombre</option>";
        }
        echo "</select>";
    }
    else 
    {
        echo "No se encontraron estudios<br>";
    }
    $conn->close();
}
?>
                                </div>
                                <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                                <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                <input type="hidden" id="idServicio" name="idServicio" value="<?php echo $idServicio; ?>">
                                <button type="submit" value="SeleccionarProfesional" class="btn btn-primary btn-user btn-block"> Seleccionar Profesional </button>
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