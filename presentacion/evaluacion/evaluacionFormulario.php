<?php

@session_start();

$EVALUADOR = [
  'JEFE',
];

$LOGRO = [
  'ESTRATEGICO',
  'OPERATIVO',
];

if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new Desempeno('id', $_REQUEST['id']);
} else {
  $directorio = new Desempeno(null, null);
  $directorio->setIdDesempeno($_REQUEST['idDesempeno']);
  if (isset($_REQUEST['idEvaluacionDesempeno'])) $directorio->setIdEvaluacionDesempeno($_REQUEST['idEvaluacionDesempeno']);
}
$evento = $directorio->getPersona();

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionActualizar.php" enctype="multipart/form-data">

  <div class="form-group">
    <label class="form-label mt-4">LOGRO: (*)</label>
    <input type="text" name="logro" value="<?= $directorio->getLogro()  ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="textHelp" placeholder="Ingrese el logro">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">TIPO DE LOGRO: (*)</label>
    <select class="form-select" name="tipo" required id="tipo">
      <option disabled>Seleccione un tipo de logro</option>
      <?php
      echo $directorio->getTipo() . '-----------------';
      for ($i = 0; $i < count($LOGRO); $i++) {

        echo "<option " . (($directorio->getTipo() == $LOGRO[$i]) ? 'selected' : '') . "  value=" .  $LOGRO[$i] . ">" .  $LOGRO[$i] . "</option>";
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <div class="table-responsive">

      <label class="form-label mt-4">PESO: (*)</label>
      <select class="form-select" name="peso" required id="exampleSelect1">
        <option disabled>Seleccione un peso de logro</option>
        <?php
        for ($i = 0; $i <= 100; $i += 5) {

          echo "<option " . (($directorio->getPeso() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
        }
        ?>

      </select>
    </div>
    
    <div class="form-group">
      <div class="table-responsive">
        <label class="form-label mt-4">EVALUADOR: (*)</label>
        <select class="form-select" name="evaluador" value="<?= $directorio->getEvaluador()  ?>" required id="exampleSelect1">
          <option disabled>Seleccione un evaluador</option>
          

          <?php
          echo $directorio->getEvaluador() . '-----------------';
          for ($i = 0; $i < count($EVALUADOR); $i++) {

            echo "<option " . (($directorio->getEvaluador() == $EVALUADOR[$i]) ? 'selected' : '') . "  value=" .  $EVALUADOR[$i] . ">" .  $EVALUADOR[$i] . "</option>";
          }
          ?>
        </select>
      </div>

      <br>
      <div class="form-group row">
        <label class="form-label mt-2">ADJUNTE SU EVIDENCIA: </label>
        <input class="form-control" type="file" name="evidencia" id="formFile" value="<?= $directorio->getEvidencia()  ?>">
      </div>

      <div class="form-group">
        <label class="form-label mt-4">CALIFICACIÓN: </label>
        <select class="form-select" name="calificacion" required id="exampleSelect1">
          <option disabled>Seleccione una Calificacion</option>
          <?php
          for ($i = 0; $i <= 100; $i += 5) {

            echo "<option " . (($directorio->getCalificacion() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
          }
          ?>
        </select>
      </div>
      </br>
      </br>

      <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
      <input type="hidden" name="idDesempeno" value="<?= $directorio->getIdDesempeno() ?>">
      <input type="hidden" name="idEvaluacionDesempeno" value="<?= $directorio->getIdEvaluacionDesempeno() ?>">
      <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
      <a class="btn btn-danger" href="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno=<?= $directorio->getIdDesempeno() ?>&idEvaluacionDesempeno=<?= $directorio->getIdEvaluacionDesempeno() ?>">Cancelar</a>
</form>

<script>
  var select = document.getElementById('peso');
  select.addEventListener('change',
    function() {
      var selectedOption = this.options[select.selectedIndex];
      console.log(selectedOption.value + ': ' + selectedOption.text);
    });
</script>
