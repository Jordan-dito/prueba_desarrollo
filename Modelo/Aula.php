<?php
class Aula {
    private $id;
    private $fecha;
    private $hora;
    private $tema;
    private $profesorId;
    private $materiaId;

    public function __construct($fecha, $hora, $tema, $profesorId, $materiaId) {
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->tema = $tema;
        $this->profesorId = $profesorId;
        $this->materiaId = $materiaId;
    }

    public function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getTema() {
        return $this->tema;
    }

    public function getProfesorId() {
        return $this->profesorId;
    }

    public function getMateriaId() {
        return $this->materiaId;
    }

    // Métodos para interactuar con la base de datos
    public function guardar() {
        // Implementa aquí la lógica para guardar el aula en la base de datos (utilizando PDO).
    }

    public function actualizar() {
        // Implementa aquí la lógica para actualizar el aula en la base de datos (utilizando PDO).
    }

    public function eliminar() {
        // Implementa aquí la lógica para eliminar el aula de la base de datos (utilizando PDO).
    }

    // Puedes agregar otros métodos relacionados con el modelo Aula aquí
}
?>
