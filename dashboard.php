<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = "a8f0353bad27f05cbe851f076e97cf722ae3907ffd95e94707cc5e06064f6822"; // Debe ser la misma clave que en authenticate.php
$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo "Acceso denegado. No se encontró el token.";
    exit();
}

$jwt = str_replace("Bearer ", "", $headers['Authorization']);

try {
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    echo "Bienvenido, " . $decoded->data->username . ". Este es tu dashboard protegido.";
} catch (Exception $e) {
    http_response_code(401);
    echo "Token inválido o expirado.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>
</body>
</html>