<?php
    /*
    Código para obtener una lista de equipos registrados en el servidor y pertenecientes al dominio utilizando el protocolo LDAP.
    */

    // start a session
    //session_start();

    // manipulate session variables

    $adServer = "172.16.48.1"; // Dirección IP del servidor LDAP

    $ldap = ldap_connect($adServer);

    $usuario = 'smendoza.adm';
    $password = 'Teclado2021';

    $ldaprdn = 'HP' . "\\" . $usuario;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(objectClass=computer)";
        $result = ldap_search($ldap,"dc=HP,dc=LOCAL",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);

        $output = array();

        for ($i=0; $i<$info["count"]; $i++) {
            // Recorrer los resultados de la búsqueda y agregar el nombre y la descripción de los equipos al arreglo $output
            $computer = array(
                "nombre" => $info[$i]["cn"][0],
                "descripcion" => $info[$i]["description"][0]
            );
            array_push($output, $computer);
        }

        @ldap_close($ldap);

        // Imprimir el arreglo $output en formato JSON
        header("Content-type: application/json");
        echo json_encode($output);
    } else {
        header("Location: ./sign-in-fail.php");
    }
?>
