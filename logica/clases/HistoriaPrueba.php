<?php

class HistoriaPrueba
{ 

    private $id;
    private $idPersona;
    private $foto;
    private $primerApellido;
    private $segundoApellido;
    private $nombres;
    private $lugarNacimiento;
    private $lugarExpedicion;
    private $fechaNacimiento;
    private $tipoDocumento;
    private $numeroDocumento;
    private $numeroLibreta;
    private $libretaMilitar;
    private $distrito;
    private $direccionResidencia;
    private $barrio;
    private $telResidencia;
    private $celular;
    private $email;
    private $estadoCivil;
    private $grupoSanguineo;
    private $tipoVivienda;
    private $estratoEconomico;
    private $personasCargo;
    private $eps;
    private $fondoPension;
    private $libreta;
    private $cc;
    private $archivoPension;
    private $afiliacionEps;
    private $sexo;
    private $nacionalidad;
    private $paisExpedicion;
    private $paisNacionalidad;
    private $paisResidencia;
    private $departamentoNacionalidad;
    private $departamentoResidencia;
    private $municipioNacionalidad;
    private $municipioResidencia;
    private $cesantias;
    private $archivoCesantias;
    private $archivoRethus;
    private $archivoBancaria;
    private $archivoRut;


    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select * from historiaprueba where $campo = $valor";
                //echo $cadenaSQL.'<p>';
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->idPersona = $campo['idPersona'];
            $this->foto = $campo['foto'];
            $this->primerApellido = $campo['primerApellido'];
            $this->segundoApellido = $campo['segundoApellido'];
            $this->nombres = $campo['nombres'];
            $this->lugarNacimiento = $campo['lugarNacimiento'];
            $this->lugarExpedicion = $campo['lugarExpedicion'];
            $this->fechaNacimiento = $campo['fechaNacimiento'];
            $this->tipoDocumento = $campo['tipoDocumento'];
            $this->numeroDocumento = $campo['numeroDocumento'];
            $this->numeroLibreta = $campo['numeroLibreta'];
            $this->libretaMilitar = $campo['libretaMilitar'];
            $this->distrito = $campo['distrito'];
            $this->direccionResidencia = $campo['direccionResidencia'];
            $this->barrio = $campo['barrio'];
            $this->telResidencia = $campo['telResidencia'];
            $this->celular = $campo['celular'];
            $this->email = $campo['email'];
            $this->estadoCivil = $campo['estadoCivil'];
            $this->grupoSanguineo = $campo['grupoSanguineo'];
            $this->tipoVivienda = $campo['tipoVivienda'];
            $this->estratoEconomico = $campo['estratoEconomico'];
            $this->personasCargo = $campo['personasCargo'];
            $this->eps = $campo['eps'];
            $this->fondoPension = $campo['fondoPension'];
            $this->libreta = $campo['libreta'];
            $this->cc = $campo['cc'];
            $this->archivoPension = $campo['archivoPension'];
            $this->afiliacionEps = $campo['afiliacionEps'];
            $this->sexo= $campo['sexo'];
            $this->nacionalidad= $campo['nacionalidad'];
            $this->paisExpedicion= $campo['paisExpedicion'];
            $this->paisNacionalidad= $campo['paisNacionalidad'];
            $this->paisResidencia= $campo['paisResidencia'];
            $this->departamentoNacionalidad = $campo['departamentoNacionalidad'];;
            $this->departamentoResidencia= $campo['departamentoResidencia'];
            $this->municipioNacionalidad= $campo['municipioNacionalidad'];
            $this->municipioResidencia= $campo['municipioResidencia'];
            $this->cesantias= $campo['cesantias'];
            $this->archivoCesantias = $campo['archivoCesantias'];
            $this->archivoRethus = $campo['archivoRethus'];
            $this->archivoBancaria = $campo['archivobancaria'];
            $this->archivoRut = $campo['archivorut'];
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
    public function getFoto()
    {
        return $this->foto;
    }
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }
    public function getLugarExpedicion()
    {
        return $this->lugarExpedicion;
    }
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }
    public function getFechaExpedicion()
    {
        return $this->fechaExpedicion;
    }
    public function getNumeroLibreta()
    {
        return $this->numeroLibreta;
    }
    public function getLibretaMilitar()
    {
        return $this->libretaMilitar;
    }
    public function getFileLibretaMilitar()
    {
        return $this->numeroDocumento . "_libreta.pdf" ;
    }

    public function getDistrito()
    {
        return $this->distrito;
    }
    public function getDireccionResidencia()
    {
        return $this->direccionResidencia;
    }
    public function getBarrio()
    {
        return $this->barrio;
    }
    public function getCiudad()
    {
        return $this->ciudad;
    }
    public function getTelResidencia()
    {
        return $this->telResidencia;
    }
    public function getCelular()
    {
        return $this->celular;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }
    public function getGrupoSanguineo()
    {
        return $this->grupoSanguineo;
    }

    public function getTipoVivienda()
    {
        return $this->tipoVivienda;
    }

    public function getEstratoEconomico()
    {
        return $this->estratoEconomico;
    }

    public function getPersonasCargo()
    {
        return $this->personasCargo;
    }

    public function getEps()
    {
        return $this->eps;
    }

    public function getFondoPension()
    {
        return $this->fondoPension;
    }

    public function getNombreFamilia()
    {
        return $this->nombreFamilia;
    }

    public function getIdentFamilia()
    {
        return $this->identFamilia;
    }

    public function getCelularFamilia()
    {
        return $this->celularFamilia;
    }
    public function getFechaFamiliar()
    {
        return $this->fechaFamiliar;
    }
    public function getProfesionFamiliar()
    {
        return $this->profesionFamiliar;
    }
    public function getLibreta()
    {
        return $this->libreta;
    }
    public function getCC()
    {
        return $this->cc;
    }
    public function getIdFamilia()
    {
        return $this->idFamilia;
    }
    public function getIdAcademica()
    {
        return $this->idAcademica;
    }
    public function getIdComplementaria()
    {
        return $this->idComplementaria;
    }
    public function getIdLaboral()
    {
        return $this->idLaboral;
    }
    public function getIdReferenciaLaboral()
    {
        return $this->referenciaLaboral;
    }
    public function getIdReferenciaPersonal()
    {
        return $this->idReferenciaPersonal;
    }

    public function getIdArchivo()
    {
        return $this->idArchivo;
    }
    public function getArchivoPension()
    {
        return $this->archivoPension;
    }

    

    public function getSexo()
    {
        return $this->sexo;
    }

    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    public function getPaisExpedicion()
    {
        return $this->paisExpedicion;
    }

    public function getPaisNacionalidad()
    {
        return $this->paisNacionalidad;
    }

    public function getPaisResidencia()
    {
        return $this->paisResidencia;
    }

    public function getDepartamentoNacionalidad()
    {
        return $this->departamentoNacionalidad;
    }

    public function getDepartamentoResidencia()
    {
        return $this->departamentoResidencia;
    }

    public function getMunicipioNacionalidad()
    {
        return $this->municipioNacionalidad;
    }

    public function getMunicipioResidencia()
    {
        return $this->municipioResidencia;
    }

    public function getCesantias()
    {
        return $this->cesantias;
    }

    public function getArchivoCesantias()
    {
        return $this->archivoCesantias;
    }

    public function getArchivoRethus()
    {
        return $this->archivoRethus;
    }

    public function getArchivoBancaria()
    {
        return $this->archivoBancaria;
    }

    public function getArchivoRut()
    {
        return $this->archivoRut;
    }

    public function getAfiliacionEps()
    {
        return $this->afiliacionEps;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }
    public function setPrimerApellido($primerApellido): void
    {
        $this->primerApellido = $primerApellido;
    }
    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundoApellido = $segundoApellido;
    }
    public function setNombres($nombres): void
    {
        $this->nombres = $nombres;
    }
    public function setLugarNacimiento($lugarNacimiento): void
    {
        $this->lugarNacimiento = $lugarNacimiento;
    }
    public function setLugarExpedicion($lugarExpedicion): void
    {
        $this->lugarExpedicion = $lugarExpedicion;
    }
    public function setFechaNacimiento($fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function setTipoDocumento($tipoDocumento): void
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setNumeroDocumento($numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
    }
    
    
    public function setNumeroLibreta($numeroLibreta): void
    {
        $this->numeroLibreta = $numeroLibreta;
    }
    public function setLibretaMilitar($libretaMilitar): void
    {
        $this->libretaMilitar = $libretaMilitar;
    }
    public function setDistrito($distrito): void
    {
        $this->distrito = $distrito;
    }
    public function setDireccionResidencia($direccionResidencia): void
    {
        $this->direccionResidencia = $direccionResidencia;
    }
    public function setBarrio($barrio): void
    {
        $this->barrio = $barrio;
    }
    public function setCiudad($ciudad): void
    {
        $this->ciudad = $ciudad;
    }
    public function setTelResidencia($telResidencia): void
    {
        $this->telResidencia = $telResidencia;
    }
    public function setCelular($celular): void
    {
        $this->celular = $celular;
    }
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function setEstadoCivil($estadoCivil): void
    {
        $this->estadoCivil = $estadoCivil;
    }
    public function setGrupoSanguineo($grupoSanguineo): void
    {
        $this->grupoSanguineo = $grupoSanguineo;
    }
    public function setTipoVivienda($tipoVivienda): void
    {
        $this->tipoVivienda = $tipoVivienda;
    }

    public function setEstratoEconomico($estratoEconomico): void
    {
        $this->estratoEconomico = $estratoEconomico;
    }

    public function setPersonasCargo($personasCargo): void
    {
        $this->personasCargo = $personasCargo;
    }

    public function setEps($eps): void
    {
        $this->eps = $eps;
    }

    public function setFondoPension($fondoPension): void
    {
        $this->fondoPension = $fondoPension;
    }

    public function setNombreFamilia($nombreFamilia): void
    {
        $this->nombreFamilia = $nombreFamilia;
    }

    public function setIdentFamilia($identFamilia): void
    {
        $this->identFamilia = $identFamilia;
    }

    public function setCelularFamilia($celularFamilia): void
    {
        $this->celularFamilia = $celularFamilia;
    }

    public function setFechaFamiliar($fechaFamiliar): void
    {
        $this->fechaFamiliar = $fechaFamiliar;
    }

    public function setProfesionFamiliar($profesionFamiliar): void
    {
        $this->profesionFamiliar = $profesionFamiliar;
    }

    public function setLibreta($libreta): void
    {
        $this->libreta = $libreta;
    }

    public function setCC($cc): void
    {
        $this->cc = $cc;
    }

    public function setIdFamilia($idFamilia): void
    {
        $this->idFamilia = $idFamilia;
    }

    public function setIdAcademica($idAcademica): void
    {
        $this->idAcademica = $idAcademica;
    }

    public function setIdComplementaria($idComplementaria): void
    {
        $this->idComplementaria = $idComplementaria;
    }

    public function setIdLaboral($idLaboral): void
    {
        $this->idLaboral = $idLaboral;
    }

    public function setIdReferenciaLaboral($referenciaLaboral): void
    {
        $this->referenciaLaboral = $referenciaLaboral;
    }

    public function setIdReferenciaPersonal($idReferenciaPersonal): void
    {
        $this->idReferenciaPersonal = $idReferenciaPersonal;
    }

    public function setIdArchivo($idArchivo): void
    {
        $this->idArchivo = $idArchivo;
    }
    public function setArchivoPension($archivoPension): void
    {
        $this->archivoPension = $archivoPension;
    }
    public function setAfiliacionEps($afiliacionEps): void
    {
        $this->afiliacionEps = $afiliacionEps;
    }

    public function setSexo($sexo): void
    {
        $this->sexo = $sexo;
    }

    public function setNacionalidad($nacionalidad): void
    {
        $this->nacionalidad = $nacionalidad;
    }

    public function setPaisExpedicion($paisExpedicion): void
    {
        $this->paisExpedicion = $paisExpedicion;
    }

    public function setPaisNacionalidad($paisNacionalidad): void
    {
        $this->paisNacionalidad = $paisNacionalidad;
    }

    public function setPaisResidencia($paisResidencia): void
    {
        $this->paisResidencia = $paisResidencia;
    }
    
    public function setDepartamentoNacionalidad($departamentoNacionalidad): void
    {
        $this->departamentoNacionalidad = $departamentoNacionalidad;
    }

    public function setDepartamentoResidencia($departamentoResidencia): void
    {
        $this->departamentoResidencia = $departamentoResidencia;
    }

    public function setMunicipioNacionalidad($municipioNacionalidad): void
    {
        $this->municipioNacionalidad = $municipioNacionalidad;
    }

    public function setMunicipioResidencia($municipioResidencia): void
    {
        $this->municipioResidencia = $municipioResidencia;
    }

    public function setCesantias($cesantias): void
    {
        $this->cesantias = $cesantias;
    }

    public function setArchivoCesantias($archivoCesantias): void
    {
        $this->archivoCesantias = $archivoCesantias;
    }

    public function setArchivoRethus($archivoRethus): void
    {
        $this->archivoRethus = $archivoRethus;
    }

    public function setArchivoBancaria($archivoBancaria): void
    {
        $this->archivoBancaria = $archivoBancaria;
    }

    public function setArchivoRut($archivoRut): void
    {
        $this->archivoRut = $archivoRut;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into historiaprueba(idPersona, foto, primerApellido, segundoApellido , nombres , lugarNacimiento, lugarExpedicion, fechaNacimiento, tipoDocumento ,numeroDocumento, numeroLibreta, libretaMilitar, distrito, direccionResidencia,barrio, telResidencia, celular, email, estadoCivil, grupoSanguineo,tipoVivienda,estratoEconomico,personasCargo,eps,fondoPension, libreta, cc,  archivoPension, afiliacionEps, sexo, nacionalidad, paisExpedicion, paisNacionalidad, paisResidencia, departamentoNacionalidad, departamentoResidencia, municipioNacionalidad, municipioResidencia, cesantias, archivoCesantias, archivoRethus, archivobancaria, archivorut) values ('$this->idPersona','$this->foto','$this->primerApellido','$this->segundoApellido','$this->nombres','$this->lugarNacimiento','$this->lugarExpedicion','$this->fechaNacimiento','$this->tipoDocumento','$this->numeroDocumento','$this->numeroLibreta','$this->libretaMilitar','$this->distrito','$this->direccionResidencia','$this->barrio', '$this->telResidencia','$this->celular','$this->email','$this->estadoCivil','$this->grupoSanguineo','$this->tipoVivienda','$this->estratoEconomico' , '$this->personasCargo' , '$this->eps' , '$this->fondoPension' ,  '$this->libreta' , '$this->cc', '$this->archivoPension' , '$this->afiliacionEps', '$this->sexo', '$this->nacionalidad', '$this->paisExpedicion', '$this->paisNacionalidad', '$this->paisResidencia', '$this->departamentoNacionalidad', '$this->departamentoResidencia', '$this->municipioNacionalidad', '$this->municipioResidencia', '$this->cesantias', '$this->archivoCesantias','$this->archivoRethus','$this->archivoBancaria','$this->archivoRut')";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar($idAnterior)
    {
        $cadenaSQL = "update historiaprueba set idPersona='$this->idPersona',foto='$this->foto',primerApellido='$this->primerApellido',segundoApellido='$this->segundoApellido',nombres='$this->nombres',lugarNacimiento='$this->lugarNacimiento', lugarExpedicion='$this->lugarExpedicion', fechanacimiento='$this->fechaNacimiento',tipoDocumento='$this->tipoDocumento',numeroDocumento='$this->numeroDocumento', numeroLibreta='$this->numeroLibreta', libretaMilitar='$this->libretaMilitar',distrito='$this->distrito',direccionResidencia='$this->direccionResidencia', barrio='$this->barrio', telResidencia='$this->telResidencia',celular='$this->celular',email='$this->email',estadoCivil='$this->estadoCivil',grupoSanguineo='$this->grupoSanguineo',tipoVivienda='$this->tipoVivienda', estratoEconomico='$this->estratoEconomico', personasCargo='$this->personasCargo' ,eps='$this->eps' , fondoPension='$this->fondoPension', libreta='$this->libreta', cc='$this->cc', archivoPension='$this->archivoPension' , afiliacionEps='$this->afiliacionEps', sexo='$this->sexo', nacionalidad='$this->nacionalidad', paisExpedicion='$this->paisExpedicion', paisNacionalidad='$this->paisNacionalidad', paisResidencia='$this->paisResidencia', departamentoNacionalidad='$this->departamentoNacionalidad', departamentoResidencia='$this->departamentoResidencia', municipioNacionalidad='$this->municipioNacionalidad', municipioResidencia='$this->municipioResidencia', cesantias='$this->cesantias', archivoCesantias='$this->archivoCesantias', archivoRethus='$this->archivoRethus', archivobancaria='$this->archivoBancaria', archivorut='$this->archivoRut' where id='$idAnterior'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from historia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, concat(persona.nombres,' ', persona.apellidos) as idPersona, foto, primerApellido, segundoApellido, historiaprueba.nombres, lugarNacimiento, lugarExpedicion, fechaNacimiento, tipoDocumento, numeroDocumento, numeroLibreta, libretaMilitar, distrito, direccionResidencia, barrio, telResidencia, celular, email,estadoCivil,grupoSanguineo, tipoVivienda, estratoEconomico, personasCargo,eps,fondoPension, libreta, cc , archivoPension, afiliacionEps, sexo, nacionalidad, paisExpedicion, paisNacionalidad, paisResidencia, departamentoNacionalidad, departamentoResidencia, municipioNacionalidad, municipioResidencia, cesantias, archivoCesantias, archivoRethus, archivobancaria, archivorut from historiaprueba INNER JOIN persona on persona.identificacion = idPersona $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = HistoriaPrueba::getLista($filtro, $orden);
        
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $historia = new HistoriaPrueba($resultado[$i], null);
            $lista[$i] = $historia;
        }
        return $lista;
    }
}
