<?php

require_once '../../logica/clasesGenericas/ConectorBD.php';
require_once '../../logica/clases/Persona.php';

$PERSONA = $_REQUEST['identificacion'];
$PASSWORD = $_REQUEST['password'];
$PASSWORD2 = $_REQUEST['password2'];

$PERSONA = Persona::actualizarPassword($PERSONA, $PASSWORD);
if ($PERSONA != null) {
    if ($PASSWORD == $PASSWORD2) {
        header('location: ../../index.php?mensaje2=La contraseña ha sido actualizada');
    } else {
        header('location: ../../index.php?mensaje=El número de identificacion o las contraseñas ingresadas no coinciden');
    }
} else {
    header('location: ../../index.php?mensaje=El número de identificacion o las contraseñas ingresadas no coinciden');
}
