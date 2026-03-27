<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$desempeno = new Desempeno(null, null);

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
      $lista .= '<td>';
      $lista .= '</td>';
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
      $lista .= '<td>';
      $lista .= "<a href='principal.php?CONTENIDO=presentacion/usuarios/usuariosFormulario.php&accion=Modificar&identificacion={$persona->getIdentificacion()}' title='Cambiar rol de usuario'><img src='presentacion/img/roles.png'></a> ";
      $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno={$persona->getIdentificacion()}' title='Evaluacion de Desempeño'><img src='presentacion/img/evaluaciones.png'></a> ";
      $lista .= "<a href='principal.php?CONTENIDO=presentacion/pdf/pdf.php&idDesempeno={$persona->getIdentificacion()}' title='Descargar Evaluacion de Desempeño' ><img src='presentacion/img/descargar.png'></a> ";
      //$lista .= "<a href='principal.php?CONTENIDO=presentacion/usuarios/permisoFormulario.php&identificacion={$persona->getIdentificacion()}' title='Permiso temporal'><img src='presentacion/img/permisoTemporal.png'></a> ";
      $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$persona->getIdentificacion()})' title='Eliminar'>";
      $lista .= '</td>';
      $lista .= '</tr>';
  }
}


?>

<center>
  <h1>LISTA DE USUARIOS </h1>
</center>

</br>
</br>

<?php
if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
} else {
  echo "<form method='post' action='principal.php?CONTENIDO=presentacion/usuarios/usuarios.php' class='d-flex'>
  <input class='form-control me-sm-3' type='text' name='buscar' id='buscar' placeholder='Buscador' title='Ingrese el valor que desea buscar y presione el boton buscar'>
  <button class='btn btn-secondary my-2 my-sm-0' name='buscador' id='buscador' type='submit' value='Buscar'>Buscar</button>
</form>";
}
?>

<br>



<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">IDENTIFICACION</th>
    <td>NOMBRES</td>
    <td>APELLIDOS</td>
    <td>TIPO</td>
    <td>CARGO</td>
    <td></td>
  </tr>
  <?= $lista ?>

</table>

<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/usuarios/usuariosActualizar.php&accion=Eliminar&identificacion="+id;
  }
</script>