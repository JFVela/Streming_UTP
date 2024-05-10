<?php
class Visualizacion
{
    private $id_Visita;
    private $Usuarios_id;
    private $Movie_id;
    private $fecha_visu;
    private $like;
    private $dislike;

    // Constructor
    public function __construct($id_Visita, $Usuarios_id, $Movie_id, $fecha_visu, $like, $dislike)
    {
        $this->id_Visita = $id_Visita;
        $this->Usuarios_id = $Usuarios_id;
        $this->Movie_id = $Movie_id;
        $this->fecha_visu = $fecha_visu;
        $this->like = $like;
        $this->dislike = $dislike;
    }

    // Getters
    public function getIdVisita()
    {
        return $this->id_Visita;
    }

    public function getUsuariosId()
    {
        return $this->Usuarios_id;
    }

    public function getMovieId()
    {
        return $this->Movie_id;
    }

    public function getFechaVisu()
    {
        return $this->fecha_visu;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function getDislike()
    {
        return $this->dislike;
    }

    // Setters
    public function setUsuariosId($Usuarios_id)
    {
        $this->Usuarios_id = $Usuarios_id;
    }

    public function setMovieId($Movie_id)
    {
        $this->Movie_id = $Movie_id;
    }

    public function setFechaVisu($fecha_visu)
    {
        $this->fecha_visu = $fecha_visu;
    }

    public function setLike($like)
    {
        $this->like = $like;
    }

    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
    }
}
