<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$key = $_ENV['JWT_SECRET'];
$pdo = new PDO("mysql:host=localhost;dbname=jwt_login", "root", "");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $payload = [
        "iss" => "http://localhost",
        "aud" => "http://localhost",
        "iat" => time(),
        "exp" => time() + 3600, // Expira en 1 hora
        "data" => [
            "id" => $user['id'],
            "username" => $user['username']
        ]
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');

    // Guardar el token en una cookie segura
    setcookie("token", $jwt, [
        'expires' => time() + 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => true,
        'samesite' => 'Strict'
    ]);

    echo json_encode(["success" => true, "username" => $user['username']]);
} else {
    echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
}
?>