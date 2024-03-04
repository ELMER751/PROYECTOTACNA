<?php
// Appp para consumir un  servicio
$apiurl="http://localhost/dashboard/ejercicios/ESPRESSTACNAA/servicioapi.php";
$curl= curl_init($apiurl);
curl_setopt($curl,CURLOPT_ENCODING,"");
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$json=curl_exec($curl);
echo $json;
curl_close($curl);
?>
