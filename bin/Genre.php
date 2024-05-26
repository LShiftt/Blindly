<?php
class Genre {
    private static $idCounter = 1;  // Compteur statique pour générer des ID uniques
    private $id;
    private string $nom;
    private string $popularite;
    private string $couleur;

    // Constructeur
    public function __construct($name, $popularity) {
        $this->id = self::$idCounter++;  // Assignation d'un ID unique
        $this->name = $name;
        $this->popularity = $popularity;
    }

    // Méthode __toString
    public function __toString() {
        return "ID: " . $this->id . "\n" .
               "Name: " . $this->nom . "\n" .
               "Popularity: " . $this->popularite . "\n";
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPopularite() {
        return $this->popularite;
    }

    // Setters
    public function setNom($nom) {
        $this->nom = ucfirst(strtolower($nom));
    }

    public function setPopularite($popularite) {
        $this->popularite = $popularite;
    }
}