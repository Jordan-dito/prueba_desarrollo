<?php
include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Materia.php';

// Maneja la solicitud AJAX para obtener la lista de materias
if (isset($_GET['action']) && $_GET['action'] === 'obtenerMaterias') {
    // Limpiar el búfer de salida
    ob_clean();

    $listaMaterias = [];

    try {
        // Verifica la conexión a la base de datos
        if (!$pdo) {
            throw new Exception('Error de conexión a la base de datos');
        }

        $query = "SELECT * FROM materia";
        $stmt = $pdo->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $listaMaterias[] = $row;
            }

            // Una vez que hayas obtenido las materias, convierte el array en formato JSON
            header('Content-Type: application/json');
            echo json_encode($listaMaterias);
            exit;
        } else {
            throw new Exception('Error al obtener la lista de materias');
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

// Agregar otros métodos y rutas para el controlador Materia según tus necesidades

?>
