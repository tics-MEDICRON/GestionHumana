<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$desempeno = new Desempeno(null, null);
$filtro = '';
$buscar = isset($buscar) ? $buscar : '';

if (isset($buscador)) {
  if (is_numeric($buscar)) {
    $filtro = "identificacion like '%" . strtoupper($buscar) . "%' or nombres = $buscar or apellidos =  $buscar";
  } else {
    $filtro = "identificacion like '%" . strtoupper($buscar) . "%' or nombres like '%" . strtoupper($buscar) . "%' or apellidos like '%" . strtoupper($buscar) . "%'";
  }
}
$lista = '';
if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
  $resultado = Persona::getListaEnObjetos("concat(nombres,' ',apellidos) = '$USUARIO'", null);
  for ($i = 0; $i < count($resultado); $i++) {
    $persona = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$persona->getIdentificacion()}</td>";
    $lista .= "<td>{$persona->getNombres()}</td>";
    $lista .= "<td>{$persona->getApellidos()}</td>";
    $lista .= "<td>{$persona->getTipo()}</td>";
    $lista .= "<td>{$persona->getCargo()}</td>";
    $lista .= '<td></td>';
    $lista .= '</tr>';
  }
} else {
  $resultado = Persona::getListaEnObjetos($filtro, null);
  for ($i = 0; $i < count($resultado); $i++) {
    $persona = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$persona->getIdentificacion()}</td>";
    $lista .= "<td>{$persona->getNombres()}</td>";
    $lista .= "<td>{$persona->getApellidos()}</td>";
    $lista .= "<td>{$persona->getTipo()}</td>";
    $lista .= "<td>{$persona->getCargo()}</td>";
    $lista .= '<td class="table-actions">';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/usuarios/usuariosFormulario.php&accion=Modificar&identificacion={$persona->getIdentificacion()}' title='Cambiar rol de usuario'><img src='presentacion/img/roles.png' alt='Cambiar rol'></a> ";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionesPeriodo.php&idDesempeno={$persona->getIdentificacion()}' title='Evaluaciones por periodo'><img src='presentacion/img/evaluaciones.png' alt='Evaluaci&oacute;n'></a> ";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/pdf/pdf.php&idDesempeno={$persona->getIdentificacion()}' title='Descargar evaluaci&oacute;n de desempe&ntilde;o'><img src='presentacion/img/descargar.png' alt='Descargar evaluaci&oacute;n'></a> ";
    $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$persona->getIdentificacion()})' title='Eliminar' alt='Eliminar'>";
    $lista .= '</td>';
    $lista .= '</tr>';
  }
}
?>

<div class="page-shell">
  <div class="page-header">
    <div>
      <span class="page-kicker">Usuarios</span>
      <h1 class="page-title">Lista de usuarios</h1>
      <p class="page-subtitle">Consulta la informaci&oacute;n principal y administra las acciones disponibles para cada perfil.</p>
    </div>
  </div>

  <?php if ($USUARIO->getTipoEnObjeto() != "Colaborador") { ?>
    <form method="post" action="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php" class="toolbar-search">
      <div class="toolbar-search__field">
        <i class="ion ion-md-search"></i>
        <input class="form-control" type="text" name="buscar" id="buscar" placeholder="Buscar por identificaci&oacute;n, nombre o apellido" title="Ingresa el valor que deseas buscar y presiona el bot&oacute;n buscar">
      </div>
      <button class="toolbar-search__button" name="buscador" id="buscador" type="submit" value="Buscar">Buscar</button>
    </form>
  <?php } ?>

  <div class="data-table-card">
    <div class="table-responsive">
      <table class="table table-hover app-table">
        <thead>
          <tr>
            <th scope="col">Identificaci&oacute;n</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Tipo</th>
            <th scope="col">Cargo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?= $lista ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro?");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/usuarios/usuariosActualizar.php&accion=Eliminar&identificacion=" + id;
  }
</script>
