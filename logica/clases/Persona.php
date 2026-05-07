<?php

//include ('../../../logica/clasesGenericas/ConectorBD.php');

class Persona
{
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $password;
    private $tipo;
    private $cargo;
    private $nombreCargo;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                
                $cadenaSQL = "SELECT persona.*, cargos.nombreCargo 
                FROM persona 
                LEFT JOIN cargos ON persona.cargo = cargos.id 
                WHERE persona.$campo='$valor'";                
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->identificacion = $campo['identificacion'];
            $this->nombres = $campo['nombres'];
            $this->apellidos = $campo['apellidos'];
            $this->password = $campo['clave'];
            $this->tipo = $campo['tipo'];
            $this->cargo = $campo['nombreCargo'];
            
        }
    }

    public function getIdentificacion()
    {
        return $this->identificacion;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getTipo()
    {
        return $this->tipo;
    }

    public function getCargo()
    {
        return $this->cargo;
    }
    public function getnombreCargo()
    {
        return $this->nombreCargo;
    }

    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }
    public function setNombres($nombres): void
    {
        $this->nombres = $nombres;
    }
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setTipo($tipo): void
    {
        $this->tipo = self::normalizarTipo($tipo);
    }

    public function setCargo($cargo): void
    {
        $this->cargo = $cargo;
    }

    public function getTipoEnObjeto()
    {
        return new TipoPersona($this->tipo);
    }

    public function __toString()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }


    public function getEstado(){
        $fechaActual=date('Y-m-d H:i:s');
        $diferenciaFechas=Fecha::calcularDiferenciaFechasEnSegundos($fechaActual,$this->inicio);
        // echo $fechaActual; echo date_default_timezone_get();
        if($diferenciaFechas>0) return 'Por Ejecutar';
        else {
            $diferenciaFechas= Fecha::calcularDiferenciaFechasEnSegundos($fechaActual,$this->fin);
            if ($diferenciaFechas<0) return 'Terminado';
            else return 'En Ejecucion';
        }
    }

    public function guardar()
    {
        if ($this->tipo == null) {
            throw new Exception('Tipo de usuario no valido');
        }
        $cadenaSQL = "insert into persona (identificacion, nombres, apellidos, clave, tipo, cargo) values ('$this->identificacion','$this->nombres','$this->apellidos','$this->password','$this->tipo','$this->cargo')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function normalizarTipo($tipo)
    {
        $tipo = trim((string)$tipo);
        $tiposPermitidos = array('Administrador', 'Colaborador', 'Contrato de Servicio');
        return in_array($tipo, $tiposPermitidos, true) ? $tipo : null;
    }

    public function modificar($identificacionAnterior)
    {
        if (strlen($this->password) < 32) $this->clave = md5($this->password);
        $cadenaSQL = "update persona set identificacion='$this->identificacion', nombres='$this->nombres', apellidos='$this->apellidos', clave='$this->password', tipo='$this->tipo', cargo='$this->cargo' where id='$identificacionAnterior'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificarTipo($identificacionAnterior)
    {
        $cadenaSQL = "update persona set tipo='{$this->tipo}' where identificacion='$identificacionAnterior'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    /*
        public function permisoTemporal($identificacionAnterior)
        {
            $cadenaSQL = "update persona set inicio='$this->inicio', fin='$this->fin' where identificacion='$identificacionAnterior';";
            echo $cadenaSQL;
            //ConectorBD::ejecutaryQuery($cadenaSQL);
        }
    */
    
    public function eliminar()
    {
        $cadenaSQL = "delete from persona where identificacion='$this->identificacion'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "SELECT persona.*, cargos.nombreCargo 
                  FROM persona 
                  LEFT JOIN cargos ON persona.cargo = cargos.id
                  $filtro $orden";

        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Persona::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $usuarios = new Persona($resultado[$i], null);
            $lista[$i] = $usuarios;
        }
        return $lista;
    }
    public static function validar($persona, $password)
    {
        $resultado = Persona::getListaEnObjetos("identificacion='$persona' and clave=md5('$password')", null);
        $usuario = null;
        if (count($resultado) > 0) $usuario = $resultado[0];
        return $usuario;
    }

    public static function validarIdentificacion($persona)
    {
        $resultado = Persona::getListaEnObjetos("identificacion='$persona'", null);
        $usuario = null;
        if (count($resultado) > 0) $usuario = $resultado[0];
        return $usuario;
    }

    public static function actualizarPassword($persona, $password)
    {
        $resultado = Persona::getListaEnObjetos("identificacion='$persona'", null);
        $usuario = null;
        if (count($resultado) > 0) {
           
                $cadenaSQL = "update persona set clave=md5('$password') where identificacion='$persona'";
                ConectorBD::ejecutaryQuery($cadenaSQL);
                $usuario = $resultado[0];
        }
        return $usuario;
    }
}
