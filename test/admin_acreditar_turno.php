<?php
require_once('verificar_sesion_admin.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Acreditar turno</title>
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
                        <!-- Nested Row within Card Body -->
                        <!-- //<div class="row">
                            //<div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Acreditar turnos</h1>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
                                    <form action="admin_acreditar_turno_t.php" method="GET">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Seleccionar</th>
                                                    <th>Fecha</th>
                                                    <th>Servicio</th>
                                                    <th>Profesional</th>
                                                    <th>Precio</th>
                                                    <th>Sobreturno</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];

    require_once('conexion_db.php');
    $conn->set_charset("utf8");
    
    $query = "SELECT s.precio_publico as precioPublico, pa.obraSocial as obraSocial,t.fechaHora as fecha, s.nombre as servicio, p.nombre as nombre, p.apellido as apellido, t.sobreTurno as sobreTurno
        FROM turnos t 
        INNER JOIN profesionales p ON t.idProfesional = p.idProfesional 
        INNER JOIN servicios s ON t.idServicio = s.idServicio 
        INNER JOIN pacientes pa ON t.idPaciente = pa.idPaciente 
        INNER JOIN usuarios u ON pa.idUsuario = u.idUsuario 
        WHERE pa.dni = $dni and DATE(t.fechaHora) = CURDATE() AND t.acreditado IS FALSE
        ORDER BY t.fechaHora ASC;";
        $obraSocial="";
        $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $obraSocial = $row['obraSocial'];
                    $fecha = $row['fecha'];
                    $servicio = $row['servicio'];
                    $precioPublico= $row['precioPublico'];
                    $profesional = $row['nombre'] . " " . $row['apellido'];
                    $sobreTurno =  $row['sobreTurno'];
                    echo "<tr><td><input type='radio' name='turno' value= '" . $fecha . "'></td><td>" . $fecha . "</td><td>" . $servicio . "</td><td>" . $profesional . "</td><td>". $precioPublico ."</td><td>" . $sobreTurno . "</td></tr>";
                }           
            } 
            else {
                echo "<tr><td>No se encontraron resultados</td><td></td><td></td><td></td></tr>";
            }
        }
        else {
            echo "<tr><td>No se pudo identificar el ID de Usuario del paciente</td><td></td><td></td><td></td></tr>";
        }
?>

                                            </tbody>
                                        </table>
                                        <hr>
                                        <?php 
                                        if ($obraSocial != ""){
                                            echo "Cobertura del Paciente: $obraSocial<br>";
                                        }
                                        ?>
                                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                                        <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#ConfirmModal">
                                            Acreditar turno
                                        </a>
                                    <hr>
                                    </div>
                                    <div>
                                        <a href="index_administrativo.php" class="btn btn-primary btn-user btn-block">
                                            Volver
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

    <!-- Modal de confirmación-->
    <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ATENCIÓN !!!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta acción es irreversible<br>Estas seguro de querer acreaditar este turno? </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Si</button>
                    </form>
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


