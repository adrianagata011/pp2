<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] != 2 ) {
    // Si no está logueado, redirigir al usuario a la página de login
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Home del Paciente</title>

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
                        <!-- Nested Row within Card Body -->
                        <!-- //<div class="row">
                            //<div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                    <form action="cancelar_turno_admin2.php" method="GET">
<?php
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    $mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
    if ($mysqli->connect_error) {
        die("Error en la conexión: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8");
    $query = "SELECT nombre, apellido FROM pacientes WHERE idUsuario = ".$usuario.";";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];        
    }
    echo "<div class='text-center'><h1 class='h4 text-gray-900 mb-4'>Gestion de turnos de ".$nombre." ".$apellido."</h1></div>";
    echo "<hr>";
    echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
    echo "<thead><tr><th>Seleccionar</th><th>Fecha</th><th>Servicio</th><th>Profesional</th></tr></thead>";
    echo "<tbody>";

    // Conectar a la base de datos
    //$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
    $mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
    // Verificar conexión
    if ($mysqli->connect_error) {
        //die("Error en la conexión: " . $mysqli->connect_error);
    }

    // ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
    $mysqli->set_charset("utf8");

    $query = "SELECT t.fechaHora as fecha, s.nombre as servicio, p.nombre as nombre,p.apellido as apellido FROM turnos t INNER JOIN profesionales p ON t.idProfesional = p.idProfesional INNER JOIN servicios s ON t.idServicio = s.idServicio INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario WHERE u.idUsuario = '" . $usuario . "' ORDER BY t.fechaHora ASC;";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        // Output de cada fila
        while($row = $result->fetch_assoc()) {
            $fecha = $row['fecha'];
            $servicio = $row['servicio'];
            $profesional = $row['nombre'] . " " . $row['apellido'];
            echo "<tr><td><input type='radio' name='turno' value= '".$usuario."/".$fecha."'></td><td>" . $fecha . "</td><td>" . $servicio . "</td><td>" . $profesional . "</td></tr>";
        }
    } else {
        echo "<tr><td>No se encontraron resultados</td><td></td><td></td></tr>";
    }

    $mysqli->close();
}
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
                                    <a class="btn btn-primary btn-user btn-block" href="cancelar_turno_admin.php">
                                            volver
                                        </a>
                                    </div>
                                </div>
                            <!-- //</div>
                        //</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
