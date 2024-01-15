<?php
$hostname = 'localhost';
$database = 'trabajo_2024';
$username = 'root';
$password = '';

try {
    // Crear una nueva instancia de PDO
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // Configurar PDO para lanzar excepciones en caso de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configurar el juego de caracteres a UTF-8
    $pdo->exec("SET NAMES utf8");

    // Otras configuraciones opcionales, como el modo de emulación (si es necesario)
    // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // La conexión se ha establecido con éxito
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // En caso de error, manejar la excepción de manera profesional
    // Registra el error en un archivo de registro y muestra un mensaje amigable al usuario
    error_log("Error de conexión a la base de datos: " . $e->getMessage(), 0);
    die("Lo sentimos, se ha producido un error en la conexión. Por favor, inténtelo de nuevo más tarde.");
}
?>
