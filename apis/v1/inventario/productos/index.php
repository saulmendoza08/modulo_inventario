
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getproductos($conn);
    break;
  case 'POST':
    addproducto($conn);
    break;
  case 'PUT':
    updateproducto($conn);
    break;
  case 'DELETE':
    deleteproducto($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getproductos($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT productos.id, categorias.nombre AS categoria_nomb, productos.id_categorias, marcas.nombre AS marcas_nomb, productos.id_marcas, descripcion FROM productos INNER JOIN categorias ON categorias.id = productos.id_categorias INNER JOIN marcas ON marcas.id = productos.id_marcas WHERE productos.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT productos.id, categorias.nombre AS categoria_nomb, productos.id_categorias, marcas.nombre AS marcas_nomb, productos.id_marcas, descripcion FROM productos INNER JOIN categorias ON categorias.id = productos.id_categorias INNER JOIN marcas ON marcas.id = productos.id_marcas";
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $productos = [];

    while ($row = $result->fetch_assoc()) {
      $productos[] = [
        'id' => $row['id'],
        'categoria_nomb' => $row['categoria_nomb'],
        'id_categorias' => $row['id_categorias'],
        'marcas_nomb' => $row['marcas_nomb'],
        'id_marcas' => $row['id_marcas'],
        'descripcion' => $row['descripcion']

      ];
    }

    echo json_encode($productos);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addproducto($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['id_categorias']) && !empty($data['id_marcas']) && !empty($data['descripcion']) ) {
    $id = $data['id'];
    $id_categorias = $data['id_categorias'];
    $id_marcas = $data['id_marcas'];
    $descripcion = $data['descripcion'];

    $sql = "INSERT INTO productos (id, id_categorias, id_marcas, descripcion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("iiis", $id, $id_categorias, $id_marcas, $descripcion);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'producto creado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al crear producto']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function deleteproducto($conn) {
  $id = $_GET['id'];

  if (!empty($id)) {
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Productos eliminado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al eliminar Productos']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'ID no especificado']);
  }

  $conn->close();
}


function updateproducto($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['id_categorias']) && !empty($data['id_marcas']) && !empty($data['descripcion'])) {
      $id = $data['id'];
      $id_categorias = $data['id_categorias'];
      $id_marcas = $data['id_marcas'];
      $descripcion = $data['descripcion'];

      $sql = "UPDATE productos SET id_categorias = ?, id_marcas = ?, descripcion = ?  WHERE id = ?";
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("iisi", $id_categorias, $id_marcas, $descripcion, $id);

      if ($stmt->execute()) {
      echo json_encode(['success' => 'Producto actualizado correctamente']);
      } else {
      echo json_encode(['error' => 'Error al actualizar Producto']);
      }

      $stmt->close();
  } else {
      echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}
  
?>