<?php
$servername = "localhost";
$username = "smendoza";
$password = "Teclado19";
$dbname = "modulo_inventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>