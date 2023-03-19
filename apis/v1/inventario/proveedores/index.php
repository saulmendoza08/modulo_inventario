
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getProveedores($conn);
    break;
  case 'POST':
    addProveedores($conn);
    break;
  case 'PUT':
    updateProveedores($conn);
    break;
  case 'DELETE':
    deleteProveedores($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getProveedores($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT id, nombre, cuit, domicilio, celular FROM proveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT id, nombre, cuit, domicilio, celular FROM proveedores";
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
        'cuit' => $row['cuit'],
        'domicilio' => $row['domicilio'],
        'celular' => $row['celular']
      ];
    }

    echo json_encode($usuarios);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addProveedores($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['nombre']) && !empty($data['cuit']) && !empty($data['domicilio']) && !empty($data['celular'])) {
    $nombre = $data['nombre'];
    $cuit = $data['cuit'];
    $domicilio = $data['domicilio'];
    $celular = $data['celular'];

    $sql = "INSERT INTO proveedores (nombre, cuit, domicilio, celular) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sisi", $nombre, $cuit, $domicilio, $celular);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Proveedor creado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al crear proveedor']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function deleteProveedores($conn) {
  $id = $_GET['id'];

  if (!empty($id)) {
    $sql = "DELETE FROM proveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Proveedor eliminado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al eliminar Proveedor']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'ID no especificado']);
  }

  $conn->close();
}


function updateProveedores($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['nombre']) && !empty($data['domicilio']) && !empty($data['cuit']) && !empty($data['celular'])) {
      $id = $data['id'];
      $nombre = $data['nombre'];
      $domicilio = $data['domicilio'];
      $cuit = $data['cuit'];
      $celular = $data['celular'];

      $sql = "UPDATE proveedores SET nombre = ?, cuit = ?, domicilio = ?, celular = ?  WHERE id = ?";
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("sisii", $nombre, $cuit, $domicilio, $celular, $id);

      if ($stmt->execute()) {
      echo json_encode(['success' => 'Proveedor actualizado correctamente']);
      } else {
      echo json_encode(['error' => 'Error al actualizar Proveedor']);
      }

      $stmt->close();
  } else {
      echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}
  
?>