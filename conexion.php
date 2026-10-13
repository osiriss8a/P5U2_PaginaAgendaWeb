

```php
<?php

$host = "localhost";
$db   = "definitive_conversation_paz_db";
$user = "angenda2";
$pass = "7p5-WB3fIe1qLO(7_h";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión a la base de datos.");
}
?>
