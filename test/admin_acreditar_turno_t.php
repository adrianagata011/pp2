<?php
require_once('verificar_sesion_admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Acreaditación de Turnos</title>

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
                                        <h1 class="h4 text-gray-900 mb-4">Acreaditación de Turnos</h1>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
<?php
    if (isset($_GET['dni'])&&(isset($_GET['turno']))) {
        $dni = $_GET['dni'];  
        $turnoSeleccionado = $_GET['turno'];
        // Me conecto a la base
        require_once('conexion_db.php');
            
        $query = "SELECT t.idTurno as idTurno,t.idProfesional as idProfesional
                FROM turnos t
                INNER JOIN profesionales p ON t.idProfesional = p.idProfesional
                INNER JOIN servicios s ON t.idServicio = s.idServicio
                INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente
                INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario
                WHERE pa.dni = '$dni' AND t.fechahora = '$turnoSeleccionado';";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                // Output de cada fila
                $row = $result->fetch_assoc();
                $idTurno = $row['idTurno'];
                $idProfesional = $row['idProfesional'];

                setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $fechaTurno = substr(ucfirst($turnoSeleccionado), 0, 10);
                $fechaActual = date('Y-m-d');
                if ($fechaTurno == $fechaActual){
                    $query= "SELECT idConsultorio from consultorios where idProfesional = $idProfesional;";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $idConsultorio = $row['idConsultorio'];
                        $query1 = "UPDATE turnos SET acreditado = TRUE WHERE idTurno = $idTurno;";
                        $result1 = $conn->query($query1);
                        echo "Se acreditó el turno <br>";
                        echo "Por favor concurrir al consultorio $idConsultorio";
                        header("refresh:5; url=index_administrativo.php");
                        exit();
                    } else {
                        echo "El Dr. aún no ha llegado para poder acreditar el turno y derivar a Consultorio";
                        header("refresh:3; url=admin_acreditar_turno.php?dni=$dni");
                    }
                } else {
                    echo "Solo se puede acreditar el turno el mismo día";
                    header("refresh:3; url=admin_acreditar_turno.php?dni=$dni");
                }
            } else {
                echo "No se seleccionó ningún turno<br>";
            }
            $conn->close();
        }
        else {
            $dni = $_GET['dni'];  
            echo "No ha seleccionado ningún turno. Vuelva a intentarlo<br>";
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){ window.location.href = "admin_acreditar_turno.php?dni='.$dni.'"; }, 3000);';
            echo '</script>'; 
            //header("refresh:3; url=admin_acreditar_turno.php?dni=$dni");
        }
?>
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