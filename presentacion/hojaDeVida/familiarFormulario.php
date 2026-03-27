<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$persona = new Persona('identificacion', $_REQUEST['idPersona']);

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $historia = new Familiar('id', $_REQUEST['id']);
} else $historia = new Familiar(null, null);


$lista = '';
$resultado = Familiar::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);

for ($i = 0; $i < count($resultado); $i++) {

  $historia = $resultado[$i];

  $lista .= "<form name='formulario' method='post' action='principal.php?CONTENIDO=presentacion/hojaDeVida/familiarDatosActualizar.php&accion=Modificar&id={$historia->getId()}'' enctype='multipart/form-data'>";
  $lista .= "<div class='form-group row'>";
  $lista .= "<label for='staticEmail' class='col-sm-2 col-form-label' >Nombre del Cónyuge ó Compañera(o): </label>";
  $lista .= "<div class='col-sm-2'>";
  $lista .= "<input type='text' name='nombre' readonly='readonly' class='form-control' id='staticEmail' value='{$historia->getNombre()}' required>";
  $lista .= "</div>";
  $lista .= "<label for='staticEmail' class='col-sm-2 col-form-label'>Numero de Identificacion: </label>";
  $lista .= "<div class='col-sm-2'>";
  $lista .= "<input type='text' name='identificacion' readonly='readonly' class='form-control' id='staticEmail' value='{$historia->getIdentificacion()}' required>";
  $lista .= "</div>";
  $lista .= "<label for='staticEmail' class='col-sm-2 col-form-label'>Número de Celular: </label>";
  $lista .= "<div class='col-sm-2'>";
  $lista .= "<input type='text' name='celular' readonly='readonly' class='form-control' id='staticEmail' value='{$historia->getCelular()}' required>";
  $lista .= "</div>";
  $lista .= "</div>";
  $lista .= "</br>";
  $lista .= "<div class='form-group row'>";
  $lista .= "</br>";
  $lista .= "</br>";
  $lista .= "<label for='staticEmail' class='col-sm-2 col-form-label'>Fecha de Nacimiento: </label>";
  $lista .= "<div class='col-sm-4'>";
  $lista .= "<input type='date' name='fechaNacimiento' readonly='readonly' class='form-control' id='staticEmail' value='{$historia->getFechaNacimiento()}' required>";
  $lista .= "</div>";
  $lista .= "<label for='staticEmail' class='col-sm-2 col-form-label'>Profesion u Ocupación: </label>";
  $lista .= "<div class='col-sm-4'>";
  $lista .= "<input type='text' name='ocupacion' readonly='readonly' class='form-control' id='staticEmail' value='{$historia->getOcupacion()}' required>";
  $lista .= "</div>";
  $lista .= "</div>";
  $lista .= "</br>";
  $lista .= "</br>";
  
  $lista .= '<button type="submit" name="accion" class="btn btn-primary m-2" value="Modificar">Actualizar Datos</button>';
  $lista .= "<a class='m-2' href='principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-danger'>Atrás</button></a>";
  $lista .= "<a class='m-2' href='principal.php?CONTENIDO=presentacion/hojaDeVida/padres.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";
  $lista .= "<input type='hidden' name='idPersona' value='{$persona->getIdentificacion()}'>";

  $lista .= "</form>";
}
?>
<?php
if ($lista === "") {
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
  </br>
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
    <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>">
    <input type="hidden" name="idAnterior" value="<?= $historia->getId() ?>">
    <button type="submit" name="accion" class="btn btn-primary" value="<?= $titulo ?>"><?= $titulo ?></button >
    <a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hojaVidaFormulario.php&idPersona=<?=$persona->getIdentificacion()?>' class='m-2'><button type='button' class='btn btn-danger '>Atrás</button></a>
    <a href='principal.php?CONTENIDO=presentacion/hojaDeVida/padres.php&idPersona=<?=$persona->getIdentificacion()?>'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>
  </form>
<?php
} else {
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
    </br>
  </center>
  <?= $lista ?>
<?php
}
?>