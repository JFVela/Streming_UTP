<?php
class Movie
{
    private $idMovie;
    private $titulo;
    private $descripcion;
    private $año;
    private $duracion;
    private $url;
    private $director;

    // Constructor
    public function __construct($idMovie, $titulo, $descripcion, $año, $duracion, $url, $director)
    {
        $this->idMovie = $idMovie;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->año = $año;
        $this->duracion = $duracion;
        $this->url = $url;
        $this->director = $director;
    }

    // Getters
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getAño()
    {
        return $this->año;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getDirector()
    {
        return $this->director;
    }

    // Setters
    public function setIdMovie($idMovie)
    {
        $this->idMovie = $idMovie;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setAño($año)
    {
        $this->año = $año;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setDirector($director)
    {
        $this->director = $director;
    }
}
