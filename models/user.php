<?php
class Usuario
{
    private $id_Usu;
    private $nomb1;
    private $nomb2;
    private $ape1;
    private $ape2;
    private $telefono;
    private $correo;
    private $contraseña;
    private $fecha_registro;

    // Constructor
    public function __construct($id_Usu, $nomb1, $nomb2, $ape1, $ape2, $telefono, $correo, $contraseña, $fecha_registro)
    {
        $this->id_Usu = $id_Usu;
        $this->nomb1 = $nomb1;
        $this->nomb2 = $nomb2;
        $this->ape1 = $ape1;
        $this->ape2 = $ape2;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->fecha_registro = $fecha_registro;
    }

    // Getters
    public function getId()
    {
        return $this->id_Usu;
    }

    public function getNomb1()
    {
        return $this->nomb1;
    }

    public function getNomb2()
    {
        return $this->nomb2;
    }

    public function getApe1()
    {
        return $this->ape1;
    }

    public function getApe2()
    {
        return $this->ape2;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    // Setters
    public function setNomb1($nomb1)
    {
        $this->nomb1 = $nomb1;
    }

    public function setNomb2($nomb2)
    {
        $this->nomb2 = $nomb2;
    }

    public function setApe1($ape1)
    {
        $this->ape1 = $ape1;
    }

    public function setApe2($ape2)
    {
        $this->ape2 = $ape2;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }

    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }
}
