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
