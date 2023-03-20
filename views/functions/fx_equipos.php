<?php

function tbody_equipos(){
    // Define la ruta relativa de la API
    //$url = 'http://localhost/modulo_inventario/apis/v1/equipos';
    $url = 'http://localhost/modulo_inventario/apis/v1/equipos/equipos.json';

    // Obtiene los datos de la API
    $data = file_get_contents($url);

    // Si la respuesta de la API está en formato JSON, conviértela a un objeto PHP
    $json = json_decode($data);

    // Crea la tabla HTML con los datos obtenidos de la API
    
    foreach ($json as $dato) {
        echo '<tr><td>'.$dato->nombre.'</td><td>'.$dato->descripcion.'</td></tr>';
    }
    

}


?>