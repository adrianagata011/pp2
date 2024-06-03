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

    <title>Sistema Clínica - Nuevo Paciente</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Nuevo Paciente</h1>
                            </div>
                            <hr>

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">DNI <?php echo $_GET['dni']; ?></h1>
                            </div>
                            <form class="user" method="post" action="admin_nuevo_paciente_insert.php">
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
                                    <input type="telefono" class="form-control form-control-user"
                                        id="telefono" name="telefono" aria-describedby="emailHelp"
                                        placeholder="Ingrese el teléfono">
                                </div>
                                <div class="form-group">
                                    <input type="domicilio" class="form-control form-control-user"
                                        id="domicilio" name="domicilio" aria-describedby="emailHelp"
                                        placeholder="Ingrese el domicilio">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="email" name="email" aria-describedby="emailHelp"
                                        placeholder="Ingrese e-mail">
                                </div>
                                <div class="form-group">
                                    <input type="obraSocial" class="form-control form-control-user"
                                        id="obraSocial" name="obraSocial" aria-describedby="emailHelp"
                                        placeholder="Ingrese la Obra Social">
                                </div>
                                <div class="form-group">
                                    <label for="grupoSanguineo"> Seleccione el Grupo Sanguineo: </label>
                                    <select name="grupoSanguineo" id="grupoSanguineo">
                                        <option value="A+" selected>A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="observaciones" class="form-control form-control-user"
                                        id="observaciones" name="observaciones" aria-describedby="emailHelp"
                                        placeholder="Observaciones">
                                </div>
                                <input type="hidden" id="dni" name="dni" value="<?php echo $_GET['dni']; ?>">
                                <button type="submit" value="Iniciar Sesion" class="btn btn-primary btn-user btn-block"> Ingresar nuevo paciente </button>
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