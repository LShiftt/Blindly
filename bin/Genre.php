<?php
class Genre {
    private static $idCounter = 1;  // Compteur statique pour générer des ID uniques
    private $id;
    private string $name;
    private string $popularity;
    private string $color;

    // Constructeur
    public function __construct($name, $popularity) {
        $this->id = self::$idCounter++;  // Assignation d'un ID unique
        $this->name = $name;
        $this->popularity = $popularity;
    }

    // Méthode __toString
    public function __toString() {
        return "ID: " . $this->id . "\n" .
               "Name: " . $this->name . "\n" .
               "Popularity: " . $this->popularity . "\n";
    }
    public function uploadSong(){
        $sql = "INSERT INTO ";
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPopularity() {
        return $this->popularity;
    }

    // Setters
    public function setName($name) {
        $this->name = ucfirst(strtolower($name));
    }

    public function setPopularity($popularity) {
        $this->popularity = $popularity;
    }
}