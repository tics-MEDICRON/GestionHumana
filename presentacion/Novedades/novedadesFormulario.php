<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new Novedades('id', $_REQUEST['id']);
} else {
  $directorio = new Novedades(null, null);
  //$directorio->setIdPersona($_REQUEST['idPersona']);
}
//$evento=$directorio->getPersona();


?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/novedades/novedadesActualizar.php" enctype="multipart/form-data">

  <div class="form-group">
    <label class="form-label mt-4">PERSONAL: </label>
    <select class="form-select" name="idPersona" value="<?= $directorio->getIdPersona()  ?>" required>
      <?php
      $cadenasql = "select identificacion, nombres, apellidos from persona";
      $campo = ConectorBD::ejecutaryQuery($cadenasql);
      ?>
      <?php foreach ($campo as $opciones) { ?>
        <option value="<?php echo $opciones['identificacion'] ?>"><?php echo $opciones['nombres'] . ' ' . $opciones['apellidos'] ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label class="form-label mt-4">FECHA: </label>
    <input type="date" name="fecha" value="<?= $directorio->getFecha()  ?>" required class="form-control" placeholder="Ingrese el logro">
  </div>
  <br>
  <div class="form-group row">
    <label class="form-label mt-2">SOPORTE DE NOVEDAD: </label>
    <input class="form-control" type="file" name="evaluacionPdf" required id="formFile" value="<?= $directorio->getEvaluacionPdf()  ?>">
  </div>
  </br>
  </br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <button type="submit" name="accion" class="btn btn-danger" value="Cancelar">Cancelar</button>
</form>