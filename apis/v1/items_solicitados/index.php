
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getItems($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getItems($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, id_productos, id_solicitudes, cantidad, id_proveedor FROM items_solicitados WHERE id_solicitudes= ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, id_productos, id_solicitudes, cantidad, id_proveedor FROM items_solicitados";
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = [
        'id_productos' => $row['id_productos'],
        'id_solicitudes' => $row['id_solicitudes'],
        'cantidad' => $row['cantidad'],
        'id_proveedor' => $row['id_proveedor']
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