<?php

class Profesor {
    private $id;
    private $nombre;
    private $email;

    public function __construct($nombre, $email, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    // Getter para obtener el ID del profesor
    public function getId() {
        return $this->id;
    }

    // Getter para obtener el nombre del profesor
    public function getNombre() {
        return $this->nombre;
    }

    // Getter para obtener el email del profesor
    public function getEmail() {
        return $this->email;
    }

    // Ejemplo de método para guardar un profesor en la base de datos
    public function guardar($pdo) {
        try {
            // Si el ID existe, actualiza el registro; de lo contrario, inserta uno nuevo
            if ($this->id) {
                $query = "UPDATE profesor SET nombre = ?, email = ? WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$this->nombre, $this->email, $this->id]);
            } else {
                $query = "INSERT INTO profesor (nombre, email) VALUES (?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$this->nombre, $this->email]);
                $this->id = $pdo->lastInsertId(); // Obtén el ID generado automáticamente
            }

            return true;
        } catch (PDOException $e) {
            // Manejar el error
            return false;
        }
    }
}

?>
