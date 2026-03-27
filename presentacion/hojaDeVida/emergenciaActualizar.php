<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$contactoEmergencia = new ContactoEmergencia(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $contactoEmergencia->setNombre($_REQUEST['nombre']);
                $contactoEmergencia->setOcupacion($_REQUEST['ocupacion']);
                $contactoEmergencia->setParentesco($_REQUEST['parentesco']);
                $contactoEmergencia->setTelefonoEmergencia($_REQUEST['telefonoEmergencia']);
                $contactoEmergencia->setIdPersona($_REQUEST['idPersona']);
                $contactoEmergencia->guardar();
                break;
        case 'Modificar':
                $contactoEmergencia->setId($_REQUEST['id']);
                $contactoEmergencia->setNombre($_REQUEST['nombre']);
                $contactoEmergencia->setOcupacion($_REQUEST['ocupacion']);
                $contactoEmergencia->setParentesco($_REQUEST['parentesco']);
                $contactoEmergencia->setTelefonoEmergencia($_REQUEST['telefonoEmergencia']);
                $contactoEmergencia->setIdPersona($_REQUEST['idPersona']);
                $contactoEmergencia->modificar();
                break;
        case 'Eliminar':
                $contactoEmergencia->setId($_REQUEST['id']);
                $contactoEmergencia->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/contactoEmergencia.php&idPersona='. $_REQUEST['idPersona']);
