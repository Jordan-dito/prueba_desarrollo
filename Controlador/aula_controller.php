<?php
include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Aula.php';

// Maneja la solicitud AJAX para obtener la lista de aulas
if (isset($_GET['action']) && $_GET['action'] === 'obtenerAulas') {
    // Limpiar el búfer de salida
    ob_clean();

    try {
        // Verifica la conexión a la base de datos
        if (!$pdo) {
            throw new Exception('Error de conexión a la base de datos');
        }

        // Consulta SQL para obtener la lista de aulas con los nombres de profesores y materias
        $query = "SELECT aula.id, aula.fecha, aula.hora, aula.tema, profesor.nombre AS nombre_profesor, materia.nombre AS nombre_materia 
                  FROM aula 
                  INNER JOIN profesor ON aula.profesor_id = profesor.id 
                  INNER JOIN materia ON aula.materia_id = materia.id";

        // Ejecuta la consulta
        $stmt = $pdo->query($query);

        // Verifica si la consulta fue exitosa
        if ($stmt) {
            // Obtén los resultados como un array asociativo
            $listaAulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Convierte el array en formato JSON
            header('Content-Type: application/json');
            echo json_encode($listaAulas);
            exit;
        } else {
            throw new Exception('Error al obtener la lista de aulas');
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}
?>
