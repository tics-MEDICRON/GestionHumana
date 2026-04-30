<?php

class EvaluacionDesempeno
{
    private $id;
    private $idPersona;
    private $fechaInicio;
    private $fechaFin;
    private $estado;
    private $resultadoDesempeno;
    private $resultadoCompetencia;
    private $resultadoFinal;
    private $createdAt;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, idPersona, fechaInicio, fechaFin, estado, resultadoDesempeno, resultadoCompetencia, resultadoFinal, created_at from evaluacion_desempeno where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->idPersona = $campo['idPersona'];
            $this->fechaInicio = $campo['fechaInicio'];
            $this->fechaFin = $campo['fechaFin'];
            $this->estado = $campo['estado'];
            $this->resultadoDesempeno = $campo['resultadoDesempeno'];
            $this->resultadoCompetencia = $campo['resultadoCompetencia'];
            $this->resultadoFinal = $campo['resultadoFinal'];
            $this->createdAt = isset($campo['created_at']) ? $campo['created_at'] : '';
        }
    }

    public function getId() { return $this->id; }
    public function getIdPersona() { return $this->idPersona; }
    public function getFechaInicio() { return $this->fechaInicio; }
    public function getFechaFin() { return $this->fechaFin; }
    public function getEstado() { return $this->estado; }
    public function getResultadoDesempeno() { return $this->resultadoDesempeno; }
    public function getResultadoCompetencia() { return $this->resultadoCompetencia; }
    public function getResultadoFinal() { return $this->resultadoFinal; }
    public function getCreatedAt() { return $this->createdAt; }

    public function setId($id): void { $this->id = $id; }
    public function setIdPersona($idPersona): void { $this->idPersona = $idPersona; }
    public function setFechaInicio($fechaInicio): void { $this->fechaInicio = $fechaInicio; }
    public function setFechaFin($fechaFin): void { $this->fechaFin = $fechaFin; }
    public function setEstado($estado): void { $this->estado = $estado; }
    public function setResultadoDesempeno($resultadoDesempeno): void { $this->resultadoDesempeno = $resultadoDesempeno; }
    public function setResultadoCompetencia($resultadoCompetencia): void { $this->resultadoCompetencia = $resultadoCompetencia; }
    public function setResultadoFinal($resultadoFinal): void { $this->resultadoFinal = $resultadoFinal; }

    public function guardar()
    {
        $cadenaSQL = "insert into evaluacion_desempeno(idPersona, fechaInicio, fechaFin, estado) values ('$this->idPersona', '$this->fechaInicio', '$this->fechaFin', '$this->estado')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update evaluacion_desempeno set fechaInicio='$this->fechaInicio', fechaFin='$this->fechaFin', estado='$this->estado' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function actualizarResultados()
    {
        $cadenaSQL = "update evaluacion_desempeno set resultadoDesempeno='$this->resultadoDesempeno', resultadoCompetencia='$this->resultadoCompetencia', resultadoFinal='$this->resultadoFinal' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from evaluacion_desempeno where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select evaluacion_desempeno.*, concat(persona.nombres, ' ', persona.apellidos) as persona from evaluacion_desempeno inner join persona on persona.identificacion = evaluacion_desempeno.idPersona $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = EvaluacionDesempeno::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $lista[$i] = new EvaluacionDesempeno($resultado[$i], null);
        }
        return $lista;
    }
}
