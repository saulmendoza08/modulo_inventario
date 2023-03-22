
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../../../model/connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    getSolicitudes($conn);
    break;
  case 'POST':
    addSolicitud($conn);
    break;
  case 'PUT':
    updateSolicitud($conn);
    break;
  case 'DELETE':
    deleteSolicitud($conn);
    break;
  default:
    echo json_encode(['error' => 'Método no soportado']);
    break;
}
  

function getSolicitudes($conn) {
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
    $sql = "SELECT 
      solicitudes.id as nro_sol, 
      items_solicitados.id_productos as cod_producto, 
      productos.descripcion as descripcion_prod,
      items_solicitados.cantidad_sol,
      items_solicitados.cantidad_recibida,
      solicitudes.fecha_sol,
      solicitudes.ticket,
      solicitudes.remito,
      solicitudes.oc,
      solicitudes.fecha_recepcion,
      solicitudes.pc,
      servicios.servicio,
      servicios.id as aux_serv_id,
      estados_sc.nombre as estado,
      estados_sc.id as aux_estado_id
      
      FROM items_solicitados
      INNER JOIN solicitudes ON items_solicitados.id_solicitudes = solicitudes.id
      INNER JOIN productos ON items_solicitados.id_productos = productos.id
      INNER JOIN servicios ON solicitudes.id_servicio = servicios.id
      INNER JOIN estados_sc ON estados_sc.id = solicitudes.id_estado
      
      WHERE solicitudes.id = ?
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    
    $sql = "SELECT 
      solicitudes.id as nro_sol, 
      items_solicitados.id_productos as cod_producto, 
      productos.descripcion as descripcion_prod,
      items_solicitados.cantidad_sol,
      items_solicitados.cantidad_recibida,
      solicitudes.fecha_sol,
      solicitudes.ticket,
      solicitudes.remito,
      solicitudes.oc,
      solicitudes.fecha_recepcion,
      solicitudes.pc,
      servicios.servicio,
      servicios.id as aux_serv_id,
      estados_sc.nombre as estado,
      estados_sc.id as aux_estado_id
      
      FROM items_solicitados
      INNER JOIN solicitudes ON items_solicitados.id_solicitudes = solicitudes.id
      INNER JOIN productos ON items_solicitados.id_productos = productos.id
      INNER JOIN servicios ON solicitudes.id_servicio = servicios.id
      INNER JOIN estados_sc ON estados_sc.id = solicitudes.id_estado;
    ";
    
    $stmt = $conn->prepare($sql);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $solicitudes = [];

    while ($row = $result->fetch_assoc()) {
      $solicitudes[] = [
        'nro_sol' => $row['nro_sol'],
        'cod_producto' => $row['cod_producto'],
        'descripcion_prod' => $row['descripcion_prod'],
        'cantidad_sol' => $row['cantidad_sol'],
        'cantidad_recibida' => $row['cantidad_recibida'],
        'fecha_sol' => $row['fecha_sol'],
        'ticket' => $row['ticket'],
        'remito' => $row['remito'],
        'oc' => $row['oc'],
        'fecha_recepcion' => $row['fecha_recepcion'],
        'pc' => $row['pc'],
        'servicio' => $row['servicio'],
        'aux_serv_id' => $row['aux_serv_id'],
        'estado' => $row['estado'],
        'aux_estado_id' => $row['aux_estado_id'],
        
      ];
    }

    echo json_encode($solicitudes);
  } else {
    echo json_encode([]);
  }

  $stmt->close();
  $conn->close();
}


function addSolicitud($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['fecha_sol']) && !empty($data['ticket'])  && !empty($data['id_servicio'])) {
    $id = $data['id'];
    $fecha_sol = $data['fecha_sol'];
    $ticket = $data['ticket'];
    $oc = $data['oc'];
    $fecha_recepcion = $data['fecha_recepcion'];
    $remito = $data['remito'];
    $id_servicio = $data['id_servicio'];
    $pc = $data['pc'];
    $id_estado = $data['id_estado'];

    $sql = "INSERT INTO solicitudes(id, fecha_sol, ticket, oc, fecha_recepcion, remito, id_servicio, pc, id_estado) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("isiisissi", $id, $fecha_sol, $ticket, $oc, $fecha_recepcion, $remito, $id_servicio, $pc, $id_estado);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'Solicitud creado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al crear Solicitud']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}


function updateSolicitud($conn) {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if (!empty($data['id']) && !empty($data['fecha_sol']) && !empty($data['ticket']) && !empty($data['oc']) && !empty($data['fecha_recepcion']) && !empty($data['remito']) && !empty($data['id_servicio']) && !empty($data['pc']) && !empty($data['id_estado']) ) {
    $id = $data['id'];
    $fecha_sol = $data['fecha_sol'];
    $ticket = $data['ticket'];
    $oc = $data['oc'];
    $fecha_recepcion = $data['fecha_recepcion'];
    $remito = $data['remito'];
    $id_servicio = $data['id_servicio'];
    $pc = $data['pc'];
    $id_estado = $data['id_estado'];

      $sql = "UPDATE solicitudes SET fecha_sol = ?, ticket = ?, oc = ?, fecha_recepcion = ?, remito = ?, id_servicio = ?, pc = ?, id_estado = ?  WHERE id = ?";
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("siisiisii", $fecha_sol, $ticket, $oc, $fecha_recepcion, $remito, $id_servicio, $pc, $id_estado, $id);

      if ($stmt->execute()) {
      echo json_encode(['success' => 'Solicitud actualizada correctamente']);
      } else {
      echo json_encode(['error' => 'Error al actualizar Solicitud']);
      }

      $stmt->close();
  } else {
      echo json_encode(['error' => 'Datos incompletos']);
  }

  $conn->close();
}



function deleteSolicitud($conn) {
  $id = $_GET['id'];

  if (!empty($id)) {
    $sql = "DELETE FROM solicitudes WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo json_encode(['success' => 'solicitud eliminado correctamente']);
    } else {
      echo json_encode(['error' => 'Error al eliminar solicitud']);
    }

    $stmt->close();
  } else {
    echo json_encode(['error' => 'ID no especificado']);
  }

  $conn->close();
}

?>