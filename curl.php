<?php

    $curl = curl_init();
    $url = "https://backend.thinger.io/v3/users/LisaDrse/devices/ESP8266/callback/data";
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJhbWJlciIsInVzciI6Ikxpc2FEcnNlIn0.TLR6m82pYaFXT14vu9sOO01o3I4omiHKVPNI2xUlJO4";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_exec($curl);
    curl_close($curl);
?>