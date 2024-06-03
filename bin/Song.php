<?php

use Genre;

class Song
{
    private static $idCounter = 1;  // Compteur statique pour générer des ID uniques
    private string $title;
    private string $author;
    private string $genre;
    private string $image;
    private string $url;

    //fonction caché
    //fonction dévoile
    //fonction liké
    //


    // Constructeur
    public function __construct($title,$author, Genre $genre, $image, $url)
    {
        $this->id = self::$idCounter++;
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->image = $image;
        $this->url = $url;
        
    }

    // Méthode __toString
    public function __toString()
    {
        return
            "Title: " . $this->title . "\n" .
            "Author: " . $this->author . "\n" .
            "Genre: " . $this->genre . "\n" .
            "Image: " . $this->image . "\n" .
            "URL: " . $this->url . "\n";
    }

    // Getters
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower($title));
    }

    public function setGenre(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function setImage($image)
    {
        $this->image = ucfirst(strtolower($image));
    }

    public function setUrl($url)
    {
        $this->url = ucfirst(strtolower($url));
    }

    public function setAuthor($author)
    {
        $this->author = ucfirst(strtolower($author));
    }
}