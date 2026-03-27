<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$persona = new Persona(null, null);
switch ($_REQUEST['accion']) {

        case 'Modificar':
                $persona->setTipo($_REQUEST['tipo']);
                $persona->modificarTipo($_REQUEST['identificacionAnterior']);
                break;
        case 'Eliminar':
                $persona->setIdentificacion($_REQUEST['identificacion']);
                $persona->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/usuarios/usuarios.php');
