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

    <title>Sistema Clínica - Home del Administrativo</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        function handleSubmit(button) {
            // Crear un campo de entrada oculto para almacenar el ID del botón
            var hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = "action";
            hiddenField.value = button.id;

            // Agregar el campo oculto al formulario
            var form = document.getElementById("userForm");
            form.appendChild(hiddenField);

            // Enviar el formulario
            form.submit();
        }
    </script>

    <script>
        function handleSubmitProf(button) {
            // Crear un campo de entrada oculto para almacenar el ID del botón
            var hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = "action";
            hiddenField.value = button.id;

            // Agregar el campo oculto al formulario
            var form = document.getElementById("profForm");
            form.appendChild(hiddenField);

            // Enviar el formulario
            form.submit();
        }
    </script>

    <script>
        function handleSubmitInsumo(button) {
            // Crear un campo de entrada oculto para almacenar el ID del botón
            var hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = "action";
            hiddenField.value = button.id;

            // Agregar el campo oculto al formulario
            var form = document.getElementById("insumoForm");
            form.appendChild(hiddenField);

            // Enviar el formulario
            form.submit();
        }
    </script>


</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Profesionales</h1>
                                    </div>
                                    <hr>
                                    <form id="profForm" class="prof" method="post" action="prof_id.php">
                                        <div class="form-group">
<?php
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
$query = "SELECT idProfesional,nombre,apellido FROM profesionales WHERE finActividad IS NULL ORDER BY apellido ASC;";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    echo "<select name='idProfesional' id='idProfesional'>";
    echo "<option value=''>Seleccione Profesional</option>";
    while($row = $result->fetch_assoc()) {
      $idProfesional = $row['idProfesional'];
      $nombre = $row['nombre'];
      $apellido = $row['apellido'];
      echo "<option value='$idProfesional'>$apellido, $nombre</option>";
    }
    echo "</select>";
} else {
    echo "No se encontraron profesionales";
}
$mysqli->close();
?>
                                        </div>
                                            <button type="button" id="admin_control_horario" class="btn btn-danger btn-user btn-block" onclick="handleSubmitProf(this)">Control horario</button>                                                                                    
                                            <button type="button" id="admin_liquidar_honorarios" class="btn btn-danger btn-user btn-block" onclick="handleSubmitProf(this)">Liquidar honorarios</button>
                                            <button type="button" id="admin_gestionar_agenda" class="btn btn-danger btn-user btn-block" onclick="handleSubmitProf(this)">Gestionar agenda</button>
                                            <button type="button" id="admin_modificar_profesional" class="btn btn-primary btn-user btn-block" onclick="handleSubmitProf(this)">Modificar profesional</button>
                                            <button type="button" id="admin_nuevo_profesional" class="btn btn-primary btn-user btn-block" onclick="handleSubmitProf(this)">Nuevo profesional</button>
                                        </form>
                                    <hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Insumos</h1>
                                    </div>
                                    <hr>
                                    <form id="insumoForm" class="insumos" method="post" action="insumos_id.php">
                                        <div class="form-group">
<?php
$mysqli = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
$query = "SELECT idInsumo,nombre FROM insumos WHERE baja = 0 ORDER BY nombre ASC;";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    echo "<select name='idInsumo' id='idInsumo'>";
    echo "<option value=''>Seleccione un Insumo</option>";
    while($row = $result->fetch_assoc()) {
      $idInsumo = $row['idInsumo'];
      $nombre = $row['nombre'];
      echo "<option value='$idInsumo'>$nombre</option>";
    }
    echo "</select>";
} else {
    echo "No se encontraron insumos";
}
$mysqli->close();
?>
                                        </div>
                                            <button type="button" id="admin_ingresar_insumo" class="btn btn-primary btn-user btn-block" onclick="handleSubmitInsumo(this)">Ingresar cantidad de insumo</button>                                                                                    
                                            <button type="button" id="admin_egresar_insumo" class="btn btn-primary btn-user btn-block" onclick="handleSubmitInsumo(this)">Egresar cantidad de insumo</button>
                                            <button type="button" id="admin_listar_faltantes_insumo" class="btn btn-primary btn-user btn-block" onclick="handleSubmitInsumo(this)">Listado de Faltantes</button>
                                            <button type="button" id="admin_modificar_insumo" class="btn btn-primary btn-user btn-block" onclick="handleSubmitInsumo(this)">Modificar insumo</button>                                            
                                            <button type="button" id="admin_nuevo_insumo" class="btn btn-primary btn-user btn-block" onclick="handleSubmitInsumo(this)">Nuevo insumo</button>
                                        </form>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pacientes</h1>
                                    </div>
                                    <hr>
                                    <form id="userForm" class="user" method="post" action="userdni.php">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="dni" name="dni" aria-describedby="dni" placeholder="Ingrese el dni" required>
                                            </div>
                                            <button type="button" id="admin_cancelar_turno" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Cancelar turno</button>                                                                                    
                                            <button type="button" id="admin_acreditar_turno" class="btn btn-danger btn-user btn-block" onclick="handleSubmit(this)">Acreditar turno</button>
                                            <button type="button" id="admin_reservar_turno" class="btn btn-danger btn-user btn-block" onclick="handleSubmit(this)">Reservar turno</button>
                                            <button type="button" id="admin_registrar_atencion" class="btn btn-danger btn-user btn-block" onclick="handleSubmit(this)">Registrar atención</button>
                                            <button type="button" id="admin_modificar_paciente" class="btn btn-danger btn-user btn-block" onclick="handleSubmit(this)">Modificar paciente</button>
                                            <button type="button" id="admin_nuevo_paciente" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Nuevo paciente</button>
                                        </form>
                                    <hr>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                            Salir
                                        </a>
                                </div>
                            </div>
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