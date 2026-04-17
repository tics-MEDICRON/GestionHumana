<?php

class TipoDocumentoColaborador
{
    private $id;
    private $nombre;

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
        $cadenaSQL = "insert ignore into tipo_documento_colaborador (nombre) values ('{$this->nombre}')";
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

    private static function getGruposDocumentos()
    {
        return array(
            'examenes' => array(
                'Examen De Ingreso',
                'Examen De Retiro',
                'Examen Periodico',
                'Examen Post Incapacidad'
            ),
            'formatos' => array(
                'Formato De Induccion General',
                'Formato De Induccion Especifica',
                'Formato De Induccion En Seguridad Y Salud En El Trabajo',
                'Formato De Entrega De Perfil De Cargo Y Carnet'
            ),
            'vacunas' => array(
                'Vacuna Tetano',
                'Vacuna Covid 19',
                'Vacuna Hepatitis B',
                'Titulacion De Hepatitis B',
                'Otros'
            )
        );
    }

    private static function getTiposMigrados()
    {
        return array(
            'Examen de ingreso' => 'Examen De Ingreso',
            'Examen de retiro' => 'Examen De Retiro',
            'Examen periodico' => 'Examen Periodico',
            'Examen Periodico' => 'Examen Periodico',
            'Examen post incapacidad' => 'Examen Post Incapacidad',
            'Formato de induccion general' => 'Formato De Induccion General',
            'Formato de induccion espesifica' => 'Formato De Induccion Especifica',
            'Formato de induccion especifica' => 'Formato De Induccion Especifica',
            'Formato de induccion en seguridad y salud en el trabajo' => 'Formato De Induccion En Seguridad Y Salud En El Trabajo',
            'Formato entrega de perfil de cargo' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Formato entrega de carnet' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Formato entrega de perfil de cargo y carnet' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Vacuna tetano' => 'Vacuna Tetano',
            'Vacuna covid' => 'Vacuna Covid 19',
            'Vacuna covid 19' => 'Vacuna Covid 19',
            'Vacuna hepatitis' => 'Vacuna Hepatitis B',
            'Vacuna hepatitis b' => 'Vacuna Hepatitis B',
            'Titulacion de hepatitis' => 'Titulacion De Hepatitis B',
            'Titulacion de hepatitis b' => 'Titulacion De Hepatitis B',
            'otros' => 'Otros'
        );
    }

    private static function escapar($valor)
    {
        return str_replace("'", "\\'", $valor);
    }

    private static function capitalizar($texto)
    {
        $palabras = explode(' ', strtolower(trim($texto)));
        $resultado = array();

        for ($i = 0; $i < count($palabras); $i++) {
            if ($palabras[$i] === '') {
                continue;
            }

            $resultado[] = strtoupper(substr($palabras[$i], 0, 1)) . substr($palabras[$i], 1);
        }

        return implode(' ', $resultado);
    }

