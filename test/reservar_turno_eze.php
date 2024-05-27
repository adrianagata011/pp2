<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario y Selección de Horario</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2>Calendario y Selección de Horario</h2>
    <div class="row">
      <div class="col-md-6">
        <h3>Calendario</h3>
        <div id="calendar">
          <!-- Aquí se generaría dinámicamente el calendario -->
        </div>
      </div>
      <div class="col-md-6">
        <h3>Seleccionar Horario</h3>
        <form action="reservar.php" method="post">
          <div class="form-group">
            <label for="date">Fecha:</label>
            <input type="date" class="form-control" id="date" name="date">
          </div>
          <div class="form-group">
            <label for="time">Hora:</label>
            <input type="time" class="form-control" id="time" name="time">
          </div>
          <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la solicitud de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Validar y procesar la reserva
    // Aquí puedes insertar la reserva en tu base de datos, por ejemplo:
    $sql = "INSERT INTO reservas (fecha, hora) VALUES ('$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva realizada correctamente.";
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }
}

$conn->close();
?>
<?php
// Función para obtener el número de días en un mes
function getDaysInMonth($month, $year) {
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

// Función para obtener el día de la semana de una fecha específica
function getDayOfWeek($day, $month, $year) {
    return date('N', strtotime("$year-$month-$day"));
}

// Obtener el mes y año actuales
$month = date('n');
$year = date('Y');

// Obtener el número de días en el mes actual
$daysInMonth = getDaysInMonth($month, $year);

// Generar el HTML del calendario
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th>Lun</th>';
echo '<th>Mar</th>';
echo '<th>Mié</th>';
echo '<th>Jue</th>';
echo '<th>Vie</th>';
echo '<th>Sáb</th>';
echo '<th>Dom</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Variable para rastrear el día actual
$currentDay = 1;

// Bucle para generar las filas del calendario
while ($currentDay <= $daysInMonth) {
    echo '<tr>';

    // Bucle para generar las celdas de la fila
    for ($i = 1; $i <= 7; $i++) {
        echo '<td>';
        
        // Verificar si el día actual está dentro del rango del mes
        if ($currentDay <= $daysInMonth) {
            // Calcular el día de la semana del día actual
            $dayOfWeek = getDayOfWeek($currentDay, $month, $year);
            
            // Si el día es sábado o domingo, aplicar un estilo diferente
            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                echo '<b>'; // Aplicar estilo para fin de semana
            }

            // Imprimir el número del día actual
            echo $currentDay;

            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                echo '</b>'; // Cerrar el estilo para fin de semana
            }
        }

        echo '</td>';
        
        // Incrementar el día actual
        $currentDay++;
    }

    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>