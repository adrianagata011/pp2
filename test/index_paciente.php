<?php
require_once('verificar_sesion_paciente.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Home del Paciente</title>
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
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Gestion de turnos</h1>
                            </div>
                            <hr>      
                            <div class="text-center">
                                <form action="paciente_cancelar_turno.php" method="GET">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Fecha</th>
                                                <th>Servicio</th>
                                                <th>Profesional</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
//$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
    //die("Error en la conexión: " . $mysqli->connect_error);
}

// ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

$query = "SELECT pa.idPaciente as idPaciente, t.fechaHora as fecha, s.nombre as servicio, p.nombre as nombre,p.apellido as apellido FROM turnos t INNER JOIN profesionales p ON t.idProfesional = p.idProfesional INNER JOIN servicios s ON t.idServicio = s.idServicio INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario WHERE u.usuario = '" . $usuario . "' ORDER BY t.fechaHora ASC;";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    // Output de cada fila
    while($row = $result->fetch_assoc()) {
        $idPaciente = $row['idPaciente'];
        $fecha = $row['fecha'];
        $servicio = $row['servicio'];
        $profesional = $row['nombre'] . " " . $row['apellido'];
        echo "<tr><td><input type='radio' name='turno' value= '" . $fecha . "'></td><td>" . $fecha . "</td><td>" . $servicio . "</td><td>" . $profesional . "</td></tr>";
    }
} else {
    echo "<tr><td>No se encontraron resultados</td><td></td><td></td></tr>";
}

$mysqli->close();

?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                            cancelar turno
                                    </button>
                                <hr>
                                </form>
                            </div>
                            <div>
                                <a href="paciente_reservar_turno.php?idPaciente=<?php echo $idPaciente;?>" class="btn btn-primary btn-user btn-block">
                                    reservar turno
                                </a>
                            <hr>

                                <a href="logout.php" class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                    Salir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <?php include 'logout_modal.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
