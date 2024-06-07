<?php
// Iniciar la sesión
session_start();

<<<<<<< Updated upstream:test/reservar_turno.php
// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] != 1 ) {
    // Si no está logueado, redirigir al usuario a la página de login
    header("Location: login.html");
    exit;
=======
if (isset($_GET['idPaciente'])) {
    $idPaciente = $_GET['idPaciente'];
    // Me conecto a la base
    require_once('conexion_db.php');
    $query1 = "SELECT idServicio,nombre from servicios order by nombre ASC;";
    $query2 = "SELECT idEstudio,nombre from estudios order by nombre ASC;";
    $result1 = $conn->query($query1);
    $result2 = $conn->query($query2);
}
else {
    header("Location: index_paciente.php");
>>>>>>> Stashed changes:test/paciente_reservar_turno.php
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

    <title>Sistema Clínica - Reservar Turnos</title>

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
                                <h1 class="h4 text-gray-900 mb-4">Reservar Turnos</h1>


                            </div>
<<<<<<< Updated upstream:test/reservar_turno.php

<hr>
                            
                            <hr>      
                            <div class="text-center">
                                <hr>
                                <a class="btn btn-primary btn-user btn-block" href="index_paciente.php">
                                    volver
=======
                            <hr>
                            <form id="profForm" class="user" method="post" action="paciente_reservar_turno1.php">
                                <div class="form-group">
<?php
    if ($result1->num_rows > 0) {
        echo "<label for='idServicio'> Servicio: </label>";
        echo "<select name='idServicio' id='idServicio'>";
        while($row = $result1->fetch_assoc()) {
            $idServicio = $row['idServicio'];
            $nombre = $row['nombre'];
            echo "<option value='$idServicio'>$nombre</option>";
        }
        echo "</select>";
    }
    else 
    {
        echo "No se encontraron servicios<br>";
    }

?>
                                </div>
                                <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                <button type="submit" value="SeleccionarServicio" class="btn btn-primary btn-user btn-block"> Seleccionar Servicio </button>
                            </form>
                            <hr>
                            <div class="form-group">                            
                             
                            </div>






                            







                            <!-- Columna simple centrada con Card Body -->
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Estudios clinicos</h1>
                            </div>
                            <hr>
                            <form id="profForm" class="user" method="post" action="paciente_reservar_estudio1.php">
                                <div class="form-group">
                                <?php
    if ($result2->num_rows > 0) {
        echo "<label for='idEstudio'> Estudio: </label>";
        echo "<select name='idEstudio' id='idEstudio'>";
        while($row = $result2->fetch_assoc()) {
            $idEstudio = $row['idEstudio'];
            $nombre = $row['nombre'];
            echo "<option value='$idEstudio'>$nombre</option>";
        }
        echo "</select>";
    }
    else 
    {
        echo "No se encontraron estudios<br>";
    }

?>
                                </div>
                                <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                <button type="submit" value="SeleccionarEstudio" class="btn btn-primary btn-user btn-block"> Seleccionar estudio </button>
                            </form>
                            <hr>
                            <div class="form-group">                            
                                <a href="index_paciente.php" class="btn btn-primary btn-user btn-block">
                                    Volver
>>>>>>> Stashed changes:test/paciente_reservar_turno.php
                                </a>
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
