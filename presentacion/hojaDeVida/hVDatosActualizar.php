<?php

@session_start();

$TIPODOCUMENTO = [
  'C.C',
  'C.E',
  'PAS',
];

$TIPOVIVIENDA = [
  'Propia',
  'Arrendada',
  'Familiar',
];

$ESTADO = [
  'Soltero(a)',
  'Casado(a)',
  'Viudo(a)',
  'Union Libre',
];

$ESTRATO = [
  '1',
  '2',
  '3',
  '4',
  '5',
  '6',
  'Rural',
];

$SEXO = [
  'Masculino',
  'Femenino',
  'Otro',
];

$EPS = [
  'ALIANSALUD EPS S.A.','ALIANZA MEDELLIN ANTIOQUIA EPS SAS','ANAS WAYUU EPS','ASMET SALUD EPS SAS','ASOCIACION INDIGENA DEL CAUCA "A.I.C"','Capresoca EPS','Comfenalco valle E.P.S.','Compensar EPS','DUSAKAWI EPS','Empresas Publicas de Medellin departamento Medico','Entidad Promotora de Salud Mallamas','Entidad Promotora de Salud Pijaosalud E','EPS COOSALUD','EPS ECOOPSOS S.A.S','EPS Sura','EPS-S Convida','EPS-S Coosalud','EPS-S Emssanar','EPS-S Mutual Ser','EPS-S Mutual Ser','Famisanar EPS Cafam Colsubsidio','Fondo de Pasivo Social de Ferrocarriles Nacionales de Colombia','NUEVA E.P.S. S.A. MOV','Nueva Promotora de Salud - Nueva EPS','Recaudo SGP Capital Salud','SALUD MIA EPS','Salud Total EPS','Sanitas EPS','Seguros Bolivar EPS','Servicio Occidental de Salud S.A. S.O.S EPS',
];

$PENSIONES = [
  'Colfondos','Colpensiones','PROTECION ','FONDO ALTERNATIVO DE PENSIONES SKANDIA','Porvenir'
];

$CESANTIAS = [
  'Colfondos.','Porvenir.','Protección.','Skandia.','Fondo Nacional del Ahorro.',
];

if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $historia = new HistoriaPrueba('id', $_REQUEST['id']);
} else $historia = new HistoriaPrueba(null, null);

?>

<table class="table table">
  <tr>
    <th scope="col"><img src="presentacion/img/medicronLogo.png" width="250"></th>
    <th scope="col">
      <center>
        <h2></h2>
        <center>
    </th>
    <th scope="col">VERSIÓN: 00</th>
    <th scope="col">EDICION: SEPTIEMBRE DE 2022</th>
    <th scope="col">CODIGO: FR-AST-15</th>
  </tr>
</table>



