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
<html lang="es">

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
                        <!-- //<div class="row">
                            //<div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Gestion de turnos</h1>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
                                    <form action="cancelar_turno.php" method="GET">
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
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

// Preparar la consulta para evitar inyección SQL
$query = "SELECT t.fechaHora as fecha, s.nombre as servicio, p.nombre as nombre, p.apellido as apellido 
          FROM turnos t 
          INNER JOIN profesionales p ON t.idProfesional = p.idProfesional 
          INNER JOIN servicios s ON t.idServicio = s.idServicio 
          INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente 
          INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario 
          WHERE u.usuario = ? 
          ORDER BY t.fechaHora ASC";

if ($stmt = $mysqli->prepare($query)) {
    // Bind del parámetro
    $stmt->bind_param('s', $usuario);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Output de cada fila
        while ($row = $result->fetch_assoc()) {
            $fecha = htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8');
            $servicio = htmlspecialchars($row['servicio'], ENT_QUOTES, 'UTF-8');
            $profesional = htmlspecialchars($row['nombre'] . " " . $row['apellido'], ENT_QUOTES, 'UTF-8');
            echo "<tr><td><input type='radio' name='turno' value='" . $fecha . "'></td><td>" . $fecha . "</td><td>" . $servicio . "</td><td>" . $profesional . "</td></tr>";
        }
    } else {
        echo "<tr><td>No se encontraron resultados</td><td></td><td></td></tr>";
    }

    // Cerrar el statement
    $stmt->close();
} else {
    // Manejo de errores en la preparación de la consulta
    die("Error en la preparación de la consulta: " . $mysqli->error);
}

// Cerrar la conexión
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
                                        <a href="reservar_turno.php" class="btn btn-primary btn-user btn-block">
                                            reservar turno
                                        </a>
                                    <hr>

                                        <a href="index_paciente.php" class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                            Salir
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
