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
<html lang='es'>

<head>

    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Cancelación de Turnos</title>

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
                        <!--<div class="row"> -->
                        <!--<div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Cancelación de Turnos</h1>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
                                        <form action="cancelar_turno_admin1.php" method="GET">
                                            <div class="text-center">
<?php
// Me conecto a la base
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
    //die("Error en la conexión: " . $mysqli->connect_error);
}
    
$query = "SELECT idUsuario, nombre, apellido, dni FROM pacientes ORDER BY apellido;";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    echo "<tr>";
//    echo "<label for='pacientes'>Selecciones un Paciente:</label>";
    echo "<select name='usuario' id=usuario'>";
    // Output de cada fila
    while($row = $result->fetch_assoc()) {
        $idUsuario = $row['idUsuario'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['dni'];
        echo "<option value='".$idUsuario."'>".$apellido.", ".$nombre." (DNI ". $dni . ")</option>";
    }
    echo "</select><br>";
} else {
    echo "No se encontró ningún paciente<br>";
}
$mysqli->close();
?>
                                        </div>
                                        <div>
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                seleccionar paciente
                                            </a>
                                        </div>
                                    </form>
                                    <div>
                                        <hr>
                                        <a class="btn btn-primary btn-user btn-block" href="index_administrativo.php">
                                            volver
                                        </a>
                                    </div>
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
                <div class="modal-body">¿Está seguro que desea cancelar el turno?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">volver</button>
                    <a class="btn btn-primary" href="cancelar_turno_t.php">Cancelar Turno</a>
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