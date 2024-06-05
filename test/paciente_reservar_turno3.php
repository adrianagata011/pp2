<?php
// usar si es una pagina para el paciente
require_once('verificar_sesion_paciente.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Reservar Turno</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Reservar Turno</h1>
                            </div>
                            <hr>
                            <form id="profForm" class="user" method="post" action="paciente_reservar_turno_insert.php">
                                <div class="form-group">
<?php
if (isset($_POST['idPaciente']) && isset($_POST['idServicio']) && isset($_POST['idProfesional']) && isset($_POST['fecha'])) {
    $idPaciente = $_POST['idPaciente'];
    $idServicio = $_POST['idServicio'];
    $idProfesional = $_POST['idProfesional'];
    $fecha = $_POST['fecha'];
    // Me conecto a la base
    require_once('conexion_db.php');

    // Muestro servicio seleccionado

    $query = "SELECT nombre from servicios where idServicio = $idServicio;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    echo "Servicio: $nombre<br>";

    // Muestro profesional seleccionado

    $query = "SELECT nombre,apellido from profesionales where idProfesional = $idProfesional;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    echo "Profesional: $apellido, $nombre<br>";
    echo "Fecha: $fecha<br>";
}
?>
                                </div>
                                <div class="form-group">
<?php 
echo "idPaciente: $idPaciente<br>";
echo "idServicio: $idServicio<br>";
echo "idProfesional: $idProfesional<br>";
echo "$fecha<br>";

    $query = "SELECT DATE_FORMAT(STR_TO_DATE(horario, '%H:%i'), '%H:%i') AS horario FROM htd WHERE idServicio = $idServicio AND sobreturno = 0 AND DATE_FORMAT(STR_TO_DATE(horario, '%H:%i'), '%H:%i') NOT IN (SELECT DATE_FORMAT(fechaHora,'%H:%i') FROM turnos WHERE idProfesional = $idProfesional AND DATE(fechaHora) = '$fecha');";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<label for='horario'> Reservar Turno: </label>";
        echo "<select name='horario' id='horario'>";
        $primero=1;
        while($row = $result->fetch_assoc()) {
            if ($primero == 1){
                $horario = $row['horario'];
                echo "<option value='$horario' selected>$horario</option>";
                $primero = 0;
            } else {
                $horario = $row['horario'];
                echo "<option value='$horario'>$horario</option>";
            }
        }
        echo "</select>";
    }
    else 
    {
        echo "No se encontraron horarios disponibles<br>";
    }

?>
                                </div>
                                <div class="form-group">
                                <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                <input type="hidden" id="idServicio" name="idServicio" value="<?php echo $idServicio; ?>">
                                <input type="hidden" id="idProfesional" name="idProfesional" value="<?php echo $idProfesional; ?>">
                                <input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
                                <button type="submit" value="reservarTurno" class="btn btn-primary btn-user btn-block"> Reservar Turno </button>
                                </div>
                            </form>
                            <hr>
                            <div class="form-group">                            
                                <a href="index_paciente.php" class="btn btn-primary btn-user btn-block">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php     
$conn->close();
?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>