<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDeVida/hojaDeVidaActualizar.php" enctype='multipart/form-data'>


  <label> Adjunte su Foto: (Subir imagen en formato JPG)</label> <input type="file" name="foto" onchange="mostrarFoto();" required>
  </br>
  <img src="presentacion/candidatos/fotos/" id="foto" height="200" width="200" class="img-thumbnail">
  <br>
  <br>

  <center>
    </br>
    <h4>1. INFORMACION PERSONAL </h4>
    <P>Háblanos un poco más de ti: Explícanos quién eres, de qué formas te puede contactar una empresa y cuál es tu profesión.</P>
  </center>
  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Primer Apellido: (*)</th>
      <th>Segundo Apellido: (*)</th>
      <th>Nombres: (*)</th>
    </tr>
    <tr>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="primerApellido" value="<?= $historia->getPrimerApellido() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="segundoApellido" value="<?= $historia->getSegundoApellido() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nombres" value="<?= $historia->getNombres() ?>" required>
        </div>
      </th>
    </tr>
  </table>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Tipo ID: (*)</th>
      <th>Número: (*)</th>
      <th>Lugar de Expedicion: (*)</th>
      <th>Sexo: (*)</th>
      <th>Nacionalidad: (*)</th>
      <th>Pais: (*)</th>
    </tr>
    <tr>
      <th>
        <div class="col-sm-11">
          <select class="form-select" id="exampleSelect1" name="tipoDocumento" required>
            <?php
            echo $historia->getTipoDocumento() . '-----------------';
            for ($i = 0; $i < count($TIPODOCUMENTO); $i++) {

              echo "<option " . (($historia->getTipoDocumento() == $TIPODOCUMENTO[$i]) ? 'selected' : '') . "  value=" .  $TIPODOCUMENTO[$i] . ">" .  $TIPODOCUMENTO[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="numeroDocumento" value="<?= $historia->getNumeroDocumento() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="lugarExpedicion" value="<?= $historia->getLugarExpedicion() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-11">
        <select class="form-select" name="sexo" required>
            <?php
            echo $historia->getSexo() . '-----------------';
            for ($i = 0; $i < count($SEXO); $i++) {

              echo "<option " . (($historia->getSexo() == $SEXO[$i]) ? 'selected' : '') . "  value=" .  $SEXO[$i] . ">" .  $SEXO[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nacionalidad" value="<?= $historia->getNacionalidad() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="paisExpedicion" value="<?= $historia->getPaisExpedicion() ?>" required>
        </div>
      </th>
    </tr>
  </table>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Fecha de nacimiento: (*)</th>
      <th>Pais: (*)</th>
      <th>Departamento: (*)</th>
      <th>Municipio: (*)</th>
    </tr>
    <tr>
      <th>
        <div class="col-sm-4">
          <input type="text" class="form-control d-none" name="lugarNacimiento" value="<?= $historia->getLugarNacimiento() ?>">
        </div>
        <div class="col-sm-8">
          <input type="date" class="form-control" name="fechaNacimiento" value="<?= $historia->getFechaNacimiento() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="paisNacionalidad" value="<?= $historia->getPaisNacionalidad() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="departamentoNacionalidad" value="<?= $historia->getDepartamentoNacionalidad() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="municipioNacionalidad" value="<?= $historia->getMunicipioNacionalidad() ?>" required>
        </div>
      </th>
    </tr>
  </table>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Estado civil: (*)</th>
      <th>Libreta Militar: </th>
      <th>Número: </th>
      <th>Distrito Militar: </th>
    </tr>
    <tr>
      <th>
        <div class="col-sm-10">
          <select class="form-select" name="estadoCivil" required>
            <?php
            echo $historia->getEstadoCivil() . '-----------------';
            for ($i = 0; $i < count($ESTADO); $i++) {

              echo "<option " . (($historia->getEstadoCivil() == $ESTADO[$i]) ? 'selected' : '') . "  value=" .  $ESTADO[$i] . ">" .  $ESTADO[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      <th>
        <div class="col-sm-10">
        <select class="form-control" name="libretaMilitar">
            <option value="si" <?= ($historia->getLibretaMilitar() === 'si') ? 'selected' : '' ?>>Si</option>
            <option value="no" <?= ($historia->getLibretaMilitar() === 'no') ? 'selected' : '' ?>>No</option>
        </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="numeroLibreta" value="<?= $historia->getNumeroLibreta() ?>">
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="distrito" value="<?= $historia->getDistrito() ?>">
        </div>
      </th>
    </tr>
  </table>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Pais: (*)</th>
      <th>Departamento: (*)</th>
      <th>Municipio: (*)</th>
      
    </tr>
    <tr>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="paisResidencia" value="<?= $historia->getPaisResidencia() ?>" required>
        </div>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="departamentoResidencia" value="<?= $historia->getDepartamentoResidencia() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="municipioResidencia" value="<?= $historia->getMunicipioResidencia() ?>" required>
        </div>
      </th>
     
    </tr>
  </table>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Direccion Residencial: (*)</th>
      <th>Barrio: (*)</th>
      <th>Tipo de Vivienda: (*)</th>
      <th>Estrato Socioeconomico: (*)</th>
      <th>Telefono Fijo: (*)</th>
      <th>Celular: (*)</th>
    </tr>
    <tr>
    <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="direccionResidencia" value="<?= $historia->getDireccionResidencia() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="barrio" value="<?= $historia->getBarrio() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <select class="form-select" name="tipoVivienda" required>
            <?php
            echo $historia->getTipoVivienda() . '-----------------';
            for ($i = 0; $i < count($TIPOVIVIENDA); $i++) {

              echo "<option " . (($historia->getTipoVivienda() == $TIPOVIVIENDA[$i]) ? 'selected' : '') . "  value=" .  $TIPOVIVIENDA[$i] . ">" .  $TIPOVIVIENDA[$i] . "</option>";
            }
            ?>
          </select>

        </div>
      <th>
        <div class="col-sm-10">
          <select class="form-select" name="estratoEconomico" required>
            <?php
            echo $historia->getEstratoEconomico() . '-----------------';
            for ($i = 0; $i < count($ESTRATO); $i++) {

              echo "<option " . (($historia->getEstratoEconomico() == $ESTRATO[$i]) ? 'selected' : '') . "  value=" .  $ESTRATO[$i] . ">" .  $ESTRATO[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="telResidencia" value="<?= $historia->getTelResidencia() ?>" required>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="celular" value="<?= $historia->getCelular() ?>" required>
        </div>
      </th>
    </tr>
  </table>

  <br>
  <br>

  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">E-mail: (*)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email" value="<?= $historia->getEmail() ?>" required>
    </div>
  </div>

  <br>
  <br>

  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Numero de Persona a Cargo: (*)</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" name="personasCargo" value="<?= $historia->getPersonasCargo() ?>" required>
    </div>
  </div>

  <br>
  <br>

  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Grupo Sanguineo: (*)</label>
    <div class="col-sm-9">
    <select class="form-select" name="grupoSanguineo" id="" required>
      <option value="A+" <?php if ( $historia->getGrupoSanguineo() === 'A+') echo 'selected'; ?>>A+</option>
      <option value="O+" <?php if ( $historia->getGrupoSanguineo() === 'O+') echo 'selected'; ?>>O+</option>
      <option value="B+" <?php if ( $historia->getGrupoSanguineo() === 'B+') echo 'selected'; ?>>B+</option>
      <option value="AB+" <?php if ( $historia->getGrupoSanguineo() === 'AB+') echo 'selected'; ?>>AB+</option>
      <option value="A-" <?php if ( $historia->getGrupoSanguineo() === 'A-') echo 'selected'; ?>>A-</option>
      <option value="O-" <?php if ( $historia->getGrupoSanguineo() === 'O-') echo 'selected'; ?>>O-</option>
      <option value="B-" <?php if ( $historia->getGrupoSanguineo() === 'B-') echo 'selected'; ?>>B-</option>
      <option value="AB-" <?php if ( $historia->getGrupoSanguineo() === 'AB-') echo 'selected'; ?>>AB-</option>
  </select>
    </div>
  </div>

  <br>
  <br>

  <table style="width: 100%;">
    <tr>
      <th>Afiliacion a</th>
      <th>EPS: (*)</th>
      <th>Fondo de Pension: (*)</th>
      <th>Cesantias: (*)</th>
    </tr>

    <tr>
      <th>
      </th>
      <th>
        <div class="col-sm-10">
        <select class="form-select" name="eps" required>
            <?php
            echo $historia->getEps() . '-----------------';
            for ($i = 0; $i < count($EPS); $i++) {

              echo "<option " . (($historia->getEps() == $EPS[$i]) ? 'selected' : '') . "  value=" .  $EPS[$i] . ">" .  $EPS[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
        <select class="form-select" name="fondoPension" required>
            <?php
            echo $historia->getFondoPension() . '-----------------';
            for ($i = 0; $i < count($PENSIONES); $i++) {

              echo "<option " . (($historia->getFondoPension() == $PENSIONES[$i]) ? 'selected' : '') . "  value=" .  $PENSIONES[$i] . ">" .  $PENSIONES[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
      <th>
        <div class="col-sm-10">
        <select class="form-select" name="cesantias" required>
            <?php
            echo $historia->getCesantias() . '-----------------';
            for ($i = 0; $i < count($CESANTIAS); $i++) {

              echo "<option " . (($historia->getCesantias() == $CESANTIAS[$i]) ? 'selected' : '') . "  value=" .  $CESANTIAS[$i] . ">" .  $CESANTIAS[$i] . "</option>";
            }
            ?>
          </select>
        </div>
      </th>
    </tr>
  </table>
  <br>
  <br>

  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">Adjunte su cedula: (*)</label>
    <input class="form-control" name="cc" type="file" id="formFile" value="<?= $historia->getCC() ?>" required>
  </div>

  </br>
  </br>

  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">Adjunte su Libreta militar: </label>
    <input class="form-control" name="libreta" type="file" id="formFile" value="<?= $historia->getLibreta() ?>">
  </div>

  </br>
  </br>

  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">Adjunte su certificado de Fondo de Pension: </label>
    <input class="form-control" name="archivoPension" type="file" id="formFile" value="<?= $historia->getFondoPension() ?>">
  </div>

  </br>
  </br>

  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">Adjunte su certificado de Afiliacion a la EPS: </label>
    <input class="form-control" name="archivoEps" type="file" id="formFile" value="<?= $historia->getAfiliacionEps() ?>">
  </div>

  </br>
  </br>
  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">Adjunte su certificado de Cesantias: </label>
    <input class="form-control" name="archivoCesantias" type="file" id="formFile" value="<?= $historia->getArchivoCesantias() ?>">
  </div>
  </br>
  </br>

  <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado de rethus: </label>
      <input class="form-control" name="archivorethus" type="file" id="formFile">
    </div>
    </br>
  </br>
    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado Bancario: </label>
      <input class="form-control" name="archivobancaria" type="file" id="formFile">
    </div>
    </br>
  </br>
    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado Rut: </label>
      <input class="form-control" name="archivorut" type="file" id="formFile">
    </div>

  </br>
  </br>


  <input type="hidden" name="id" value="<?= $historia->getId() ?>">
  <input type="hidden" name="idAnterior" value="<?= $historia->getId() ?>">
  <button type="submit" name="accion" class="btn btn-primary" value="<?= $titulo ?>"><?= $titulo ?></button>
</form>



<script type="text/javascript">
  function mostrarFoto() {
    var lector = new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function() {
      document.getElementById("foto").src = lector.result;
    };
  }
</script>