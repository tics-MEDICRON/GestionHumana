<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $directorio = new EvaluacionDesempeno('id', $_REQUEST['id']);
} else {
    $directorio = new EvaluacionDesempeno(null, null);
    $directorio->setIdPersona($_REQUEST['idDesempeno']);
    $directorio->setEstado('Abierta');
}
?>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionPeriodoActualizar.php">
  <div class="form-group">
    <label class="form-label mt-4">FECHA INICIO: (*)</label>
    <input type="date" name="fechaInicio" value="<?= $directorio->getFechaInicio() ?>" required class="form-control">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">FECHA FIN: (*)</label>
    <input type="date" name="fechaFin" value="<?= $directorio->getFechaFin() ?>" required class="form-control">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">ESTADO: (*)</label>
    <select class="form-select" name="estado" required>
      <option <?= $directorio->getEstado() == 'Abierta' ? 'selected' : '' ?> value="Abierta">Abierta</option>
      <option <?= $directorio->getEstado() == 'Cerrada' ? 'selected' : '' ?> value="Cerrada">Cerrada</option>
    </select>
  </div>
  <br>
  <input type="hidden" name="id" value="<?= $directorio->getId() ?>">
  <input type="hidden" name="idDesempeno" value="<?= $directorio->getIdPersona() ?>">
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a class="btn btn-danger" href="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionesPeriodo.php&idDesempeno=<?= $directorio->getIdPersona() ?>">Cancelar</a>
</form>
