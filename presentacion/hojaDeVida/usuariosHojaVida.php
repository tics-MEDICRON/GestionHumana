<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
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
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona={$persona->getIdentificacion()}' title='Hoja de Vuda'><img src='presentacion/img/hojaVida.png'></a>";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/pdf/hojaDeVida.php&idPersona={$persona->getIdentificacion()}' title='Descargar Hoja de Vida' ><img src='presentacion/img/descargar.png'></a>";
    $lista .= '</td>';
    $lista .= '</tr>';
  }
}else if($USUARIO->getTipoEnObjeto() == "Contrato de Servicio"){
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
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona={$persona->getIdentificacion()}' title='Hoja de Vuda'><img src='presentacion/img/hojaVida.png'></a> ";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/pdf/hojaDeVida.php&idPersona={$persona->getIdentificacion()}' title='Descargar Hoja de Vida' ><img src='presentacion/img/descargar.png'></a> ";
    $lista .= '</td>';
    $lista .= '</tr>';
  }
}else {
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
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona={$persona->getIdentificacion()}' title='Hoja de Vuda'><img src='presentacion/img/hojaVida.png'></a>";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/pdf/hojaDeVida.php&idPersona={$persona->getIdentificacion()}' title='Descargar Hoja de Vida' ><img src='presentacion/img/descargar.png'></a>";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/editUser.php&idPersona={$persona->getIdentificacion()}' title='Editar Usuario' ><img src='presentacion/img/editUser.png'></a>";
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
  echo "<form method='post' action='principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php' class='d-flex'>
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
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/usuarios/usuariosActualizar.php&accion=Eliminar&id=" + id;
  }
</script>
