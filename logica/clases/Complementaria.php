<?php

class Complementaria
{
    private $id;
    private $cursos;
    private $institucion;
    private $year;
    private $archivo;
    private $estado;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, cursos, institucion, year, archivo, estado, idPersona from complementaria where $campo=$valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->cursos = $campo['cursos'];
            $this->institucion = $campo['institucion'];
            $this->year = $campo['year'];
            $this->archivo = $campo['archivo'];
            $this->estado = $campo['estado'];
            $this->idPersona = $campo['idPersona'];
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getCursos()
    {
        return $this->cursos;
    }
    public function getInstitucion()
    {
        return $this->institucion;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function getArchivo()
    {
        return $this->archivo;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setCursos($cursos): void
    {
        $this->cursos = $cursos;
    }
    public function setInstitucion($institucion): void
    {
        $this->institucion = $institucion;
    }
    public function setYear($year): void
    {
        $this->year = $year;
    }

    public function setArchivo($archivo): void
    {
        $this->archivo = $archivo;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into complementaria(cursos, institucion, year, archivo, estado, idPersona ) values('{$this->cursos}', '{$this->institucion}','{$this->year}', '{$this->archivo}', '{$this->estado}', '{$this->idPersona}')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update complementaria set cursos='$this->cursos',institucion='$this->institucion',year='$this->year', archivo='$this->archivo', estado='$this->estado', idPersona='$this->idPersona' where id='$this->id'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from complementaria where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select * from complementaria $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Complementaria::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $complementaria = new Complementaria($resultado[$i], null);
            $lista[$i] = $complementaria;
        }
        return $lista;
    }
}
