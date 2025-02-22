<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;dbname=jwt_login", "root", "");

// Insertar un usuario de prueba
$password = password_hash('123456', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->execute(['username' => 'usuario', 'password' => $password]);