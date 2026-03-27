<?php

class LaboralEmssanar
{
    private $id;
    private $unidad;
    private $cargo;
    private $telefono;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, unidad, cargo, telefono from laboralEmssanar where $campo = $valor";
                ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->unidad = $campo['unidad'];
            $this->cargo = $campo['cargo'];
            $this->telefono = $campo['telefono'];
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUnidad()
    {
        return $this->unidad;
    }
    public function getCargo()
    {
        return $this->cargo;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setUnidad($unidad): void
    {
        $this->unidad = $unidad;
    }
    public function setCargo($cargo): void
    {
        $this->cargo = $cargo;
    }
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }
    public function guardar()
    {
        $cadenaSQL =  "insert into laboralEmssanar (unidad, cargo, telefono) values ('$this->unidad', '$this->cargo', '$this->telefono')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update laboralEmssanar set unidad='$this->unidad', cargo='$this->cargo', telefono='$this->telefono'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from laboralEmssanar where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getlista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, unidad, cargo, telefono  from laboralEmssanar $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = LaboralEmssanar::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $laboralEmssanar = new LaboralEmssanar($resultado[$i], null);
            $lista[$i] = $laboralEmssanar;
        }
        return $lista;
    }
}
