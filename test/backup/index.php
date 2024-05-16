<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesion</title>
</head>
<body>

<h2>Iniciar Sesion</h2>

<form method="post" action="/backup/auth.php">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" value="" required><br><br>

    <label for="contrasena">Contrasena:</label>
    <input type="password" id="contrasena" name="contrasena" value="" required><br><br>

    <input type="submit" value="Iniciar Sesion">
</form>

</body>
</html>