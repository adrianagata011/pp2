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

    <title>Sistema Clínica - Ingresar Insumo</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Ingresar Insumo</h1>
                            </div>
                            <hr>
<?php
if (isset($_GET['idInsumo'])) {
    $idInsumo = $_GET['idInsumo'];
    // Me conecto a la base
    require_once('conexion_db.php');
    $query = "SELECT idInsumo,nombre,cantidadMinima,cantidadExistente,descripcion,observaciones from insumos where idInsumo = '$idInsumo';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $cantidadMinima = $row['cantidadMinima'];
        $cantidadExistente = $row['cantidadExistente'];
        $descripcion = $row['descripcion'];
        $observaciones = $row['observaciones'];
    }
    else 
    {
        echo "No se seleccionó el insumo<br>";
    }
    $conn->close();
}
?>

                            <form id="profForm" class="user" method="post" action="admin_ingresar_insumo_update.php">
                                <div class="form-group">                                
                                    <table>
                                        <tr>
                                            <td>Insumo</td><td><?php echo $nombre; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad Mínima</td><td><?php echo $cantidadMinima; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad Existente</td><td><?php echo $cantidadExistente; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Descripción</td><td><?php echo $descripcion; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Observaciones</td><td><?php echo $observaciones; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                        id="cantidad" name="cantidad" aria-describedby="emailHelp"
                                        placeholder="Ingrese la cantidad" min="0" max="1000000" step="1">
                                </div>
                                <input type="hidden" id="idInsumo" name="idInsumo" value="<?php echo $idInsumo; ?>">
                                <input type="hidden" id="cantidadExistente" name="cantidadExistente" value="<?php echo $cantidadExistente; ?>">
                                <button type="submit" value="GrabarModificaciones" class="btn btn-primary btn-user btn-block"> Ingresar Cantidad </button>
                            </form>
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

</body>

</html>