<?php
session_start();
echo "Cerrando sesión.";
header("refresh:3; url=login.html");
unset($_SESSION['usuario'] );
exit();
?>