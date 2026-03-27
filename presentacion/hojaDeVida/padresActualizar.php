<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$farmacia = new Familia(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $farmacia->setNombre($_REQUEST['nombre']);
                $farmacia->setFechaNacimiento($_REQUEST['fechaNacimiento']);
                $farmacia->setOcupacion($_REQUEST['ocupacion']);
                $farmacia->setParentesco($_REQUEST['parentesco']);
                $farmacia->setEmergencia($_REQUEST['emergencia']);
                $farmacia->setTelefono($_REQUEST['telefono']);
                $farmacia->setIdPersona($_REQUEST['idPersona']);
                $farmacia->guardar();
                break;
        case 'Modificar':
                $farmacia->setId($_REQUEST['id']);
                $farmacia->setNombre($_REQUEST['nombre']);
                $farmacia->setFechaNacimiento($_REQUEST['fechaNacimiento']);
                $farmacia->setOcupacion($_REQUEST['ocupacion']);
                $farmacia->setParentesco($_REQUEST['parentesco']);
                $farmacia->setEmergencia($_REQUEST['emergencia']);
                $farmacia->setTelefono($_REQUEST['telefono']);
                $farmacia->setIdPersona($_REQUEST['idPersona']);
                $farmacia->modificar();
                break;
        case 'Eliminar':
                $farmacia->setId($_REQUEST['id']);
                $farmacia->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/padres.php&idPersona='. $_REQUEST['idPersona']);
