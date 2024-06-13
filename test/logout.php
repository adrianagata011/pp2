<?php
session_start();
echo "Cerrando sesión.";
echo '<script type="text/javascript">';
echo 'setTimeout(function(){ window.location.href = "login.html"; }, 3000);';
echo '</script>'; 
//header("refresh:3; url=login.html");
unset($_SESSION['usuario'] );
exit();
?>