<?php
// usar si es una pagina para el admin
require_once('verificar_sesion_admin.php');

// y usar este si es una pagina para el paciente
// require_once('verificar_sesion_paciente.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Clínica - Nuevo Profesional</title>

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
                                <h1 class="h4 text-gray-900 mb-4">Nuevo Profesional</h1>
                            </div>
                            <hr>

                            <form class="user" method="post" action="admin_nuevo_profesional_insert.php">
                                <div class="form-group">
                                    <input type="nombre" class="form-control form-control-user"
                                        id="nombre" name="nombre" aria-describedby="emailHelp"
                                        placeholder="Ingrese el nombre">
                                </div>
                                <div class="form-group">
                                    <input type="apellido" class="form-control form-control-user"
                                        id="apellido" name="apellido" aria-describedby="emailHelp"
                                        placeholder="Ingrese el apellido">
                                </div>
                                <div class="form-group">
                                    <input type="dni" class="form-control form-control-user"
                                        id="dni" name="dni" aria-describedby="emailHelp"
                                        placeholder="Ingrese el DNI">
                                </div>
                                <div class="form-group">
                                    <input type="telefono" class="form-control form-control-user"
                                        id="telefono" name="telefono" aria-describedby="emailHelp"
                                        placeholder="Ingrese el teléfono">
                                </div>
                                <div class="form-group">
                                    <input type="direccion" class="form-control form-control-user"
                                        id="direccion" name="direccion" aria-describedby="emailHelp"
                                        placeholder="Ingrese la dirección">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="email" name="email" aria-describedby="emailHelp"
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
    echo "<label for='idServicio'> Elija el Servicio: </label>";
    echo "<select name='idServicio' id='idServicio'>";
    while($row = $result->fetch_assoc()) {
      $idServicio = $row['idServicio'];
      $nombre = $row['nombre'];
      echo "<option value='$idServicio'>$nombre</option>";
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
                                        placeholder="Ingrese el número de matricula">
                                </div>
                                <div class="form-group">
                                    <label for="horarioIngreso"> Seleccione un Horario de Ingreso: </label>
                                    <select name="horarioIngreso" id="horarioIngreso">
                                        <option value=0 >00</option>
                                        <option value=1 >01</option>
                                        <option value=2 >02</option>
                                        <option value=3 >03</option>
                                        <option value=4 >04</option>
                                        <option value=5 >05</option>
                                        <option value=6 >06</option>
                                        <option value=7 >07</option>
                                        <option value=8 >08</option>
                                        <option value=9 >09</option>
                                        <option value=10 >10</option>
                                        <option value=11 >11</option>
                                        <option value=12 >12</option>
                                        <option value=13 >13</option>
                                        <option value=14 >14</option>
                                        <option value=15 >15</option>
                                        <option value=16 >16</option>
                                        <option value=17 >17</option>
                                        <option value=18 >18</option>
                                        <option value=19 >19</option>
                                        <option value=20 >20</option>
                                        <option value=21 >21</option>
                                        <option value=22 >22</option>
                                        <option value=23 >23</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="horarioEgreso"> Seleccione un Horario de Engreso: </label>
                                    <select name="horarioEgreso" id="horarioEgreso">
                                        <option value=0 >00</option>
                                        <option value=1 >01</option>
                                        <option value=2 >02</option>
                                        <option value=3 >03</option>
                                        <option value=4 >04</option>
                                        <option value=5 >05</option>
                                        <option value=6 >06</option>
                                        <option value=7 >07</option>
                                        <option value=8 >08</option>
                                        <option value=9 >09</option>
                                        <option value=10 >10</option>
                                        <option value=11 >11</option>
                                        <option value=12 >12</option>
                                        <option value=13 >13</option>
                                        <option value=14 >14</option>
                                        <option value=15 >15</option>
                                        <option value=16 >16</option>
                                        <option value=17 >17</option>
                                        <option value=18 >18</option>
                                        <option value=19 >19</option>
                                        <option value=20 >20</option>
                                        <option value=21 >21</option>
                                        <option value=22 >22</option>
                                        <option value=23 >23</option>
                                    </select>
                                </div>
                                </div>
                                <button type="submit" value="Iniciar Sesion" class="btn btn-primary btn-user btn-block"> Entrar </button>
                            </form>
                            <hr>
                            <div>                            
                                <a href="index_administrativo.php" class="btn btn-primary btn-user btn-block">
                                    Home
                                </a>
                                <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                    Salir
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
s