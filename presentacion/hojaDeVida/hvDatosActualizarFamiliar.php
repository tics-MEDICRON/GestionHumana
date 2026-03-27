<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $historia = new Familia('id', $_REQUEST['id']);
} else $historia = new Familia(null, null);

?>

<center>

  </br>
  <h4>2. INFORMACION FAMILIAR </h4>
  <P>¡Bien! Ahora vamos a añadir tu información familiar</P>
</center>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaVida/hojaDeVidaActualizar.php">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre del Cónyuge ó Compañera(o): </label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="staticEmail" value="" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Numero de Identificacion: </label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="staticEmail" value="" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Número de Celular: </label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="staticEmail" value="" required>
    </div>
  </div>
  </br>
  <div class="form-group row">

    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de Nacimiento: </label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="staticEmail" value="" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Profesion u Ocupación: </label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="staticEmail" value="" required>
    </div>
  </div>
  </br>
  </br>
  <input type="hidden" name="nitAnterior" value="">
  <button type="button" name="accion" class="btn btn-success" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarPadres.php'">Siguiente</button>
</form>