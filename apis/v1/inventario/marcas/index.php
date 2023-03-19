
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getMarcas($conn);
    break;
  case 'POST':
    addMarcas($conn);
    break;
  case 'PUT':
    updateMarcas($conn);
    break;
  case 'DELETE':
    deleteMarcas($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getMarcas($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, nombre, id_categoria FROM marcas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, nombre, id_categoria FROM marcas";
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = [
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'id_categoria' => $row['id_categoria'],
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addMarcas($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['nombre']) && !empty($data['id_categoria'])) {
    $nombre = $data['nombre'];
    $id_categoria = $data['id_categoria'];

    $sql = "INSERT INTO marcas (nombre, id_categoria) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $nombre, $id_categoria);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Marca creada correctamente']);
    } else {
      echo json_encode(['error' => 'Error al crear Marca']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function deleteMarcas($conn) {
  $id = $_GET['id'];

  if (!empty($id)) {
    $sql = "DELETE FROM marcas WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Marca eliminada correctamente']);
    } else {
      echo json_encode(['error' => 'Error al eliminar Marca']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'ID no especificado']);
  }

  $conn->close();
}


function updateMarcas($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['nombre']) && !empty($data['id_categoria'])) {
      $id = $data['id'];
      $nombre = $data['nombre'];
      $id_categoria = $data['id_categoria'];

      $sql = "UPDATE marcas SET nombre = ?, id_categoria = ? WHERE id = ?";
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("sii", $nombre, $id_categoria, $id);

      if ($stmt->execute()) {
      echo json_encode(['success' => 'Marca actualizada correctamente']);
      } else {
      echo json_encode(['error' => 'Error al actualizar Marca']);
      }

      $stmt->close();
  } else {
      echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}
  
?>