<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
if ($USUARIO->getTipoEnObjeto() != 'Administrador') {
    header('location: principal.php?CONTENIDO=presentacion/inicio.php');
    exit;
}

$filtro = '';
$buscar = isset($buscar) ? $buscar : '';
if (isset($buscador)) {
    $filtro = "descripcion like '%" . strtoupper($buscar) . "%' or criterio like '%" . strtoupper($buscar) . "%'";
}

$lista = '';
$resultado = Competencia::getLIstaEnObjetos($filtro, 'descripcion');
for ($i = 0; $i < count($resultado); $i++) {
    $competencia = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$competencia->getDescripcion()}</td>";
    $lista .= "<td>{$competencia->getCriterio()}</td>";
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/competenciaFormulario.php&accion=Modificar&id={$competencia->getId()}'><img src='presentacion/img/modificar.png'></a>";
    $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$competencia->getId()})'>";
    $lista .= '</td>';
    $lista .= '</tr>';
}
?>

<div class="page-shell">
  <div class="page-header">
    <div>
      <span class="page-kicker">Configuracion</span>
      <h1 class="page-title">Competencias</h1>
      <p class="page-subtitle">Administra el catalogo usado en las evaluaciones por competencia.</p>
    </div>
  </div>

  <form method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/competencias.php" class="toolbar-search">
    <div class="toolbar-search__field">
      <i class="ion ion-md-search"></i>
      <input class="form-control" type="text" name="buscar" id="buscar" placeholder="Buscar competencia o criterio">
    </div>
    <button class="toolbar-search__button" name="buscador" id="buscador" type="submit" value="Buscar">Buscar</button>
  </form>

  <div class="mb-3">
    <a class="btn btn-success" href="principal.php?CONTENIDO=presentacion/evaluacion/competenciaFormulario.php">Adicionar competencia</a>
  </div>

  <div class="data-table-card">
    <div class="table-responsive">
      <table class="table table-hover app-table">
        <thead>
          <tr>
            <th>Descripcion</th>
            <th>Criterio</th>
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
    var respuesta = confirm("Esta seguro de eliminar esta competencia?");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/evaluacion/competenciaActualizar.php&accion=Eliminar&id=" + id;
  }
</script>
