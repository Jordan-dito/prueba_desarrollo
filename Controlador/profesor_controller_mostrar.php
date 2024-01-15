<?php
include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Profesor.php';

// Maneja la solicitud AJAX para obtener la lista de profesores
if (isset($_GET['action']) && $_GET['action'] === 'obtenerProfesores') {
    // Limpiar el búfer de salida
    ob_clean();

    $listaProfesores = [];

    try {
        // Verifica la conexión a la base de datos
        if (!$pdo) {
            throw new Exception('Error de conexión a la base de datos');
        }

        $query = "SELECT * FROM profesor";
        $stmt = $pdo->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $listaProfesores[] = $row;
            }

            // Una vez que hayas obtenido los profesores, convierte el array en formato JSON
            header('Content-Type: application/json');
            echo json_encode($listaProfesores);
            exit;
        } else {
            throw new Exception('Error al obtener la lista de profesores');
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}


// Agregar otros métodos y rutas para el controlador Profesor según tus necesidades

?>
