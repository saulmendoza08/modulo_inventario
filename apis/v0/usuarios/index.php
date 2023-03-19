
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
  $sql = "SELECT id, nombre, correo FROM usuarios";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = [
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'correo' => $row['correo']
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $conn->close();
}

function addUser($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['nombre']) && !empty($data['correo'])) {
    $nombre = $data['nombre'];
    $correo = $data['correo'];

    $sql = "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $nombre, $correo);

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

    if (!empty($data['id']) && !empty($data['nombre']) && !empty($data['correo'])) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $correo = $data['correo'];

        $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssi", $nombre, $correo, $id);

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