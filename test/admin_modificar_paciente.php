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

    <title>Sistema Clínica - Modificar Paciente</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Modificar Paciente</h1>
                            </div>
                            <hr>

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">DNI <?php echo $_GET['dni']; ?></h1>
                            </div>

                            <?php
if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    // Me conecto a la base
    require_once('conexion_db.php');
    $query = "SELECT idFichaMedica,idPaciente,idUsuario,nombre,apellido,telefono,domicilio,email,obraSocial from pacientes where dni = '$dni';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idFichaMedica = $row['idFichaMedica'];
        $idPaciente = $row['idPaciente'];
        $idUsuario = $row['idUsuario'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $telefono = $row['telefono'];
        $domicilio = $row['domicilio'];
        $email = $row['email'];
        $obraSocial = $row['obraSocial'];
        $query1 = "SELECT grupoSanguineo,observaciones from fichas_medicas where idFichaMedica = '$idFichaMedica';";
        $result = $conn->query($query1);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $grupoSanguineo = $row['grupoSanguineo'];
            $observaciones = $row['observaciones'];
        }
        $query2 = "SELECT usuario,contrasena from usuarios where idUsuario = '$idUsuario';";
        $result = $conn->query($query2);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usuario = $row['usuario'];
            $contrasena = $row['contrasena'];
        }
    }
    else 
    {
        echo "No se seleccionó el paciente<br>";
    }
    $conn->close();
}
?>

                            <form class="user" method="post" action="admin_modificar_paciente_update.php">
                                <div class="form-group">
                                    <input type="nombre" class="form-control form-control-user"
                                        id="nombre" name="nombre" aria-describedby="emailHelp"
                                        value="<?php echo $nombre; ?>"
                                        placeholder="Ingrese el nombre">
                                </div>
                                <div class="form-group">
                                    <input type="apellido" class="form-control form-control-user"
                                        id="apellido" name="apellido" aria-describedby="emailHelp"
                                        value="<?php echo $apellido; ?>"
                                        placeholder="Ingrese el apellido">
                                </div>
                                <div class="form-group">
                                    <input type="telefono" class="form-control form-control-user"
                                        id="telefono" name="telefono" aria-describedby="emailHelp"
                                        value="<?php echo $telefono; ?>"
                                        placeholder="Ingrese el teléfono">
                                </div>
                                <div class="form-group">
                                    <input type="domicilio" class="form-control form-control-user"
                                        id="domicilio" name="domicilio" aria-describedby="emailHelp"
                                        value="<?php echo $domicilio; ?>"
                                        placeholder="Ingrese el domicilio">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="email" name="email" aria-describedby="emailHelp"
                                        value="<?php echo $email; ?>"
                                        placeholder="Ingrese e-mail">
                                </div>
                                <div class="form-group">
                                    <input type="obraSocial" class="form-control form-control-user"
                                        id="obraSocial" name="obraSocial" aria-describedby="emailHelp"
                                        value="<?php echo $obraSocial; ?>"
                                        placeholder="Ingrese la Obra Social">
                                </div>
                                <div class="form-group">
                                    <label for="grupoSanguineo"> Seleccione el Grupo Sanguineo: </label>
                                    <select name="grupoSanguineo" id="grupoSanguineo">
<?php
if ($grupoSanguineo == 'A+') {echo "<option value='A+' selected>A+</option>";} else {echo "<option value='A+'>A+</option>";}
if ($grupoSanguineo == 'A-') {echo "<option value='A-' selected>A-</option>";} else {echo "<option value='A-'>A-</option>";}
if ($grupoSanguineo == 'B+') {echo "<option value='B+' selected>B+</option>";} else {echo "<option value='B+'>B+</option>";}
if ($grupoSanguineo == 'B-') {echo "<option value='B-' selected>B-</option>";} else {echo "<option value='B-'>B-</option>";}
if ($grupoSanguineo == 'AB+') {echo "<option value='AB+' selected>AB+</option>";} else {echo "<option value='AB+'>AB+</option>";}
if ($grupoSanguineo == 'AB-') {echo "<option value='AB-' selected>AB-</option>";} else {echo "<option value='AB-'>AB-</option>";}
if ($grupoSanguineo == 'O+') {echo "<option value='O+' selected>O+</option>";} else {echo "<option value='O+'>O+</option>";}
if ($grupoSanguineo == 'O-') {echo "<option value='O-' selected>O-</option>";} else {echo "<option value='O-'>O-</option>";}
?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="observaciones" class="form-control form-control-user"
                                        id="observaciones" name="observaciones" aria-describedby="emailHelp"
                                        value="<?php echo $observaciones; ?>"
                                        placeholder="Observaciones">
                                </div>
                                <hr>
                                <div class="text-center">
                                    <h6 class="h6 text-gray-900 mb-6">Datos del Sistema</h6>
                                </div>
                                <div class="text-center">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="usuario" class="form-control form-control-user"
                                                id="usuario" name="usuario" aria-describedby="emailHelp"
                                                value="<?php echo $usuario; ?>"
                                                placeholder="Usuario" readonly>
                                            </td>
                                            <td>
                                                <input type="contrasena" class="form-control form-control-user"
                                                id="contrasena" name="contrasena" aria-describedby="emailHelp"
                                                value="<?php echo $contrasena; ?>"
                                                placeholder="Contraseña">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <input type="hidden" id="dni" name="dni" value="<?php echo $_GET['dni']; ?>">
                                <button type="submit" value="Iniciar Sesion" class="btn btn-primary btn-user btn-block"> Grabar Modificaciones </button>
                            </form>
                            <hr>
                            <div class="form-group">                            
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

    <script>
        document.getElementById('horarioIngreso').selectedIndex = 0;
        document.getElementById('horarioEgreso').selectedIndex = 23;
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
                horarioIngreso.selectedIndex = 0;
                horarioEgreso.selectedIndex = 23;
            }
        }
    </script>

</body>

</html>