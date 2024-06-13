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

    <title>Sistema Clínica - Liquidar Honorarios</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Liquidar Honorarios</h1>
                            </div>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
<?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');
$mes_actual = strftime("%B del %Y");
$mes_actual = ucfirst($mes_actual);
echo $mes_actual;
?>
                                </h1>
                            </div>
                            <div class="text-center">
<?php
if (isset($_GET['idProfesional'])) {
    $idProfesional = $_GET['idProfesional'];
} else {
    echo "No se trajo el id del Profesional desde el menú anterior<br>";
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
    echo '</script>'; 
    //header("refresh:3; url=index_administrativo.php");
    exit();
}
require_once('conexion_db.php');
$query = "SELECT nombre,apellido from profesionales where idProfesional = $idProfesional;";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$nombre = $row['nombre'];
$apellido = $row['apellido'];
?>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Dr. <?php echo "$nombre $apellido"; ?></h1>
                            </div>
                            <hr>
<?php
$query = "SELECT DATE(t.fechaHora) as dia, s.precio as precio, count(*) as turnosAtendidos FROM turnos t  INNER JOIN profesionales p ON t.idProfesional = p.idProfesional INNER JOIN servicios s ON t.idServicio = s.idServicio WHERE p.idProfesional = '$idProfesional' and MONTH(t.fechaHora) = MONTH(NOW()) and t.acreditado IS TRUE GROUP BY DATE(t.fechaHora) ORDER BY t.fechaHora ASC;";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><td>Fecha</td><td>Turnos Atendidos</td><td>Importe</td></tr>";
    $importeTotal=0;
    while($row = $result->fetch_assoc()) {
        $dia = $row['dia'];
        $precio = $row['precio'];
        $turnosAtendidos = $row['turnosAtendidos'];
        $importeDiario = $precio * $turnosAtendidos;
        echo "<tr><td>$dia</td><td>$turnosAtendidos</td><td>$importeDiario</td></tr>";
        $importeTotal = $importetotal + ($turnosAtendidos*$precio);
    }
    echo "</table>";
    echo "<div class='text-center'>";
    echo "<h1 class='h4 text-gray-900 mb-4'>Importe total: $importeTotal</h1>";
    echo "</div>";
}
else 
{
    echo "No se registran turnos atendidos para este mes<br>";
}
$conn->close();
?>
                            <hr>
                            <div>                            
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
