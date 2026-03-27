<?php
require_once '../logica/clasesGenericas/ConectorBD.php';
require_once '../logica/clases/Persona.php';

$PERSONA = $_REQUEST['persona'];
$PASSWORD = $_REQUEST['clave'];
$PERSONA = Persona::validar($PERSONA, $PASSWORD);
if ($PERSONA == null) header('location: ../index.php?mensaje=Usuario o contraseña no valida');
else {
    session_start();
    $_SESSION['usuario'] = serialize($PERSONA);
    header('location: ../principal.php?CONTENIDO=presentacion/inicio.php');
}
