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

    // Métodos para interactuar con la base de datos
    public function guardar() {
        // Implementa aquí la lógica para guardar la materia en la base de datos (utilizando PDO).
    }

    public function actualizar() {
        // Implementa aquí la lógica para actualizar la materia en la base de datos (utilizando PDO).
    }

    public function eliminar() {
        // Implementa aquí la lógica para eliminar la materia de la base de datos (utilizando PDO).
    }

    // Puedes agregar otros métodos relacionados con el modelo Materia aquí
}
?>
