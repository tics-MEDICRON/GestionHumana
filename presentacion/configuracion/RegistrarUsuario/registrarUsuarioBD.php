<?php

include('../../../logica/clasesGenericas/ConectorBD.php');
include('../../../logica/clases/Persona.php');
$usuario = new Persona(null, null);
$usuario = new Persona(null, null);
$usuario->setIdentificacion($_REQUEST['identificacion']);
$PERSONA = $_REQUEST['identificacion'];
$PERSONA = Persona::validarIdentificacion($PERSONA);
if ($PERSONA == null) {
    $usuario->setNombres($_REQUEST['nombres']);
    $usuario->setApellidos($_REQUEST['apellidos']);
    $usuario->setPassword(md5($_REQUEST['password']));
    $usuario->setTipo($_REQUEST['tipo']);
    $usuario->setCargo($_REQUEST['cargo']);
    $usuario->guardar();
    header('location: ../../../index.php?mensaje2=¡Felicitaciones!, su usuario ya ha sido registrado ');
} else {
    header('location: ../../../index.php?mensaje=El usuario ya se encuentra registrado');
}

//echo "prueba".$_REQUEST['nombres'];



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="presentacion/css/estilos.css" />
    <title>Confirmación de registro</title>
</head>

<body>

</body>

</html>