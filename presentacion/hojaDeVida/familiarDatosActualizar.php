<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $historia = new Familiar('id', $_REQUEST['id']);
} else $historia = new Familiar(null, null);

?>


<table class="table table">
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
  <h4>2. INFORMACION FAMILIAR </h4>
  <P>¡Bien! Ahora vamos a añadir tu información familiar</P>
</center>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDeVida/familiarActualizar.php">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre del Cónyuge ó Compañera(o): </label>
    <div class="col-sm-2">
      <input type="text" name="nombre" class="form-control" id="staticEmail" value="<?= $historia->getNombre() ?>" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Numero de Identificacion: </label>
    <div class="col-sm-2">
      <input type="text" name="identificacion" class="form-control" id="staticEmail" value="<?= $historia->getIdentificacion() ?>" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Número de Celular: </label>
    <div class="col-sm-2">
      <input type="text" name="celular" class="form-control" id="staticEmail" value="<?= $historia->getCelular() ?>" required>
    </div>
  </div>
  </br>
  <div class="form-group row">

    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de Nacimiento: </label>
    <div class="col-sm-4">
      <input type="date" name="fechaNacimiento" class="form-control" id="staticEmail" value="<?= $historia->getFechaNacimiento() ?>" required>
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label">Profesion u Ocupación: </label>
    <div class="col-sm-4">
      <input type="text" name="ocupacion" class="form-control" id="staticEmail" value="<?= $historia->getOcupacion() ?>" required>
    </div>
  </div>
  </br>
  </br>
  <input type="hidden" name="id" value="<?= $historia->getId() ?>">
  <input type="hidden" name="idPersona" value="<?= $_REQUEST['idPersona'] ?>">
  <button type="submit" name="accion" class="btn btn-primary" value="<?= $titulo ?>"><?= $titulo ?></button>
</form>