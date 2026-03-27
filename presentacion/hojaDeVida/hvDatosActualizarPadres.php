<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$resultado = Familia::getListaEnObjetos(null, null);
for ($i = 0; $i < count($resultado); $i++) {
  $agenda = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$agenda->getId()}</td>";
  $lista .= "<td>{$agenda->getNombre()}</td>";
  $lista .= "<td>{$agenda->getFechaNacimiento()}</td>";
  $lista .= "<td>{$agenda->getOcupacion()}</td>";
  $lista .= "<td>{$agenda->getParentesco()}</td>";

  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/padresFormulario.php&accion=Modificar&id={$agenda->getId()}'><img src='presentacion/img/modificar.png'></a>";
  $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$agenda->getId()})'>";
  $lista .= '</td>';
  $lista .= '</tr>';
}
?>

<table class="table table" border="5">
  <tr>
    <th scope="col"><img src="presentacion/img/medicronLogo.png" width="250"></th>
    <th scope="col">
      <center>
        <h2>HOJA DE VIDA PERSONAL</h2>
        <center>
    </th>
    <th scope="col">VERSIÓN: 00</th>
    <th scope="col">EDICION: SEPTIEMBRE DE 2022</th>
    <th scope="col">CODIGO: FR-AST-15</th>
  </tr>
</table>

<center>

  </br>
  <h4>3. INFORMACIÓN HIJOS Y/O PADRES </h4>
  <P>¡Bien! Ahora vamos a añadir tu información familiar</P>
</center>

<br>


<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">Id</th>
    <td>NOMBRES Y APELLIDOS</td>
    <td>FECHA DE NACIMIENTO</td>
    <td>OCUPACIÓN</td>
    <td>PARENTESCO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/padresFormulario.php"><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/padresActualizar.php">
  <div class="form-group row">
    <label for="staticEmail" required class="col-sm-2 col-form-label">En caso de emergencia avisar a:: </label>
    <div class="col-sm-2">
      <input type="text" required class="form-control" id="staticEmail" value="">
    </div>
    <label for="staticEmail" required class="col-sm-2 col-form-label">Teléfono: </label>
    <div class="col-sm-2">
      <input type="text" required class="form-control" id="staticEmail" value="">
    </div>
    <label for="staticEmail" required class="col-sm-2 col-form-label">Parentesco: </label>
    <div class="col-sm-2">
      <input type="text" required class="form-control" id="staticEmail" value="">
    </div>
  </div>
  </br>
</form>
<button type="button" name="accion" class="btn btn-success" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarAcademica.php'">Siguiente</button>
<button type="button" class="btn btn-danger" value="Cancelar" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarFamiliar.php'">Cancelar</button>
<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/padresActualizar.php&accion=Eliminar&id=" + id;
  }
</script>