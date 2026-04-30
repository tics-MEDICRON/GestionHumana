<?php

class DocumentoColaborador
{
    private $id;
    private $idPersona;
    private $idTipoDocumento;
    private $nombreOriginal;
    private $rutaArchivo;
    private $fechaDocumento;
    private $vigente;
    private $createdAt;
    private $persona;
    private $tipoDocumento;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, id_persona, id_tipo_documento, nombre_original, ruta_archivo, fecha_documento, vigente, created_at from documento_colaborador where $campo='$valor'";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->idPersona = $campo['id_persona'];
            $this->idTipoDocumento = $campo['id_tipo_documento'];
            $this->nombreOriginal = $campo['nombre_original'];
            $this->rutaArchivo = $campo['ruta_archivo'];
            $this->fechaDocumento = $campo['fecha_documento'];
            $this->vigente = $campo['vigente'];
            $this->createdAt = $campo['created_at'];
            $this->persona = isset($campo['persona']) ? $campo['persona'] : null;
            $this->tipoDocumento = isset($campo['tipo_documento']) ? $campo['tipo_documento'] : null;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function getIdTipoDocumento()
    {
        return $this->idTipoDocumento;
    }

    public function getNombreOriginal()
    {
        return $this->nombreOriginal;
    }

    public function getRutaArchivo()
    {
        return $this->rutaArchivo;
    }

    public function getFechaDocumento()
    {
        return $this->fechaDocumento;
    }

    public function getVigente()
    {
        return $this->vigente;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getPersona()
    {
        return $this->persona;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function setIdTipoDocumento($idTipoDocumento): void
    {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    public function setNombreOriginal($nombreOriginal): void
    {
        $this->nombreOriginal = $nombreOriginal;
    }

    public function setRutaArchivo($rutaArchivo): void
    {
        $this->rutaArchivo = $rutaArchivo;
    }

    public function setFechaDocumento($fechaDocumento): void
    {
        $this->fechaDocumento = $fechaDocumento;
    }

    public function setVigente($vigente): void
    {
        $this->vigente = $vigente;
    }

    public function guardar()
    {
        $fechaDocumento = $this->fechaDocumento == '' ? 'null' : "'{$this->fechaDocumento}'";
        $cadenaSQL = "insert into documento_colaborador (id_persona, id_tipo_documento, nombre_original, ruta_archivo, fecha_documento, vigente) values ('{$this->idPersona}', '{$this->idTipoDocumento}', '{$this->nombreOriginal}', '{$this->rutaArchivo}', $fechaDocumento, '{$this->vigente}')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $fechaDocumento = $this->fechaDocumento == '' ? 'null' : "'{$this->fechaDocumento}'";
        $cadenaSQL = "update documento_colaborador set id_persona='{$this->idPersona}', id_tipo_documento='{$this->idTipoDocumento}', nombre_original='{$this->nombreOriginal}', ruta_archivo='{$this->rutaArchivo}', fecha_documento=$fechaDocumento, vigente='{$this->vigente}' where id='{$this->id}'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from documento_colaborador where id='{$this->id}'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";

        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";

        $cadenaSQL = "select documento_colaborador.*, concat(persona.nombres, ' ', persona.apellidos) as persona, tipo_documento_colaborador.nombre as tipo_documento
            from documento_colaborador
            inner join persona on documento_colaborador.id_persona = persona.identificacion
            inner join tipo_documento_colaborador on documento_colaborador.id_tipo_documento = tipo_documento_colaborador.id
            $filtro $orden";

        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = DocumentoColaborador::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $lista[$i] = new DocumentoColaborador($resultado[$i], null);
        }
        return $lista;
    }
}
