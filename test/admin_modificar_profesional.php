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

    <title>Sistema Clínica - Modificar Profesional</title>

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
                                <h1 class="h4 text-gray-900 mb-4">Modificar Profesional</h1>
                            </div>
                            <hr>
<?php
if (isset($_GET['idProfesional'])) {
    $idProfesional = $_GET['idProfesional'];
    // Me conecto a la base
    require_once('conexion_db.php');
    $query = "SELECT idServicio,nombre,apellido,dni,telefono,domicilio,email,numeroMatricula,horarioIngreso,horarioEgreso,inicioActividad,finActividad from profesionales where idProfesional = '$idProfesional';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idServicio = $row['idServicio'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['dni'];
        $telefono = $row['telefono'];
        $domicilio = $row['domicilio'];
        $email = $row['email'];
        $numeroMatricula = $row['numeroMatricula'];
        $horarioIngreso = $row['horarioIngreso'];
        $horarioEgreso = $row['horarioEgreso'];
        $inicioActividad = $row['inicioActividad'];
        $finActividad = $row['finActividad'];
    }
    else 
    {
        echo "No se seleccionó el profesional<br>";
    }
    $conn->close();
}
?>

                            <form id="profForm" class="user" method="post" action="admin_modificar_profesional_update.php">
                                <div class="form-group">
                                    <input type="nombre" class="form-control form-control-user"
                                        id="nombre" name="nombre" aria-describedby="emailHelp"
                                        <?php echo "value='$nombre'";?>
                                        placeholder="Ingrese el nombre">
                                </div>
                                <div class="form-group">
                                    <input type="apellido" class="form-control form-control-user"
                                        id="apellido" name="apellido" aria-describedby="emailHelp"
                                        <?php echo "value='$apellido'";?>
                                        placeholder="Ingrese el apellido">
                                </div>
                                <div class="form-group">
                                    <input type="dni" class="form-control form-control-user"
                                        id="dni" name="dni" aria-describedby="emailHelp"
                                        <?php echo "value='$dni'";?>
                                        placeholder="Ingrese el DNI">
                                </div>
                                <div class="form-group">
                                    <input type="telefono" class="form-control form-control-user"
                                        id="telefono" name="telefono" aria-describedby="emailHelp"
                                        <?php echo "value='$telefono'";?>
                                        placeholder="Ingrese el teléfono">
                                </div>
                                <div class="form-group">
                                    <input type="domicilio" class="form-control form-control-user"
                                        id="domicilio" name="domicilio" aria-describedby="emailHelp"
                                        <?php echo "value='$domicilio'";?>
                                        placeholder="Ingrese la dirección">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="email" name="email" aria-describedby="emailHelp"
                                        <?php echo "value='$email'";?>
                                        placeholder="Ingrese e-mail">
                                </div>
                                <div class="form-group">
<?php
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
$query = "SELECT idServicio,nombre FROM servicios ORDER BY nombre ASC;";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    echo "<label for='idServicio'> Servicio: </label>";
    echo "<select name='idServicio' id='idServicio'>";
    while($row = $result->fetch_assoc()) {
      $idServicioTemp = $row['idServicio'];
      $nombre = $row['nombre'];
      if ($idServicioTemp == $idServicio) {
        echo "<option value='$idServicioTemp' selected>$nombre</option>";
      }
      else
      {
        echo "<option value='$idServicioTemp'>$nombre</option>";
      }
    }
    echo "</select>";
} else {
    echo "Error al traer datos de Servicios<br>";
}
$mysqli->close();
?>
                                </div>
                                <div class="form-group">
                                    <input type="numeroMatricula" class="form-control form-control-user"
                                        id="numeroMatricula" name="numeroMatricula" aria-describedby="emailHelp"
                                        <?php echo "value='$numeroMatricula'";?>
                                        placeholder="Ingrese el número de matricula">
                                </div>
                                <div class="form-group">
                                    <label for="horarioIngreso"> Seleccione un Horario de Ingreso: </label>
                                    <select name="horarioIngreso" id="horarioIngreso">
                                    <script>
                                        for (let i = 0; i <= 23; i++) {
                                            document.write('<option value="' + i + '">' + i + '</option>');
                                        }
                                    </script>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="horarioEgreso"> Seleccione un Horario de Engreso: </label>
                                    <select name="horarioEgreso" id="horarioEgreso">
                                    <script>
                                        for (let i = 0; i <= 23; i++) {
                                            document.write('<option value="' + i + '">' + i + '</option>');
                                        }
                                    </script>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="inicioActividad" class="form-control form-control-user"
                                        id="inicioActividad" name="inicioActividad" aria-describedby="emailHelp"
                                        <?php echo "value='$inicioActividad'";?>
                                        placeholder="Ingrese fecha de inicio de Actividad">
                                </div>
                                <input type="hidden" id="idProfesional" name="idProfesional" value="<?php echo $idProfesional; ?>">
                                <button type="submit" value="GrabarModificaciones" class="btn btn-primary btn-user btn-block"> Grabar modificaciones </button>
                            </form>
                            <hr>
                            <a href="admin_modificar_profesional_baja.php?idProfesional=<?php echo $idProfesional; ?>" class="btn btn-primary btn-user btn-block">
                                Dar de baja al profesional
                            </a>
                            <hr>
                            <div class="form-group">                            
                                <a href="index_administrativo.php" class="btn btn-primary btn-user btn-block">
                                    Volver sin grabar
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

    <script>
        document.getElementById('horarioIngreso').selectedIndex = <?php echo $horarioIngreso; ?>;
        document.getElementById('horarioEgreso').selectedIndex = <?php echo $horarioEgreso; ?>;
        document.getElementById('horarioIngreso').addEventListener('change', validateSelects);        
        document.getElementById('horarioEgreso').addEventListener('change', validateSelects);

        function validateSelects() {
            var horarioIngreso = document.getElementById('horarioIngreso');
            var horarioEgreso = document.getElementById('horarioEgreso');
            var value1 = parseInt(horarioIngreso.value);
            var value2 = parseInt(horarioEgreso.value);

            if (value1 > value2) {
                alert('Error: El Horario de Ingreso no puede ser mayor al Horario de Egreso');
                // Reset both selects
                horarioIngreso.selectedIndex = <?php echo $horarioIngreso; ?>;
                horarioEgreso.selectedIndex = <?php echo $horarioEgreso; ?>;
            }
        }
    </script>

</body>

</html>