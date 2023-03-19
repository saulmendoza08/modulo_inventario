
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getUsers($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getUsers($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, servicio, interno FROM servicios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, servicio, interno FROM servicios";
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = [
        'id' => $row['id'],
        'servicio' => $row['servicio'],
        'interno' => $row['interno']
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


  
?>