<?php
// usar si es una pagina para el admin
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

    <title>Sistema Clínica - Control Horario</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Control Horario</h1>
                            </div>
                            <hr>
<?php
if (isset($_GET['idProfesional'])) {
    $idProfesional = $_GET['idProfesional'];
    // Me conecto a la base
    require_once('conexion_db.php');
    $query = "SELECT nombre,apellido,idServicio,horarioIngreso,horarioEgreso from profesionales where idProfesional = '$idProfesional';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $idServicio = $row['idServicio'];
        $horarioIngreso = $row['horarioIngreso'];
        $horarioEgreso = $row['horarioEgreso'];
        $query1 = "SELECT nombre from servicios where idServicio = '$idServicio';";
        $result = $conn->query($query1);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $servicio = $row['nombre'];
        }
    }
    else 
    {
        echo "No se seleccionó el profesional<br>";
    }
    $query = "SELECT fechaHoraIngreso, fechaHoraEgreso from control_horario where idProfesional = $idProfesional order by fechaHoraIngreso desc limit 1;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fechaHoraIngreso = $row['fechaHoraIngreso'];
        $fechaHoraEgreso = $row['fechaHoraEgreso'];
        if ($fechaHoraIngreso != null){
            if ($fechaHoraEgreso == null){
                $query = "SELECT idConsultorio from consultorios where idProfesional = $idProfesional;";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $idConsultorio = $row['idConsultorio'];
            } else {
                $idConsultorio = "No tiene consultorio asignado";
            }
        }
    } else {
        $idConsultorio = "No tiene consultorio asignado";
    }
}
?>
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td><b>Profesional</b></td><td><?php echo "Dr. $nombre $apellido"; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Servicio</b></td><td><?php echo $servicio; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Horario Ingreso</b></td><td><?php echo $horarioIngreso; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Horario Egreso</b></td><td><?php echo $horarioEgreso; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Consultorio/Box </b></td><td><?php echo $idConsultorio; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <hr>                            
                            <div class="form-group">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <form id="profForm" class="user" method="post" action="admin_control_horario_update.php">
                                                <input type="hidden" id="idProfesional" name="idProfesional" value="<?php echo $idProfesional; ?>">
                                                <input type="hidden" id="tipoFichada" name="tipoFichada" value="ingreso">
                                                <button type="submit" value="ficharIngreso" class="btn btn-primary btn-user btn-block"> Fichar Ingreso </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form id="profForm" class="user" method="post" action="admin_control_horario_update.php">
                                                <input type="hidden" id="idProfesional" name="idProfesional" value="<?php echo $idProfesional; ?>">
                                                <input type="hidden" id="tipoFichada" name="tipoFichada" value="egreso">
                                                <button type="submit" value="ficharEgreso" class="btn btn-primary btn-user btn-block"> Fichar Egreso </button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="form-group">                            
                                <a href="index_administrativo.php" class="btn btn-primary btn-user btn-block">
                                    Volver
                                </a>
                            </div>
                            <hr>
                            <div class="form-group">                                

<?php
$query = "SELECT fechaHoraIngreso, fechaHoraEgreso from control_horario where idProfesional = $idProfesional order by fechaHoraIngreso desc;";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo "<table width='100%'><tr><td><b>Ingreso Registrado</b></td><td><b>Egreso Registrado</b></td></tr>";
    while($row = $result->fetch_assoc()) {
        $fechaHoraIngreso = $row['fechaHoraIngreso'];
        $fechaHoraEgreso = $row['fechaHoraEgreso'];
        echo "<tr><td>$fechaHoraIngreso</td><td>$fechaHoraEgreso</td></tr>";
    }
    echo "</table>";
}
$conn->close();
?>
                            </div>
                            <hr>
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
