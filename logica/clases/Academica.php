<?php
class Academica
{
    private $id;
    private $nivel;
    private $titulo;
    private $institucion;
    private $numSemestres;
    private $fechaGrado;
    private $archivo;
    private $idPersona;
    private $estado;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, nivel, titulo, institucion, numSemestres, fechaGrado, archivo, estado, idPersona from academica where $campo=$valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nivel = $campo['nivel'];
            $this->titulo = $campo['titulo'];
            $this->institucion = $campo['institucion'];
            $this->numSemestres = $campo['numSemestres'];
            $this->fechaGrado = $campo['fechaGrado'];
            $this->archivo = $campo['archivo'];
            $this->idPersona = $campo['idPersona'];
            $this->estado = $campo['estado'];
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNivel()
    {
        return $this->nivel;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getInstitucion()
    {
        return $this->institucion;
    }
    public function getnumSemestres()
    {
        return $this->numSemestres;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getfechaGrado()
    {
        return $this->fechaGrado;
    }

    public function getArchivo()
    {
        return $this->archivo;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setNivel($nivel): void
    {
        $this->nivel = $nivel;
    }
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }
    public function setInstitucion($institucion): void
    {
        $this->institucion = $institucion;
    }
    public function setnumSemestres($numSemestres): void
    {
        $this->numSemestres = $numSemestres;
    }
    public function setfechaGrado($fechaGrado): void
    {
        $this->fechaGrado = $fechaGrado;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    public function setArchivo($archivo): void
    {
        $this->archivo = $archivo;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into academica ( nivel, titulo, institucion, numSemestres, fechaGrado, archivo, idPersona, estado) values ('{$this->nivel}', '{$this->titulo}', '{$this->institucion}', '{$this->numSemestres}', '{$this->fechaGrado}', '{$this->archivo}', '{$this->idPersona}', '{$this->estado}')";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update academica set  nivel='$this->nivel', titulo='$this->titulo', institucion='$this->institucion',numSemestres='$this->numSemestres', fechaGrado='$this->fechaGrado', archivo='$this->archivo', idPersona='$this->idPersona' , estado='$this->estado' where id='$this->id'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from academica where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nivel, titulo, institucion, numSemestres, fechaGrado, archivo, idPersona, estado from academica $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Academica::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $academica = new Academica($resultado[$i], null);
            $lista[$i] = $academica;
        }
        return $lista;
    }
}
