<?php

function tbody_productos(){
    // Define la ruta relativa de la API
    $url = 'http://localhost/modulo_inventario/apis/v1/inventario/productos';

    // Obtiene los datos de la API
    $data = file_get_contents($url);

    // Si la respuesta de la API está en formato JSON, conviértela a un objeto PHP
    $json = json_decode($data);

    // Crea la tabla HTML con los datos obtenidos de la API
    
    foreach ($json as $dato) {
        echo '<tr><td>'.$dato->id.'</td><td>'.$dato->id_categorias.'</td><td>'.$dato->id_marcas.'</td><td>'.$dato->descripcion.'</td></tr>';
    }
    

}


?>