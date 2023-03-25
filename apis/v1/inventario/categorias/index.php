
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getCategories($conn);
    break;
  case 'POST':
    addCategories($conn);
    break;
  case 'PUT':
    updateCategories($conn);
    break;
  case 'DELETE':
    deleteCategories($conn);
    break;
  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    break;
}
  

function getCategories($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, nombre FROM categorias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, nombre FROM categorias";
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = [
        'id' => $row['id'],
        'nombre' => $row['nombre']
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addCategories($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['nombre'])) {
    $nombre = $data['nombre'];

    $sql = "INSERT INTO categorias (nombre) VALUES (?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
      http_response_code(201);
      echo json_encode(['success' => 'Categoría creada correctamente']);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Error al crear categoría']);
    }

    $stmt->close();
  } else {
    http_response_code(400);
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function deleteCategories($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID no especificado']);
    return;
  }

  $sql = "DELETE FROM categorias WHERE id = ?";
  $stmt = $conn->prepare($sql);

  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    if ($stmt->affected_rows === 0) {
      http_response_code(404);
      echo json_encode(['error' => 'No se encontró la categoría especificada']);
    } else {
      echo json_encode(['success' => 'Categoría eliminada correctamente']);
    }
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al eliminar categoría']);
  }

  $stmt->close();
  $conn->close();
}



function updateCategories($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['nombre'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];

    $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Categoria actualizada correctamente']);
    } else {
      http_response_code(500); // error interno del servidor
      echo json_encode(['error' => 'Error al actualizar la categoria. Por favor, intenta de nuevo más tarde.']);
    }

    $stmt->close();
  } else {
    http_response_code(400); // solicitud incorrecta
    echo json_encode(['error' => 'Datos incompletos. Por favor, proporciona un ID de categoría y un nombre de categoría válido.']);
  }

  $conn->close();
}
  
?>