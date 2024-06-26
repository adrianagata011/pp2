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
                                       
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            control horario
                                        </a>
                                       
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        liquidar honorarios
                                        </a>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        gestionar agenda</a>

                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        prof abm</a>

                                    <hr>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Insumos</h1>
                                    </div>
                                     
                                    <hr>
                                       
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            insumos</a>
                 
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

                                            <button type="button" id="cancelar_turno_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Cancelar turno</button>                                                                                    
                                            
                                            <button type="button" id="acreditar_turno_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Acreditar turno</button>
                                            
                                            <button type="button" id="reservar_turno_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Reservar turno</button>
                                        
                                            <button type="button" id="registrar_atencion_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Registrar atencion</button>
                                            
                                            <button type="button" id="paciente_abm_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Paciente abm</button>
                                        
                                            <button type="button" id="nuevo_paciente_admin" class="btn btn-primary btn-user btn-block" onclick="handleSubmit(this)">Nuevo paciente</button>
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