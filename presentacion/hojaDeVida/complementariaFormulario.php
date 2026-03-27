<?php

$NIVEL = [
  'PROCESO',
  'CULMINADO',
];

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new Complementaria('id', $_REQUEST['id']);
} else $directorio = new Complementaria(null, null);

$persona=new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/complementariaActualizar.php" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label mt-4">CURSOS O DIPLOMADO: </label>
    <input type="text" name="cursos" value="<?= $directorio->getCursos()  ?>" required class="form-control" placeholder="Ingrese el nombre los cursos o diplomados realizados">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">INSTITUCIÓN: </label>
    <input type="text" name="institucion" value="<?= $directorio->getInstitucion()  ?>" required class="form-control" placeholder="Ingrese el nombre de la institución en la que realizo el curso o el diplomado">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">FECHA DE REALIZACIÓN: </label>
    <input type="date" name="year" value="<?= $directorio->getYear()  ?>" required class="form-control" placeholder="Ingrese la fecha en el que realizo el curso o el diplomado">
  </div>

  <div class="form-group">
    <label class="form-label mt-4">ESTADO: (*)</label>
    <select class="form-select" name="estado" >
    <?php
          echo $directorio->getEstado() . '-----------------';
          for ($i = 0; $i < count($NIVEL); $i++) {

            echo "<option " . (($directorio->getEstado() == $NIVEL[$i]) ? 'selected' : '') . "  value=" .  $NIVEL[$i] . ">" .  $NIVEL[$i] . "</option>";
          }
          ?>
    </select>
  </div>
  </br>
  <div class="form-group row">
    <label m-label mt-2">ADJUNTE SU EVIDENCIA DEL CURSO DIPLOMA:</label>
    <input class="form-control" type="file" name="archivo" id="formFile" value="<?= $directorio->getArchivo()  ?>">
  </div>
  </br>
  </br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarComplementaria.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>
</form>