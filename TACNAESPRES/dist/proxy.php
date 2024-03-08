<?php
// URL de la API externa
$api_url = 'https://api.apis.net.pe/v1/dni?numero=' . $_GET['numero'];

// Realizar la solicitud a la API externa
$response = file_get_contents($api_url);

// Enviar la respuesta al cliente
header('Content-Type: application/json');
echo $response;
?>