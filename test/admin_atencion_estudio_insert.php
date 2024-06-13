<?php
require_once('verificar_sesion_admin.php');

if ( !isset($_POST['idPaciente']) || empty($_POST['idPaciente']) ||
    !isset($_POST['idServicio']) || empty($_POST['idServicio']) ||
    !isset($_POST['idProfesional']) || empty($_POST['idProfesional'])){
        echo "Uno de los campos obligatorios está vacío:<br>";
        echo "- Profesional<br>";
        echo "- Servicio<br>";
        echo "- Paciente<br>";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href = "index_administrativo.php"; }, 3000);';
        echo '</script>'; 
        //header("refresh:3; url=index_administrativo.php");
        exit();
    }

if (isset($_POST['idPaciente']) && isset($_POST['idServicio']) && isset($_POST['idProfesional'])) {
    $idPaciente = $_POST['idPaciente'];
    $idServicio = $_POST['idServicio'];
    $idProfesional = $_POST['idProfesional'];
    $horario ='00:00';

    // Me conecto a la base
    require_once('conexion_db.php');
    
    // Obtener los datos del formulario

    $query = "INSERT INTO turnos (idProfesional,idServicio,idPaciente,fechaHora,sobreturno) VALUES ($idProfesional,$idServicio,$idPaciente,STR_TO_DATE('CURDATE() $horario', '%Y-%m-%d %H:%i'),0);";
    $result = $conn->query($query);
    $query = "SELECT idTurno FROM turnos WHERE idPaciente=$idPaciente ORDER BY idTurno DESC LIMIT 1;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $idTurno = $row['idTurno'];
    // $conca=$idPaciente.$idTurno;
    // $idComprobante=(INT)$conca;
    // $query = "INSERT INTO turnos (idComprobante) VALUES ($idComprobante);";
    // $result = $conn->query($query);
    $conn->close();

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
                                <h1 class="h4 text-gray-900 mb-4">Número de orden</h1>
                            </div>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">

                                </h1>
                            </div>
                            <div class="text-center">

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"> <?php echo "$idTurno"; ?></h1>
                            </div>


                        </div><div class="p-5">

                            <!-- Columna simple centrada con Card Body -->
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Id de comprobante</h1>
                            </div>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">

                                </h1>
                            </div>
                            <div class="text-center">

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"> <?php echo "$idTurno"; ?></h1>
                            </div>

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
