<?php

class Competencia
{
    private $id;
    private $descripcion;
    private $criterio;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, descripcion, criterio from competencia where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->descripcion = $campo['descripcion'];
            $this->criterio = isset($campo['criterio']) ? $campo['criterio'] : '';
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getCriterio()
    {
        return $this->criterio;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setCriterio($criterio): void
    {
        $this->criterio = $criterio;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into competencia(descripcion, criterio) values('$this->descripcion', '$this->criterio')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update competencia set descripcion='$this->descripcion', criterio='$this->criterio' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from competencia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, descripcion, criterio from competencia $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Competencia::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $competencia = new Competencia($resultado[$i], null);
            $lista[$i] = $competencia;
        }
        return $lista;
    }
}
