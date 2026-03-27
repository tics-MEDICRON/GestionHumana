<?php

@session_start();

$EVALUADOR = [
  'JEFE',
  'PAR',
  'SUBALTERNO',
  'AUTOEVALUADOR',
  'CLIENTE',
];

if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new EvaluacionCompetencia('id', $_REQUEST['id']);
} else {
  $directorio = new EvaluacionCompetencia(null, null);
  $directorio->setIdPersona($_REQUEST['idPersona']);
}
$evento = $directorio->getPersona();


?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionCompetenciaActualizar.php" enctype="multipart/form-data">

  <div class="form-group">
    <label class="form-label mt-4">COMPETENCIA: (*)</label>
    <select class="form-select" name="idCompetencia" required id="idCompetencia">
    <option disabled>Seleccione una competencia</option>
    <?php
    $cadenasql = "select id, descripcion from competencia";
    $campo = ConectorBD::ejecutaryQuery($cadenasql);
    var_dump($campo);
    foreach ($campo as $opciones) {
        $idCompetencia = $opciones['id'];
        $descripcion = $opciones['descripcion'];
        $selected = ($idCompetencia == $directorio->getIdCompetencia()) ? 'selected' : '';

        echo "<option value='$idCompetencia' $selected>$descripcion</option>";
    }
    ?>
</select>
  </div>


  <div class="form-group">
    <label class="form-label mt-4">CONDUCTA: (*)</label>
    <input type="text" name="idConducta" value="<?= $directorio->getIdConducta()  ?>" required class="form-control" placeholder="Ingrese la conducta">
  </div>

  <div class="form-group">
    <label class="form-label mt-4">TIPO DE LOGRO: (*)</label>
    <select class="form-select" name="tipoLogro"  required>
      <option>CONDUCTUAL</option>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label mt-4">ADECUACION: (*)</label>
    <select class="form-select" name="adecuacion" value="<?= $directorio->getAdecuacion()  ?>" required>
      <option value="" disabled selected>Seleccione una Adecuacion de Perfil</option>
      <?php
      for ($i = 0; $i <= 100; $i += 5) {
        echo "<option " . (($directorio->getAdecuacion() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
      }
      ?>

    </select>
  </div>



  <div class="form-group">
    <div class="table-responsive">
      <label class="form-label mt-4">EVALUADOR 1: (*)</label>
      <select class="form-select" name="evaluador2" value="<?= $directorio->getEvaluador2()  ?>" required>
        <option disabled>Seleccione un evaluador</option>
        <?php
        echo $directorio->getEvaluador2() . '-----------------';
        for ($i = 0; $i < count($EVALUADOR); $i++) {

          echo "<option " . (($directorio->getEvaluador2() == $EVALUADOR[$i]) ? 'selected' : '') . "  value=" .  $EVALUADOR[$i] . ">" .  $EVALUADOR[$i] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label class="form-label mt-4">CALIFICACIÓN EVALUADOR 1 (60%): (*)</label>
      <select class="form-select" name="evaluadorCal2" value="<?= $directorio->getEvaluadorCal2()  ?>" required>
        <option value="" disabled>Seleccione una Calificacion </option>
        <?php
        for ($i = 0; $i <= 100; $i += 5) {

          echo "<option " . (($directorio->getEvaluadorCal2() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
        }
        ?>

      </select>
    </div>

    <div class="form-group">
      <div class="table-responsive">
        <label class="form-label mt-4">EVALUADOR 2: (*)</label>
        <select class="form-select" name="evaluador3" required>
          <?php
          echo $directorio->getEvaluador3() . '-----------------';
          for ($i = 0; $i < count($EVALUADOR); $i++) {

            echo "<option " . (($directorio->getEvaluador3() == $EVALUADOR[$i]) ? 'selected' : '') . "  value=" .  $EVALUADOR[$i] . ">" .  $EVALUADOR[$i] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label mt-4">CALIFICACIÓN EVALUADOR 2 (30%): (*)</label>
        <select class="form-select" name="evaluadorCal3" value="<?= $directorio->getEvaluadorCal3()  ?>" required>
          <option value="" disabled selected>Seleccione una Calificacion</option>
          <?php
          for ($i = 0; $i <= 100; $i += 5) {

            echo "<option " . (($directorio->getEvaluadorCal3() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label mt-4">AUTOEVALUACIÓN (10%): (*)</label>
        <select class="form-select" name="autoEvaluador" value="<?= $directorio->getAutoEvaluador()  ?>" required>
          <option value="" disabled selected>Seleccione la Autoevaluación</option>
          <?php
          for ($i = 0; $i <= 100; $i += 5) {

            echo "<option " . (($directorio->getAutoEvaluador() == $i) ? 'selected' : '') . "  value=" . $i . ">" . $i . "</option>";
          }
          ?>
        </select>
      </div>
      </br>
      </br>

      <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
      <input type="hidden" name="idDesempeno" value="<?= $directorio->getIdPersona() ?>">
      <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
</form>


<script>
  const idConducta = document.getElementById('idConducta');
  const idCompetencia = document.getElementById('idCompetencia');



  idCompetencia.addEventListener('change', (event) => {
    const competenciaId = event.target.value;

    for (let i = 0; i < idConducta.length; i++) {
      const element = idConducta[i];
      if (i == 0) {
        element.selected = true;
      }


      element.disabled = null;

      if (element.dataset.rc != competenciaId) {
        element.disabled = "disabled";
      }


    }


  })
</script>