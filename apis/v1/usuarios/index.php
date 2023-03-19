
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getUsers($conn);
    break;
  case 'POST':
    addUser($conn);
    break;
  case 'PUT':
    updateUser($conn);
    break;
  case 'DELETE':
    deleteUser($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getUsers($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, nombre, apellido, correo, celular, estado FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, nombre, apellido, correo, celular, estado FROM usuarios";
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
        'apellido' => $row['apellido'],
        'correo' => $row['correo'],
        'celular' => $row['celular'],
        'estado' => $row['estado']
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addUser($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['nombre']) && !empty($data['apellido']) && !empty($data['correo']) && !empty($data['celular'])) {
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $correo = $data['correo'];
    $celular = $data['celular'];
    $estado = "activo";

    $sql = "INSERT INTO usuarios (nombre, apellido, correo, celular, estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssis", $nombre, $apellido, $correo, $celular, $estado);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Usuario creado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al crear usuario']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function deleteUser($conn) {
  $id = $_GET['id'];

  if (!empty($id)) {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Usuario eliminado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al eliminar usuario']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'ID no especificado']);
  }

  $conn->close();
}


function updateUser($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['nombre']) && !empty($data['apellido']) && !empty($data['correo']) && !empty($data['celular']) && !empty($data['estado'])) {
      $id = $data['id'];
      $nombre = $data['nombre'];
      $apellido = $data['apellido'];
      $correo = $data['correo'];
      $celular = $data['celular'];
      $estado = $data['estado'];

      $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, celular = ?, estado = ? WHERE id = ?";
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("sssisi", $nombre, $apellido, $correo, $celular, $estado, $id);

      if ($stmt->execute()) {
      echo json_encode(['success' => 'Usuario actualizado correctamente']);
      } else {
      echo json_encode(['error' => 'Error al actualizar usuario']);
      }

      $stmt->close();
  } else {
      echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}
  
?>