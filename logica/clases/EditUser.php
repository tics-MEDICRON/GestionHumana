<?php

class EditUser{

    private $id;
    private $nombres;
    private $apellidos;
    private $cargo;
    private $password;


    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select * from persona where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['identificacion'];
            $this->nombres = $campo['nombres'];
            $this->apellidos = $campo['apellidos'];
            $this->cargo = $campo['cargo'];
            $this->password = $campo['clave'];
        }
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getCargo()
    {
        return $this->cargo;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombres = $nombre;
    }

    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function setCargo($cargo): void
    {
        $this->cargo = $cargo;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }



    public function modificar()
    {
        $cadenaSQL = "update persona set nombres='$this->nombres', apellidos='$this->apellidos', clave='".md5($this->password)."', cargo='$this->cargo' where identificacion='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }



}


?>