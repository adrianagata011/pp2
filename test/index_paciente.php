<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] != 1 ) {
    // Si no está logueado, redirigir al usuario a la página de login
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Gestion de turnos</h1>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
                                        <table>
                                            <tr>
                                                <td>Fecha</td>
                                                <td>Servicio</td>
                                                <td>Profesional</td>
                                            </tr>
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
// $mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$select_result = $mysqli->query("SELECT t.fechaHora, s.nombre, p.nombre,p.apellido FROM turnos t INNER JOIN profesionales p ON t.idProfesional = p.idProfesional INNER JOIN servicios s ON t.idServicio = s.idServicio INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario WHERE u.usuario = '$usuario';");
$row = $select_result->fetch_assoc();
$existe = $row['existe'];
$rol = $row['rol'];

if ($select_result->num_rows > 0) {
    // Output de cada fila
    while($row = $select_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['fechaHora'] . "</td><td>" . $row['nombre'] . "</td><td>" . $row['nombre'] . $row['apellido'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";    
    echo "<td>No se encontraron resultados</td><td></td><td></td>";
    echo "</tr>";    
}

$mysqli->close();

?>
                                        </table>
                                    </div>
                                    <hr>
                                       
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            reservar turno
                                        </a>
                                       
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                             cancelar turno
                                        </a>
                                    <hr>

                                        <a href="index.html" class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                            Salir
                                        </a>
                                   
                                </div>
                            </div>
                        </div>
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