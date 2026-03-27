<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$farmacia = new Familiar(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $farmacia->setNombre($_REQUEST['nombre']);
                $farmacia->setIdentificacion($_REQUEST['identificacion']);
                $farmacia->setCelular($_REQUEST['celular']);
                $farmacia->setFechaNacimiento($_REQUEST['fechaNacimiento']);
                $farmacia->setOcupacion($_REQUEST['ocupacion']);
                $farmacia->setIdPersona($_REQUEST['idPersona']);
                $farmacia->guardar();
                break;
        case 'Modificar':
                $farmacia->setId($_REQUEST['id']);
                $farmacia->setNombre($_REQUEST['nombre']);
                $farmacia->setIdentificacion($_REQUEST['identificacion']);
                $farmacia->setCelular($_REQUEST['celular']);
                $farmacia->setFechaNacimiento($_REQUEST['fechaNacimiento']);
                $farmacia->setOcupacion($_REQUEST['ocupacion']);
                $farmacia->setIdPersona($_REQUEST['idPersona']);
                $farmacia->modificar();
                break;
        case 'Eliminar':
                $farmacia->setId($_REQUEST['id']);
                $farmacia->setIdPersona($_REQUEST['idPersona']);
                $farmacia->eliminar();
                break;
}
header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/familiarFormulario.php&idPersona=' . $_REQUEST['idPersona']);
