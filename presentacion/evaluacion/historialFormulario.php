<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new HistorialEvaluacion('id', $_REQUEST['id']);
} else {
  $directorio = new HistorialEvaluacion(null, null);
  if (isset($_REQUEST['idPersona'])) $directorio->setIdPersona($_REQUEST['idPersona']);
}

$idPersonaSeleccionada = $directorio->getIdPersona();

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/historialActualizar.php" enctype="multipart/form-data">

  <div class="form-group">
    <label class="form-label mt-4">PERSONAL: </label>
    <select class="form-select" name="idPersona" required>
      <?php
      $cadenasql = "select identificacion, nombres, apellidos from persona";
      $campo = ConectorBD::ejecutaryQuery($cadenasql);
      ?>
      <?php foreach ($campo as $opciones) { ?>
        <option value="<?php echo $opciones['identificacion'] ?>" <?php if ($idPersonaSeleccionada == $opciones['identificacion']) echo 'selected'; ?>><?php echo $opciones['nombres'] . ' ' . $opciones['apellidos'] ?></option>
      <?php
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label mt-4">FECHA: </label>
    <input type="date" name="fecha" value="<?= $directorio->getFecha() ?>" required class="form-control" placeholder="Ingrese el logro">
  </div>

  <br>

  <div class="form-group row">
    <label class="form-label mt-2">EVALUACI&Oacute;N DESEMPE&Ntilde;O: </label>
    <?php if ($titulo == 'Adicionar') { ?>
      <input class="form-control" type="file" name="evaluacionPdf[]" required multiple id="formFile" accept="application/pdf">
    <?php } else { ?>
      <input class="form-control" type="file" name="evaluacionPdf" id="formFile" accept="application/pdf">
      <?php if ($directorio->getEvaluacionPdf() != '') { ?>
        <small>Archivo actual: <a href="presentacion/evaluacion/documentos/<?= $directorio->getEvaluacionPdf() ?>" target="_blank"><?= $directorio->getEvaluacionPdf() ?></a></small>
      <?php } ?>
    <?php } ?>
  </div>

  <br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a class="btn btn-danger" href="principal.php?CONTENIDO=presentacion/evaluacion/historialArchivos.php&idPersona=<?= $idPersonaSeleccionada ?>">Cancelar</a>
</form>
