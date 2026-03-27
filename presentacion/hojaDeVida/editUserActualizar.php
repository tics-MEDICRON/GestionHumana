<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$editUser = new EditUser(null, null);
switch ($_REQUEST['accion']) {
        case 'Modificar':
                $editUser->setId($_REQUEST['identificacion']);
                $editUser->setNombre($_REQUEST['nombres']);
                $editUser->setApellidos($_REQUEST['apellidos']);
                $editUser->setCargo($_REQUEST['cargo']);
                $editUser->setPassword($_REQUEST['password']);
                $editUser->modificar();
                break;

}

header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php');
