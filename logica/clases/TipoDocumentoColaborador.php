<?php

class TipoDocumentoColaborador
{
    private $id;
    private $nombre;

    public const GRUPOS_DOCUMENTOS = array(
        'examenes' => array(
            'Examen de ingreso',
            'Examen de retiro',
            'Examen periodico',
            'Examen post incapacidad'
        ),
        'formatos' => array(
            'Formato de induccion general',
            'Formato de induccion espesifica',
            'Formato entrega de perfil de cargo y carnet'
        ),
        'vacunas' => array(
            'Vacuna tetano',
            'Vacuna covid',
            'Vacuna hepatitis',
            'Titulacion de hepatitis'
        )
    );

    public const TIPOS_MIGRADOS = array(
        'Formato entrega de perfil de cargo' => 'Formato entrega de perfil de cargo y carnet',
        'Formato entrega de carnet' => 'Formato entrega de perfil de cargo y carnet'
    );

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, nombre from tipo_documento_colaborador where $campo='$valor'";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into tipo_documento_colaborador (nombre) values ('{$this->nombre}')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";

        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";

        $cadenaSQL = "select id, nombre from tipo_documento_colaborador $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = TipoDocumentoColaborador::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $lista[$i] = new TipoDocumentoColaborador($resultado[$i], null);
        }
        return $lista;
    }

    public static function sincronizarTipos()
    {
        $tiposActuales = TipoDocumentoColaborador::getLista(null, null);
        $nombresActuales = array();

        for ($i = 0; $i < count($tiposActuales); $i++) {
            $nombresActuales[] = $tiposActuales[$i]['nombre'];
        }

        foreach (self::GRUPOS_DOCUMENTOS as $tiposGrupo) {
            foreach ($tiposGrupo as $nombreTipo) {
                if (!in_array($nombreTipo, $nombresActuales)) {
                    $tipo = new TipoDocumentoColaborador(null, null);
                    $tipo->setNombre($nombreTipo);
                    $tipo->guardar();
                }
            }
        }

        self::migrarTiposAnteriores();
    }

    public static function getTiposPorGrupo($grupo)
    {
        if (!array_key_exists($grupo, self::GRUPOS_DOCUMENTOS)) {
            $grupo = 'examenes';
        }

        return self::GRUPOS_DOCUMENTOS[$grupo];
    }

    public static function getListaPorGrupo($grupo)
    {
        self::sincronizarTipos();
        $tiposGrupo = self::getTiposPorGrupo($grupo);
        $nombres = array();

        foreach ($tiposGrupo as $nombreTipo) {
            $nombres[] = "'" . str_replace("'", "\\'", $nombreTipo) . "'";
        }

        return self::getLista("nombre in (" . implode(',', $nombres) . ")", 'nombre');
    }

    public static function getIdsPorGrupo($grupo)
    {
        $tipos = self::getListaPorGrupo($grupo);
        $ids = array();

        for ($i = 0; $i < count($tipos); $i++) {
            $ids[] = $tipos[$i]['id'];
        }

        return $ids;
    }

    public static function getTituloGrupo($grupo)
    {
        switch ($grupo) {
            case 'formatos':
                return 'FORMATOS';
            case 'vacunas':
                return 'VACUNAS';
            default:
                return 'EXAMENES';
        }
    }

    public static function migrarTiposAnteriores()
    {
        foreach (self::TIPOS_MIGRADOS as $tipoAnterior => $tipoNuevo) {
            $tipoDestino = self::getLista("nombre='" . str_replace("'", "\\'", $tipoNuevo) . "'", null);
            $tipoOrigen = self::getLista("nombre='" . str_replace("'", "\\'", $tipoAnterior) . "'", null);

            if (count($tipoDestino) > 0 && count($tipoOrigen) > 0) {
                $idDestino = $tipoDestino[0]['id'];
                $idOrigen = $tipoOrigen[0]['id'];

                if ($idDestino != $idOrigen) {
                    ConectorBD::ejecutaryQuery("update documento_colaborador set id_tipo_documento='$idDestino' where id_tipo_documento='$idOrigen'");
                }
            }
        }
    }
}
