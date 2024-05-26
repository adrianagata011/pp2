<?php
$conn = new mysqli('sql10.freemysqlhosting.net', 'sql10707793', 'Rre1s76tSV', 'sql10707793');
// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");
?>