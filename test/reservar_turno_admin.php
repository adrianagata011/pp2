
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Selección de Servicios y Profesionales</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body class="bg-gradient-primary">
            <!-- Outer Row -->
            <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">

                            <!-- Columna simple centrada con Card Body -->
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Reserva de turnos</h1>
                            </div>
                            <hr>      
                            <div class="text-center">
                                <hr>
                                <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                    Salir
                                </a>
                            </div>
                        </div>

                        <!-- Dos columnas con Card Body -->
                        <!-- //primera columna -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-4">Seleccione un Servicio</h2>
                                        <form action="consulta.php" method="POST">
                                            <div class="form-group">
                                                <label for="servicio">Servicio:</label>
                                                <select class="form-control" id="servicio" name="servicio">
                                                <!-- Las opciones se cargan con PHP -->
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
//$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}


// ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

$query = "SELECT idServicio, nombre FROM servicios";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    // Output de cada fila
    while($row = $result->fetch_assoc()) {
        $idServicio = $row['idServicio'];
        $servicio = $row['nombre'];
        echo "<option value='" . $idServicio . "'>" . $servicio . "</option>";
    }
} else {
    echo "<tr><td>No se encontraron resultados</td><td></td><td></td></tr>";
}

$mysqli->close();
?>
                                                </select>
                                            </div>
                                    <hr>      
                                    <!--<div class="text-center">
                                        <hr>
                                        <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                            Salir
                                        </a>
                                    </div>-->
                                    </div>
                                </div>
                            </div>

                            <!-- //segunda columna -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-4">Selecciona un Profesional</h2>
                                        <div class="form-group">
                                            <label for="profesional">Profesional:</label>
                                            <select class="form-control" id="profesional" name="profesional">
                                            <!-- Options will be filled by JavaScript -->
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
//$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}


// ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

// Consulta para obtener los profesionales según el servicio seleccionado
$idServicio = $_POST['servicio'];
$sql = "SELECT nombre, apellido FROM profesionales WHERE idServicio = $idServicio";
$result = $mysqli->query($sql);

$profesionales = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profesionales[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido']
        );
    }
}

echo json_encode($profesionales);
//mysqli_close($conexion);
$mysqli->close();
?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Consultar</button>
                                    </form>
    </div>
                                    </div>
                                    <hr>      
                                    <div class="text-center">
                                        <hr>
                                        <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                            Salir
                                        </a>
                                    </div>
                                </div>
                            </div>

    <div class="container mt-5">
    <h1>Selecciona un Servicio y un Profesional</h1>
    <form action="consulta.php" method="POST">
        <div class="form-group">
        <label for="servicio">Servicio:</label>
        <select class="form-control" id="servicio" name="servicio">
        <!-- Options will be filled by PHP -->
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
//$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}


// ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

$query = "SELECT idServicio, nombre FROM servicios";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    // Output de cada fila
    while($row = $result->fetch_assoc()) {
        $idServicio = $row['idServicio'];
        $servicio = $row['nombre'];
        echo "<option value='" . $idServicio . "'>" . $servicio . "</option>";
    }
} else {
    echo "<tr><td>No se encontraron resultados</td><td></td><td></td></tr>";
}

/*$query = "SELECT idServicio, nombre FROM servicios";
$result = mysqli_query($conexion, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['idServicio'] . "'>" . $row['nombre'] . "</option>";
}*/
$mysqli->close();
?>
        </select>
        </div>
        <div class="form-group">
        <label for="profesional">Profesional:</label>
        <select class="form-control" id="profesional" name="profesional">
            <!-- Options will be filled by JavaScript -->
<?php
            // Consulta para obtener los profesionales según el servicio seleccionado
$idServicio = $_POST['idServicio'];
$sql = "SELECT nombre, apellido FROM profesionales WHERE idServicio = $idServicio";
$result = $conn->query($sql);

$profesionales = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profesionales[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido']
        );
    }
}

echo json_encode($profesionales);
//mysqli_close($conexion);
$mysqli->close();
?>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Consultar</button>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    $('#servicio').change(function(){
        var servicio = $(this).val();
        $.ajax({
            url: 'profesionales.php',
            method: 'POST',
            data: {servicio: servicio},
            dataType: 'json',
            success: function(data){
                $('#profesional').empty();
                $.each(data, function(key, value){
                    $('#profesional').append('<option value="' + value.id + '">' + value.nombre + ' ' + value.apellido + '</option>');
                });
            }
        });
    });
});
</script>
<?php
$usuario = $_SESSION['usuario'];
// Conectar a la base de datos
//$mysqli = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($mysqli->connect_error) {
  die("Error en la conexión: " . $mysqli->connect_error);
}


// ATENCION: Se agrega la siguiente linea para Definir el charset de los datos recolectados
$mysqli->set_charset("utf8");

// Consulta para obtener los profesionales según el servicio seleccionado
$idServicio = $_POST['idServicio'];
$sql = "SELECT nombre, apellido FROM profesionales WHERE idServicio = $idServicio";
$result = $conn->query($sql);

$profesionales = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profesionales[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido']
        );
    }
}

echo json_encode($profesionales);
$conn->close();
?>