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

    <title>Sistema Clínica - Nuevo Insumo</title>
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
                                <h1 class="h4 text-gray-900 mb-4">Nuevo Insumo</h1>
                            </div>
                            <hr>

                            <form id="numForm" class="user" method="post" action="admin_nuevo_insumo_insert.php">
                                <div class="form-group">
                                    <input type="nombre" class="form-control form-control-user"
                                        id="nombre" name="nombre" aria-describedby="emailHelp"
                                        placeholder="Ingrese el nombre del insumo">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                        id="cantidadMinima" name="cantidadMinima" aria-describedby="emailHelp"
                                        placeholder="Ingrese la cantidad mínima" min="0" max="1000000" step="1">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                        id="cantidadExistente" name="cantidadExistente" aria-describedby="emailHelp"
                                        placeholder="Ingrese la cantidad existente" min="0" max="1000000" step="1">
                                </div>
                                <div class="form-group">
                                    <input type="descripcion" class="form-control form-control-user"
                                        id="descripcion" name="descripcion" aria-describedby="emailHelp"
                                        placeholder="Ingrese la descripción del insumo">
                                </div>
                                <div class="form-group">
                                    <input type="observacion" class="form-control form-control-user"
                                        id="observacion" name="observacion" aria-describedby="emailHelp"
                                        placeholder="Ingrese una observación del insumo">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block"> Ingresar nuevo insumo </button>
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

    <script>
        document.getElementById('numForm').addEventListener('submit', function(event) {
            var numInput = document.getElementById('cantidadMinima').value;
            if (isNaN(numInput) || numInput < 0 || numInput > 1000000) {
                alert('Por favor, ingrese un número válido entre 0 y 1000000.');
                event.preventDefault();
            }
        });
    </script>

<script>
        document.getElementById('numForm').addEventListener('submit', function(event) {
            var cantidadExistente = document.getElementById('cantidadExistente').value;
            if (isNaN(cantidadExistente) || cantidadExistente < 0 || cantidadExistente > 1000000) {
                alert('Por favor, ingrese un número válido entre 0 y 1000000.');
                event.preventDefault();
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>