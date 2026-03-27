<?php

$TIPO = [
  'Administrador',
  'Colaborador',
];

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = '';
if (isset($_REQUEST['identificacion'])) {
  $titulo = 'Permiso';
  $persona = new Persona('identificacion', $_REQUEST['identificacion']);
  $desempeno = new Desempeno(null, null);
}
//print_r($agenda);
?>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/usuarios/usuariosActualizar.php">

  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">INICIO DEL PERMISO: (*)</label>
    <input type="datetime-local" name="inicio" value="<?= $persona->getInicio()  ?>" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese un telefono">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">FIN DEL PERMISO: (*)</label>
    <input type="datetime-local" name="fin" value="<?= $persona->getFin()  ?>" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese un telefono">
  </div>

  <div class="form-group">
    <label for="exampleSelect1" class="form-label mt-4">EVALUADOR 1: (*)</label>
    <select class="form-select" name="idPersonaJefe" value="<?= $desempeno->getIdPersonaJefe()  ?>" required>
      <?php

      $cadenasql = "select identificacion, concat(persona.nombres,' ',persona.apellidos) as nombres FROM persona";
      $campo = ConectorBD::ejecutaryQuery($cadenasql);

      ?>
      <?php foreach ($campo as $opciones) { ?>
        <option value="<?php echo $opciones['identificacion'] ?>"><?php echo $opciones['nombres'] ?></option>
      <?php
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleSelect1" class="form-label mt-4">EVALUADOR 2: (*)</label>
    <select class="form-select" name="idPersonaPar" value="<?= $desempeno->getIdPersonaPar()  ?>" required>
      <?php

      $cadenasql = "select identificacion, concat(persona.nombres,' ',persona.apellidos) as nombres FROM persona";
      $campo = ConectorBD::ejecutaryQuery($cadenasql);

      ?>
      <?php foreach ($campo as $opciones) { ?>
        <option value="<?php echo $opciones['identificacion'] ?>"><?php echo $opciones['nombres'] ?></option>
      <?php
      }
      ?>
    </select>
  </div>


  </br>
  </br>

  <input type="hidden" name="identificacion" value="<?= $persona->getIdentificacion() ?>" />
  <input type="hidden" name="identificacionAnterior" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
</form>