    public static function getNombreVisible($nombre)
    {
        $nombreLimpio = trim($nombre);

        $mapa = array(
            'Examen De Ingreso' => 'Examen De Ingreso',
            'Examen de ingreso' => 'Examen De Ingreso',
            'Examen De Retiro' => 'Examen De Retiro',
            'Examen de retiro' => 'Examen De Retiro',
            'Examen Periodico' => 'Examen Peri&oacute;dico',
            'Examen periodico' => 'Examen Peri&oacute;dico',
            'Examen Peri?dico' => 'Examen Peri&oacute;dico',
            'Examen Post Incapacidad' => 'Examen Post Incapacidad',
            'Examen post incapacidad' => 'Examen Post Incapacidad',
            'Formato De Induccion General' => 'Formato De Inducci&oacute;n General',
            'Formato de induccion general' => 'Formato De Inducci&oacute;n General',
            'Formato De Inducci?n General' => 'Formato De Inducci&oacute;n General',
            'Formato De Induccion Especifica' => 'Formato De Inducci&oacute;n Espec&iacute;fica',
            'Formato de induccion especifica' => 'Formato De Inducci&oacute;n Espec&iacute;fica',
            'Formato de induccion espesifica' => 'Formato De Inducci&oacute;n Espec&iacute;fica',
            'Formato De Inducci?n Espec?fica' => 'Formato De Inducci&oacute;n Espec&iacute;fica',
            'Formato De Induccion En Seguridad Y Salud En El Trabajo' => 'Formato De Inducci&oacute;n En Seguridad Y Salud En El Trabajo',
            'Formato de induccion en seguridad y salud en el trabajo' => 'Formato De Inducci&oacute;n En Seguridad Y Salud En El Trabajo',
            'Formato De Entrega De Perfil De Cargo Y Carnet' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Formato entrega de perfil de cargo' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Formato entrega de carnet' => 'Formato De Entrega De Perfil De Cargo Y Carnet',
            'Vacuna Tetano' => 'Vacuna T&eacute;tano',
            'Vacuna tetano' => 'Vacuna T&eacute;tano',
            'Vacuna T?tano' => 'Vacuna T&eacute;tano',
            'Vacuna Covid 19' => 'Vacuna Covid 19',
            'Vacuna covid' => 'Vacuna Covid 19',
            'Vacuna covid 19' => 'Vacuna Covid 19',
            'Vacuna Hepatitis B' => 'Vacuna Hepatitis B',
            'Vacuna hepatitis' => 'Vacuna Hepatitis B',
            'Vacuna hepatitis b' => 'Vacuna Hepatitis B',
            'Titulacion De Hepatitis B' => 'Titulaci&oacute;n De Hepatitis B',
            'Titulacion de hepatitis' => 'Titulaci&oacute;n De Hepatitis B',
            'Titulacion de hepatitis b' => 'Titulaci&oacute;n De Hepatitis B',
            'Titulaci?n De Hepatitis B' => 'Titulaci&oacute;n De Hepatitis B',
            'Otros' => 'Otros',
            'otros' => 'Otros'
        );

        if (array_key_exists($nombreLimpio, $mapa)) {
            return $mapa[$nombreLimpio];
        }

        return self::capitalizar($nombreLimpio);
    }

    public static function sincronizarTipos()
    {
        self::migrarTiposAnteriores();

        foreach (self::getGruposDocumentos() as $tiposGrupo) {
            foreach ($tiposGrupo as $nombreTipo) {
                $tipo = new TipoDocumentoColaborador(null, null);
                $tipo->setNombre($nombreTipo);
                $tipo->guardar();
            }
        }
    }

    public static function getTiposPorGrupo($grupo)
    {
        $grupos = self::getGruposDocumentos();

        if (!array_key_exists($grupo, $grupos)) {
            $grupo = 'examenes';
        }

        return $grupos[$grupo];
    }

    public static function getListaPorGrupo($grupo)
    {
        self::sincronizarTipos();
        $tiposGrupo = self::getTiposPorGrupo($grupo);
        $nombres = array();

        foreach ($tiposGrupo as $nombreTipo) {
            $nombres[] = "'" . self::escapar($nombreTipo) . "'";
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
        foreach (self::getTiposMigrados() as $tipoAnterior => $tipoNuevo) {
            $tipoOrigen = self::getLista("BINARY nombre='" . self::escapar($tipoAnterior) . "'", null);
            if (count($tipoOrigen) == 0) {
                continue;
            }

            $tipoDestino = self::getLista("BINARY nombre='" . self::escapar($tipoNuevo) . "'", null);
            $idOrigen = $tipoOrigen[0]['id'];

            if (count($tipoDestino) == 0) {
                ConectorBD::ejecutaryQuery("update tipo_documento_colaborador set nombre='" . self::escapar($tipoNuevo) . "' where id='$idOrigen'");
                continue;
            }

            $idDestino = $tipoDestino[0]['id'];
            if ($idDestino != $idOrigen) {
                ConectorBD::ejecutaryQuery("update documento_colaborador set id_tipo_documento='$idDestino' where id_tipo_documento='$idOrigen'");
                ConectorBD::ejecutaryQuery("delete from tipo_documento_colaborador where id='$idOrigen'");
            }
        }
    }
}
