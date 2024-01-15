<?php
class Materia {
    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($nombre, $descripcion) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    // Método para guardar una nueva materia en la base de datos
    public function guardar($pdo) {
        try {
            $query = "INSERT INTO materias (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':descripcion', $this->descripcion);

            $stmt->execute();

            // Actualiza el ID con el ID generado por la base de datos
            $this->id = $pdo->lastInsertId();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener todas las materias desde la base de datos
    public function obtenerMaterias($pdo) {
        try {
            $query = "SELECT * FROM materias";  // Reemplaza 'materias' con el nombre real de tu tabla
            $stmt = $pdo->query($query);

            if ($stmt) {
                $materias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $materias;
            } else {
                throw new Exception('Error al obtener las materias');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Puedes agregar otros métodos relacionados con el modelo Materia aquí
}
?>
