<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$persona = new Persona('identificacion', $_REQUEST['idDesempeno']);
$resultado = EvaluacionDesempeno::getListaEnObjetos("idPersona='{$persona->getIdentificacion()}'", 'fechaInicio desc');
$lista = '';

for ($i = 0; $i < count($resultado); $i++) {
    $evaluacion = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$evaluacion->getFechaInicio()}</td>";
    $lista .= "<td>{$evaluacion->getFechaFin()}</td>";
    $lista .= "<td>{$evaluacion->getEstado()}</td>";
    $lista .= "<td>{$evaluacion->getResultadoDesempeno()}%</td>";
    $lista .= "<td>{$evaluacion->getResultadoCompetencia()}%</td>";
    $lista .= "<td>{$evaluacion->getResultadoFinal()}%</td>";
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno={$persona->getIdentificacion()}&idEvaluacionDesempeno={$evaluacion->getId()}' title='Abrir evaluacion'><img src='presentacion/img/evaluaciones.png'></a>";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionPeriodoFormulario.php&accion=Modificar&id={$evaluacion->getId()}&idDesempeno={$persona->getIdentificacion()}' title='Modificar periodo'><img src='presentacion/img/modificar.png'></a>";
    $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$evaluacion->getId()})'>";
    $lista .= '</td>';
    $lista .= '</tr>';
}
?>

<div class="page-shell">
  <div class="page-header">
    <div>
      <span class="page-kicker">Desempeno</span>
      <h1 class="page-title">Evaluaciones por periodo</h1>
      <p class="page-subtitle"><?= $persona->getNombres() ?> <?= $persona->getApellidos() ?> - <?= $persona->getIdentificacion() ?></p>
    </div>
  </div>

  <div class="mb-3">
    <a class="btn btn-success" href="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionPeriodoFormulario.php&idDesempeno=<?= $persona->getIdentificacion() ?>">Adicionar periodo</a>
    <a class="btn btn-secondary" href="principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno=<?= $persona->getIdentificacion() ?>">Ver registros sin periodo</a>
    <a class="btn btn-secondary" href="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php">Volver</a>
  </div>

  <div class="data-table-card">
    <div class="table-responsive">
      <table class="table table-hover app-table">
        <thead>
          <tr>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Estado</th>
            <th>Desempeno</th>
            <th>Competencia</th>
            <th>Final</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody><?= $lista ?></tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este periodo? Se eliminaran sus logros y competencias asociados.");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/evaluacion/evaluacionPeriodoActualizar.php&accion=Eliminar&idDesempeno=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>
