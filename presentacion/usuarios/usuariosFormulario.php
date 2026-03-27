<?php


@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = '';
if (isset($_REQUEST['identificacion'])) {
  $titulo = 'Modificar';
  $persona = new Persona('identificacion', $_REQUEST['identificacion']);
} else $persona = new Persona(null, null);

//print_r($agenda);
?>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/usuarios/usuariosActualizar.php">

  <div class="form-group">
    <label for="exampleSelect1" class="form-label mt-4">ROL DE USUARIO: (*)</label>
    <select class="form-select" name="tipo" required id="tipo">
      <option disabled>Seleccione un rol de usuario</option>
        <option>Administrador</option>
        <option>Colaborador</option>
        <option>Contrato de Servicio</option> 
      </select>
  </div>

  </br>
  </br>

  <input type="hidden" name="identificacion" value="<?= $persona->getIdentificacion() ?>" />
  <input type="hidden" name="identificacionAnterior" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
</form>