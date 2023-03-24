<!DOCTYPE html>
<html>
<head>
  <title>Instalador de mi aplicación</title>
</head>
<body>
  <h1>Instalador de mi aplicación</h1>
  <form action="install.php" method="post">
    <label for="db_host">Host de la base de datos:</label>
    <input type="text" id="db_host" name="db_host" value="localhost"><br>
    <label for="db_name">Nombre de la base de datos:</label>
    <input type="text" id="db_name" name="db_name" value="myapp"><br>
    <label for="db_user">Usuario de la base de datos:</label>
    <input type="text" id="db_user" name="db_user" value="myuser"><br>
    <label for="db_password">Contraseña de la base de datos:</label>
    <input type="password" id="db_password" name="db_password" value="mypassword"><br>
    <label for="admin_username">Nombre de usuario admin:</label>
    <input type="text" id="admin_username" name="admin_username" value="admin"><br>
    <label for="admin_password">Contraseña de usuario admin:</label>
    <input type="password" id="admin_password" name="admin_password" value="admin123"><br>
    <input type="submit" value="Instalar">
  </form>
</body>
</html>
