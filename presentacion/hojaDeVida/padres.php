<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idPersona']);

$lista = '';
$resultado = Familia::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $agenda = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$agenda->getNombre()}</td>";
  $lista .= "<td>{$agenda->getFechaNacimiento()}</td>";
  $lista .= "<td>{$agenda->getOcupacion()}</td>";
  $lista .= "<td>{$agenda->getTelefono()}</td>";
  $lista .= "<td>{$agenda->getParentesco()}</td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/padresFormulario.php&accion=Modificar&id={$agenda->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
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
    <td>NOMBRES Y APELLIDOS</td>
    <td>FECHA DE NACIMIENTO</td>
    <td>OCUPACIÓN</td>
    <td>TELEFONO</td>
    <td>PARENTESCO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/padresFormulario.php&idPersona=<?= $persona->getIdentificacion()?> "><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<?php
  if($lista != ""){
    echo "<a class='m-2' href='principal.php?CONTENIDO=presentacion/hojaDeVida/familiarFormulario.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-danger'>Atrás</button></a>";
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/contactoEmergencia.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";
  }
?>


  



<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/padresActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>