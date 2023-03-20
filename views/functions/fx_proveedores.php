<?php

function tbody_proveedores(){
    // Define la ruta relativa de la API
    $url = 'http://localhost/modulo_inventario/apis/v1/inventario/proveedores';

    // Obtiene los datos de la API
    $data = file_get_contents($url);

    // Si la respuesta de la API está en formato JSON, conviértela a un objeto PHP
    $json = json_decode($data);

    // Crea la tabla HTML con los datos obtenidos de la API
    
    foreach ($json as $dato) {
        echo '<tr><td>'.$dato->id.'</td><td>'.$dato->nombre.'</td><td>'.$dato->cuit.'</td><td>'.$dato->domicilio.'</td><td>'.$dato->celular.'</td></tr>';
    }
    

}


?>