<?php

class ConectorBD { 
    private $servidor;
    Private $puerto;
    private $baseDatos;
    private $controlador;
    private $usuario;
    private $clave;

    private $Conexion;

    public function __construct(){
        $ruta = dirname(__FILE__) . '/../../configuracion.ini';
        if(!file_exists($ruta)){
            echo 'Error: No existe el archivo de conexion, nombre del archivo ' .$ruta;
            //return false;
            //die();
        } else {
            $parametros = parse_ini_file($ruta); 
            if(!$parametros) echo 'Error: no se pudo procesar el archivo de configuracion. Nombre del archivo' . $ruta;

        if(!$parametros) echo 'Error: no se pudo procesar el archivo de configuracion. Nombre del archivo:  ' . $ruta;
        //return false;
        else{ //vector asociativo. 
            $this->servidor=$parametros['servidor'];
            $this->puerto=$parametros['puerto'];
            $this->baseDatos=$parametros['baseDatos'];
            $this->controlador=$parametros['controlador'];
            $this->usuario=$parametros['usuario'];
            $this->clave=$parametros['clave'];
            //return true;
            }
        }
    }

    public function conectar(){
        try {
            $this->conexion = new PDO("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->baseDatos", $this->usuario, $this->clave);
            //echo "Conectado a la base de datos";
            return true;
        } catch (Exception $exc){
            echo "No se pudo conectar con la base de datos" . $exc->getMessage();
            return false;
        }
    }

    public function desconectar(){
        $this->conexion=null;
    }

    public static function ejecutaryQuery($cadenaSQL){
        $conectorBD=new ConectorBD();
        if($conectorBD->conectar()){
            $sentencia=$conectorBD->conexion->prepare($cadenaSQL);
            if(!$sentencia->execute())  $consulta=false;
            else{
                $consulta=$sentencia->fetchAll();
                $sentencia->closeCursor();
            }
        } else echo 'No se pudo conectar con la base de datos';
        $conectorBD->desconectar();
        return $consulta;
    }
}

