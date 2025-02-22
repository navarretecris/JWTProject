<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$key = $_ENV['JWT_SECRET'];

$token = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;

if (!$token) {
    header("Location: login.php");
    exit();
}

try {
    $decoded = JWT::decode($token, new Key($key, 'HS256'));
    $username = $decoded->data->username;
} catch (Exception $e) {
    header("Location: login.php?error=invalid_token");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script>
        function logout() {
            document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = "login.php";
        }
    </script>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>
    <button onclick="logout()">Cerrar Sesión</button>
</body>
</html>