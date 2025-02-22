<?php
$host = 'localhost';
$dbname = 'jwt_login'; // Cambia este nombre si tu base de datos se llama diferente
$username = 'root'; // Usuario por defecto en XAMPP
$password = ''; // Contraseña por defecto en XAMPP (vacía)

// Crear conexión usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Confirmar conexión exitosa
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Mostrar error si la conexión falla
    die("Error de conexión: " . $e->getMessage());
}
?>