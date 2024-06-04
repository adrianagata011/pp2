

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
        <h1>Reserva de turnos</h1>
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Selecciona un Servicio</h2>
                                <form method="post" action="">
                                <div class="form-group">
                                    <select class="form-control" name="servicio" id="servicio">
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

$query = "SELECT id_servicio, nombre FROM servicios";
$result = mysqli_query($conexion, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['id_servicio'] . "'>" . $row['nombre'] . "</option>";
}
mysqli_close($conexion);
?>

                                    </select>
                                </div>
                                <h2>Selecciona un Profesional</h2>
                                <div class="form-group">
                                    <select class="form-control" name="profesional" id="profesional">
                                        <!-- Los profesionales se cargarán dinámicamente mediante JavaScript -->
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Continuar</button>
                                </form>
                            </div>
                        <div class="col-md-6">
                            <h2>Selecciona un Día Disponible</h2>
                            <div id="calendar"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function(){
        // Cargar profesionales al seleccionar un servicio
        $('#servicio').change(function(){
            var servicioId = $(this).val();
            $.ajax({
                url: 'obtener_profesionales.php',
                type: 'post',
                data: {servicio_id: servicioId},
                success:function(response){
                $('#profesional').html(response);
                }
            });
        });

        // Inicializar el calendario
        $('#calendar').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            autoclose: true,
            todayHighlight: true,
            beforeShowDay: function(date){
                var availableDates = <?php include 'disponibilidad_profesional.php'; ?>;
                var formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
                if ($.inArray(formattedDate, availableDates) !== -1){
                    return {classes: 'available'};
                } else {
                    return {classes: 'unavailable', tooltip: 'No disponible'};
                }
            }
        });
    });
    </script>
</body>

</html>
<?php
// Iniciar sesión para mantener la variable $servicioSeleccionado
session_start();

// Verificar si se ha enviado un servicio seleccionado
if (isset($_POST['servicio'])) {
  // Guardar el servicio seleccionado en la variable de sesión
  $_SESSION['servicioSeleccionado'] = $_POST['servicio'];

  // Redireccionar a otra página o mostrar un mensaje de éxito
  //header("Location: otra_pagina.php"); // Cambia 'otra_pagina.php' por la página a la que deseas redireccionar
  exit();
} else {
  // Si no se selecciona ningún servicio, muestra un mensaje de error o redirige a otra página
  echo "Error: No se ha seleccionado ningún servicio.";
}
?>