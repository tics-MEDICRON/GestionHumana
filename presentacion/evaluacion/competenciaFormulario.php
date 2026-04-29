<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
if ($USUARIO->getTipoEnObjeto() != 'Administrador') {
    header('location: principal.php?CONTENIDO=presentacion/inicio.php');
    exit;
}

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $competencia = new Competencia('id', $_REQUEST['id']);
} else {
    $competencia = new Competencia(null, null);
}
?>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/competenciaActualizar.php">
  <div class="form-group">
    <label class="form-label mt-4">DESCRIPCION: (*)</label>
    <textarea name="descripcion" required class="form-control" rows="4"><?= $competencia->getDescripcion() ?></textarea>
  </div>
  <div class="form-group">
    <label class="form-label mt-4">CRITERIO: (*)</label>
    <textarea name="criterio" required class="form-control" rows="4"><?= $competencia->getCriterio() ?></textarea>
  </div>
  <br>
  <input type="hidden" name="id" value="<?= $competencia->getId() ?>">
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a class="btn btn-danger" href="principal.php?CONTENIDO=presentacion/evaluacion/competencias.php">Cancelar</a>
</form>
