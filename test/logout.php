<?php
session_start();
exit();
echo "Cerrando sesión.";
header("refresh:3; url=login.html");
?>