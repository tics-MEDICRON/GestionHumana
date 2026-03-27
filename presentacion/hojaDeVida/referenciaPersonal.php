<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idPersona']);


$lista = '';
$resultado = ReferenciaPersonal::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $academica = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$academica->getNombre()}</td>";
  $lista .= "<td>{$academica->getParentesco()}</td>";
  $lista .= "<td>{$academica->getOcupacion()}</td>";
  $lista .= "<td>{$academica->getTelefono()}</td>";
  $lista .= "<td><a href='presentacion/hojaDeVida/documentos/{$academica->getArchivo()}' target='_blank' title='Ver su evidencia'><img src='presentacion/img/pdf.png'></a></td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonalFormulario.php&accion=Modificar&id={$academica->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
  $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$academica->getId()})'>";
  $lista .= '</td>';
  $lista .= '</tr>';
}
?>

<center>
  </br>
  <h4>9. REFERENCIAS PERSONALES </h4>
  <P>¡Bien! Ahora vamos a añadir tu información de tus referencias personales.</P>
  <p>(Minimo registrar dos referencias personales)</p>
</center>

<br>


<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">NOMBRE</th>
    <td>PARENTESCO</td>
    <td>OCUPACION</td>
    <td>TELEFONO</td>
    <td>ARCHIVO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonalFormulario.php&idPersona=<?= $persona->getIdentificacion()?> "><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<?php
  if($lista != ""){
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciasLaborales.php&idPersona=".$persona->getIdentificacion()."'><button type='button' class='btn btn-success'>Atrás</button></a>";
    echo "<a href='#' class='p-2 finishData'><button type='button' name='accion' class='btn btn-danger'>Finalizar</button></a>";
  }
?>

<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonalActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }


  let buttonFinish = document.querySelector(".finishData");
  buttonFinish.addEventListener("click",finishEvent);

  function finishEvent() {
    alert("Ahora puedes generar tu hoja de vida");
    
      setTimeout(() => {
      location = "principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php";
      }, 1000);
    
    
    
  }
</script>


