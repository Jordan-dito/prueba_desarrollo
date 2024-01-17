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

    // Método para guardar la materia en la base de datos
    // Ejemplo de método para guardar un profesor en la base de datos
    public function guardar($pdo) {
        try {
            // Si el ID existe, actualiza el registro; de lo contrario, inserta uno nuevo
            if ($this->id) {
                $query = "UPDATE materia SET nombre = ?, descripcion = ? WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$this->nombre, $this->descripcion, $this->id]);
            } else {
                $query = "INSERT INTO materia (nombre, descripcion) VALUES (?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$this->nombre, $this->descripcion]);
                $this->id = $pdo->lastInsertId(); // Obtén el ID generado automáticamente
            }

            return true;
        } catch (PDOException $e) {
            // Manejar el error
            return false;
        }
    }

    // Puedes agregar otros métodos relacionados con el modelo Materia aquí
}
?>
