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

    <title>Sistema Clínica - Reservar Turno para Estudio</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Reservar Turno para Estudio</h1>
                            </div>
                            <hr>
                            <form id="profForm" class="user" method="post" action="admin_reservar_estudio1.php">
                                <div class="form-group">
<?php
if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    echo "<div class='text-center'><h1 class='h4 text-gray-900 mb-4'>DNI: $dni</h1></div>";
    require_once('conexion_db.php');
    $query = "SELECT idPaciente from pacientes where dni = $dni;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $idPaciente = $row['idPaciente'];
    $query = "SELECT idServicio, nombre from servicios WHERE nombre LIKE 'Estudio_%' AND idServicio NOT IN (31, 32,40) order by nombre ASC;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<label for='idServicio'> Estudio: </label>";
        echo "<select name='idServicio' id='idServicio'>";
        while($row = $result->fetch_assoc()) {
            $idServicio = $row['idServicio'];
            $nombre = $row['nombre'];
            echo "<option value='$idServicio'>$nombre</option>";
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
                                <button type="submit" value="SeleccionarEstudio" class="btn btn-primary btn-user btn-block"> Seleccionar Estudio </button>
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