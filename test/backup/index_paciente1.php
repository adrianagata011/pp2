<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está establecida y el usuario está logueado
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] != 1 ) {
    // Si no está logueado, redirigir al usuario a la página de login
    header("Location: login.html");
    exit;
}
?>

<?php

// Conexión a la base de datos
$db = new mysqli('localhost', 'pp2', 'Testing_2024', 'pp2');

// Obtener el ID del paciente logueado
$idPaciente = $_SESSION['id_paciente'];

// Consultar los turnos reservados por el paciente
$sql = "SELECT * FROM usuarios";
$result = $db->query($sql);

// Procesar los resultados de la consulta
$turnos = [];
while ($row = $result->fetch_assoc()) {
    $turno = [
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'contrasena' => $row['contrasena'],
        'nrol' => $row['rol'],
    ];
    $turnos[] = $turno;
}

// Cerrar la conexión a la base de datos
$db->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis turnos reservados</title>
    <script src="script.js"></script>
</head>
<body>
    <h1>Mis turnos reservados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Médico</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turnos as $turno): ?>
                <tr>
                    <td><?php echo $turno['id']; ?></td>
                    <td><?php echo $turno['nombre']; ?></td>
                    <td><?php echo $turno['contrasena']; ?></td>
                    <td><?php echo $turno['rol']; ?></td>
                    <td><input type="checkbox" name="turnos[]" value="<?php echo $turno['id']; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button id="btnCancelar">Cancelar turnos seleccionados</button>
</body>
</html>