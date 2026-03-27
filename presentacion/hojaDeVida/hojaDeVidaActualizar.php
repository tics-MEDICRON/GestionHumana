<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');


$historia = new HistoriaPrueba(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $historia->setIdPersona(($_REQUEST['numeroDocumento']));
        $historia->setPrimerApellido(($_REQUEST['primerApellido']));
        $historia->setSegundoApellido(($_REQUEST['segundoApellido']));
        $historia->setNombres(($_REQUEST['nombres']));

        $nombreArchivo = $_REQUEST['nombres'] . '_' . $_REQUEST['primerApellido'] . '_' . $_REQUEST['numeroDocumento'];
        $ruta = 'presentacion/hojaDeVida';

        $extension = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.')); //Obtiene la extension del archivo archivo.extension
        move_uploaded_file($_FILES['foto']['tmp_name'], "$ruta/fotos/$nombreArchivo$extension");
        $historia->setFoto($nombreArchivo . $extension);
        
        $historia->setLugarNacimiento(($_REQUEST['lugarNacimiento']));
        $historia->setFechaNacimiento(($_REQUEST['fechaNacimiento']));
        $historia->setTipoDocumento(($_REQUEST['tipoDocumento']));
        $historia->setNumeroDocumento(($_REQUEST['numeroDocumento']));
        $historia->setLugarExpedicion(($_REQUEST['lugarExpedicion']));
        $historia->setNumeroLibreta(($_REQUEST['numeroLibreta']));
        $historia->setLibretaMilitar(($_REQUEST['libretaMilitar'])); 
        $historia->setDistrito(($_REQUEST['distrito']));
        $historia->setDireccionResidencia(($_REQUEST['direccionResidencia']));
        $historia->setBarrio(($_REQUEST['barrio']));
        $historia->setTelResidencia(($_REQUEST['telResidencia']));
        $historia->setCelular(($_REQUEST['celular']));
        $historia->setEmail(($_REQUEST['email']));
        $historia->setEstadoCivil(($_REQUEST['estadoCivil']));
        $historia->setGrupoSanguineo(($_REQUEST['grupoSanguineo']));
        $historia->setTipoVivienda(($_REQUEST['tipoVivienda']));
        $historia->setEstratoEconomico(($_REQUEST['estratoEconomico']));
        $historia->setPersonasCargo(($_REQUEST['personasCargo']));
        $historia->setEps(($_REQUEST['eps']));
        $historia->setFondoPension(($_REQUEST['fondoPension']));

        $historia->setSexo(($_REQUEST['sexo']));
        $historia->setNacionalidad(($_REQUEST['nacionalidad']));
        $historia->setPaisExpedicion(($_REQUEST['paisExpedicion']));
        $historia->setPaisNacionalidad(($_REQUEST['paisNacionalidad']));
        $historia->setPaisResidencia(($_REQUEST['paisResidencia']));
        $historia->setDepartamentoNacionalidad(($_REQUEST['departamentoNacionalidad']));
        $historia->setDepartamentoResidencia(($_REQUEST['departamentoResidencia']));
        $historia->setMunicipioNacionalidad(($_REQUEST['municipioNacionalidad']));
        $historia->setMunicipioResidencia(($_REQUEST['municipioResidencia']));
        $historia->setCesantias(($_REQUEST['cesantias']));


        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_cedula';
        $cadena =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['cc']['tmp_name'], "$ruta/documentos/$cadena.pdf");
        $historia->setCC($cadena . '.pdf');

        
        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_libreta';
        $cadena2 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['libreta']['tmp_name'], "$ruta/documentos/$cadena2.pdf");
        $historia->setLibreta($cadena2 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['fondoPension'];
        $cadena3 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoPension']['tmp_name'], "$ruta/documentos/$cadena3.pdf");
        $historia->setArchivoPension($cadena3 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['eps'];
        $cadena4 =str_replace(' ', '', $nombreArchivo);
        $cadena_4 = str_replace('.', '_', $cadena4);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoEps']['tmp_name'], "$ruta/documentos/$cadena_4.pdf");
        $historia->setAfiliacionEps($cadena_4 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['cesantias'];
        $cadena5 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoCesantias']['tmp_name'], "$ruta/documentos/$cadena5.pdf");
        $historia->setArchivoCesantias($cadena5 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_rethus' ;
        $cadena6 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivorethus']['tmp_name'], "$ruta/documentos/$cadena6.pdf");
        $historia->setArchivoRethus($cadena6 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_bancaria' ;
        $cadena7 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivobancaria']['tmp_name'], "$ruta/documentos/$cadena7.pdf");
        $historia->setArchivoBancaria($cadena7 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_rut' ;
        $cadena8 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivorut']['tmp_name'], "$ruta/documentos/$cadena8.pdf");
        $historia->setArchivoRut($cadena8 . '.pdf');

        
        $historia->guardar();
        break;

    case 'Modificar':
        $historia->setId(($_REQUEST['id']));
        $historia->setIdPersona(($_REQUEST['numeroDocumento']));
        $historia->setPrimerApellido(($_REQUEST['primerApellido']));
        $historia->setSegundoApellido(($_REQUEST['segundoApellido']));
        $historia->setNombres(($_REQUEST['nombres']));

        $nombreArchivo = $_REQUEST['nombres'] . '_' . $_REQUEST['primerApellido'] . '_' . $_REQUEST['numeroDocumento'];
        $ruta = 'presentacion/hojaDeVida';

        $extension = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.')); //Obtiene la extension del archivo archivo.extension
        move_uploaded_file($_FILES['foto']['tmp_name'], "$ruta/fotos/$nombreArchivo$extension");
        $historia->setFoto($nombreArchivo . $extension);
        
        $historia->setLugarNacimiento(($_REQUEST['lugarNacimiento']));
        $historia->setFechaNacimiento(($_REQUEST['fechaNacimiento']));
        $historia->setTipoDocumento(($_REQUEST['tipoDocumento']));
        $historia->setNumeroDocumento(($_REQUEST['numeroDocumento']));
        $historia->setLugarExpedicion(($_REQUEST['lugarExpedicion']));
        $historia->setNumeroLibreta(($_REQUEST['numeroLibreta']));
        $historia->setLibretaMilitar(($_REQUEST['libretaMilitar']));
        $historia->setDistrito(($_REQUEST['distrito']));
        $historia->setDireccionResidencia(($_REQUEST['direccionResidencia']));
        $historia->setBarrio(($_REQUEST['barrio']));
        $historia->setTelResidencia(($_REQUEST['telResidencia']));
        $historia->setCelular(($_REQUEST['celular']));
        $historia->setEmail(($_REQUEST['email']));
        $historia->setEstadoCivil(($_REQUEST['estadoCivil']));
        $historia->setGrupoSanguineo(($_REQUEST['grupoSanguineo']));
        $historia->setTipoVivienda(($_REQUEST['tipoVivienda']));
        $historia->setEstratoEconomico(($_REQUEST['estratoEconomico']));
        $historia->setPersonasCargo(($_REQUEST['personasCargo']));
        $historia->setEps(($_REQUEST['eps']));
        $historia->setFondoPension(($_REQUEST['fondoPension']));

        $historia->setSexo(($_REQUEST['sexo']));
        $historia->setNacionalidad(($_REQUEST['nacionalidad']));
        $historia->setPaisExpedicion(($_REQUEST['paisExpedicion']));
        $historia->setPaisNacionalidad(($_REQUEST['paisNacionalidad']));
        $historia->setPaisResidencia(($_REQUEST['paisResidencia']));
        $historia->setDepartamentoNacionalidad(($_REQUEST['departamentoNacionalidad']));
        $historia->setDepartamentoResidencia(($_REQUEST['departamentoResidencia']));
        $historia->setMunicipioNacionalidad(($_REQUEST['municipioNacionalidad']));
        $historia->setMunicipioResidencia(($_REQUEST['municipioResidencia']));
        $historia->setCesantias(($_REQUEST['cesantias']));

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_cedula';
        $cadena =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['cc']['tmp_name'], "$ruta/documentos/$cadena.pdf");
        $historia->setCC($cadena . '.pdf');

        
        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_libreta';
        $cadena2 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['libreta']['tmp_name'], "$ruta/documentos/$cadena2.pdf");
        $historia->setLibreta($cadena2 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['fondoPension'];
        $cadena3 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoPension']['tmp_name'], "$ruta/documentos/$cadena3.pdf");
        $historia->setArchivoPension($cadena3 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['eps'];
        $cadena4 =str_replace(' ', '', $nombreArchivo);
        $cadena_4 = str_replace('.', '_', $cadena4);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoEps']['tmp_name'], "$ruta/documentos/$cadena_4.pdf");
        $historia->setAfiliacionEps($cadena_4 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_' . $_REQUEST['cesantias'];
        $cadena5 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivoCesantias']['tmp_name'], "$ruta/documentos/$cadena5.pdf");
        $historia->setArchivoCesantias($cadena5 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_rethus' ;
        $cadena6 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivorethus']['tmp_name'], "$ruta/documentos/$cadena6.pdf");
        $historia->setArchivoRethus($cadena6 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_bancaria' ;
        $cadena7 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivobancaria']['tmp_name'], "$ruta/documentos/$cadena7.pdf");
        $historia->setArchivoBancaria($cadena7 . '.pdf');

        $nombreArchivo = $_REQUEST['numeroDocumento'] . '_rut' ;
        $cadena8 =str_replace(' ', '', $nombreArchivo);
        $ruta = 'presentacion/hojaDeVida';
        move_uploaded_file($_FILES['archivorut']['tmp_name'], "$ruta/documentos/$cadena8.pdf");
        $historia->setArchivoRut($cadena8 . '.pdf');

        $historia->modificar(($_REQUEST['idAnterior']));
        break;
}
header("location: principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona=". $_REQUEST['numeroDocumento']);
