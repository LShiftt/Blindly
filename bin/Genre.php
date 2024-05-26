<?php
class Genre {
    private static $idCounter = 1;  // Compteur statique pour générer des ID uniques
    private $id;
    private $name;
    private $popularity;

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
        $this->name = $name;
    }

    public function setPopularity($popularity) {
        $this->popularity = $popularity;
    }
}

// Exemple d'utilisation
$genre = new Genre("Rock", 95);
echo $genre;