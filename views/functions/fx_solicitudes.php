<?php

function tbody_solicitudes(){
    // Define la ruta relativa de la API
    $url = 'http://localhost/modulo_inventario/apis/v1/solicitudes_compra/solicitudes_detalle.php';

    // Obtiene los datos de la API
    $data = file_get_contents($url);

    // Si la respuesta de la API está en formato JSON, conviértela a un objeto PHP
    $json = json_decode($data);

    // Crea la tabla HTML con los datos obtenidos de la API
    
    foreach ($json as $dato) {
        echo '<tr><td>'.$dato->nro_sol.'</td><td>'.$dato->cod_producto.'</td><td>'.$dato->descripcion_prod.'</td><td>'.$dato->cantidad_sol.'</td><td>'.$dato->cantidad_recibida.'</td><td>'.$dato->fecha_sol.'</td><td>'.$dato->ticket.'</td><td>'.$dato->remito.'</td><td>'.$dato->oc.'</td><td>'.$dato->fecha_recepcion.'</td><td>'.$dato->pc.'</td><td>'.$dato->servicio.'</td><td>'.$dato->estado.'</td></tr>';
    }
    

}


?>