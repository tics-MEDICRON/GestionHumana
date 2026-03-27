<?php

@session_start();

$NIVEL = [
  'PRIMARIA',
  'SECUNDARIA',
  'TECNICO',
  'TECNOLOGICO',
  'PROFESIONAL',
  'ESPECIALIZACION',
  'MAGISTER',
  'OTRO',
];

$stateProcess = [
  'PROCESO',
  'CULMINADO',
];


if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new Academica('id', $_REQUEST['id']);
} else $directorio = new Academica(null, null);

$persona=new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/academicaActualizar.php" enctype="multipart/form-data">

  <div class="form-group">
    <label class="form-label mt-4">NIVEL: (*)</label>
    <select class="form-select" name="nivel" >
    <?php
          echo $directorio->getNivel() . '-----------------';
          for ($i = 0; $i < count($NIVEL); $i++) {

            echo "<option " . (($directorio->getNivel() == $NIVEL[$i]) ? 'selected' : '') . "  value=" .  $NIVEL[$i] . ">" .  $NIVEL[$i] . "</option>";
          }
          ?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">TITULO OBTENIDO: (*)</label>
    <input type="text" name="titulo" value="<?= $directorio->getTitulo()  ?>" required class="form-control" placeholder="Ingrese sus titulos obtenidos">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">INSTITUCION QUE OTORGA EL TITULO: (*)</label>
    <input type="text" name="institucion" value="<?= $directorio->getInstitucion()  ?>" required class="form-control" placeholder="Ingrese la institucion que otorgo el titulo">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">NO SEMESTRES CURSADOS: (*)</label>
    <input type="number" name="numSemestres" value="<?= $directorio->getnumSemestres()  ?>" required class="form-control" placeholder="Ingrese el número de semestres cursados">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">ESTADO: (*)</label>
    <select class="form-select" name="estado" >
    <?php
          echo $directorio->getEstado() . '-----------------';
          for ($i = 0; $i < count($stateProcess); $i++) {
            echo "<option " . (($directorio->getEstado() == $stateProcess[$i]) ? 'selected' : '') . "  value=" .  $stateProcess[$i] . ">" .  $stateProcess[$i] . "</option>";
          }
          ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">FECHA DE GRADO: (*)</label>
    <input type="date" name="fechaGrado" value="<?= $directorio->getfechaGrado()  ?>" required class="form-control">
  </div>
 

  <br>
  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">ADJUNTE SU TITULO: (*)</label>
    <input class="form-control" type="file" name="archivo" required id="formFile" value="<?= $directorio->getArchivo()  ?>">
  </div>

  
  
  </br>
  </br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/academica.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>
</form>