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
$historia = new HistoriaPrueba('id', $_REQUEST['id']);
} else $historia = new HistoriaPrueba(null, null);
// print_r($evento);

$lista = '';
$resultado = HistoriaPrueba::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);



if ($resultado) {

  for ($i = 0; $i < count($resultado); $i++) {

    $historia = $resultado[$i];
  
    $lista .= "<form name='formulario' method='post' action='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizar.php&accion=Modificar&id={$historia->getId()}'' enctype='multipart/form-data'>";
  
    $lista .= "<td><img class='fotos' src='presentacion/hojaDeVida/fotos/{$historia->getFoto()}' width='155' height='155' /></td><td>Es su responsabilidad de mantener sus datos actualizados de acurdo a los cambios presentados en su informacion personal, academica y laboral</td>";
  
    $lista .= "<table style='width: 100%;'>";
    $lista .= "<tr>";
    $lista .= "<th>Primer Apellido: (*)</th>";
    $lista .= "<th>Segundo Apellido: (*)</th>";
    $lista .= "<th>Nombres: (*)</th>";
    $lista .= "</tr>";
    $lista .= "<tr>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='primerApellido' value='{$historia->getPrimerApellido()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='segundoApellido'  value='{$historia->getSegundoApellido()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='nombres' value='{$historia->getNombres()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "</tr>";
    $lista .= "</table>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= "<table style='width: 100%;'>";
    $lista .= "<tr>";
    $lista .= "<th>Tipo ID: (*)</th>";
    $lista .= "<th>Número: (*)</th>";
    $lista .= "<th>Lugar de Expedicion: (*)</th>";
    $lista .= "<th>Sexo: (*)</th>";
    $lista .= "<th>Pais: (*)</th>";
    $lista .= "</tr>";
    $lista .= "<tr>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-8'>";
    $lista .= "<input type='text' class='form-control' name='tipoDocumento' value='{$historia->getTipoDocumento()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
  
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='numeroDocumento' value='{$historia->getNumerodocumento()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='lugarExpedicion' value='{$historia->getLugarExpedicion()}'  readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
  
    $lista .= "<div class='col-sm-8'>";
    $lista .= "<input type='text' class='form-control' name='sexo' value='{$historia->getSexo()}' readonly='readonly'>";
    $lista .= "</div>";
    
    $lista .= " </th>";
    
    $lista .= " <th>";
    $lista .= " <div class='col-sm-8'>";
    $lista .= " <input type='text' class='form-control' name='paisExpedicion' value='{$historia->getPaisExpedicion()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " </tr>";
    $lista .= " </table>";
    $lista .= " <br>";
    $lista .= " <br>";
    $lista .= " <table style='width: 100%;'>";
    $lista .= " <tr>";
    $lista .= " <th>Fecha y lugar de nacimiento: (*)</th>";
    $lista .= " <th>Pais: (*)</th>";
    $lista .= " <th>Departamento: (*)</th>";
    $lista .= " <th>Municipio: (*)</th>";
    $lista .= " </tr>";
    $lista .= " <tr>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='date' class='form-control' name='fechaNacimiento' value='{$historia->getFechaNacimiento()}' readonly='readonly'><input type='text' class='form-control' name='lugarNacimiento' value='{$historia->getLugarNacimiento()}' readonly='readonly'>";
    $lista .= " </div>";
  
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='paisNacionalidad' value='{$historia->getPaisNacionalidad()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='departamentoNacionalidad' value='{$historia->getDepartamentoNacionalidad()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='municipioNacionalidad' value='{$historia->getMunicipioNacionalidad()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " </tr>";
    $lista .= " </table>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= " <table style='width: 100%;'>";
    $lista .= "<tr>";
    $lista .= " <th>Estado civil: (*)</th>";
    $lista .= " <th>Libreta Militar: </th>";
    $lista .= " <th>Número: </th>";
    $lista .= " <th>Distrito Militar: </th>";
    $lista .= " </tr>";
    $lista .= " <tr>";
    $lista .= " <th>";
  
    $lista .= " <div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='estadoCivil' value='{$historia->getEstadoCivil()}'  readonly='readonly'>";
    $lista .= "</div>";
  
    
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='libretaMilitar'  value='{$historia->getLibretaMilitar()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='libretaNumero'  value='{$historia->getNumeroLibreta()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='distrito'  value='{$historia->getDistrito()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " </tr>";
    $lista .= " </table>";
  
    $lista .= " <br>";
    $lista .= " <br>";
  
    $lista .= " <table style='width: 100%;'>";
    $lista .= " <tr>";
    $lista .= " <th>Pais: (*)</th>";
    $lista .= " <th>Departamento: (*)</th>";
    $lista .= " <th>Municipio: (*)</th>";
    $lista .= " <th>Direccion Residencial: (*)</th>";
    $lista .= " </tr>";
    $lista .= " <tr>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='paisResidencia' value='{$historia->getPaisResidencia()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='departamentoResidencia' value='{$historia->getDepartamentoResidencia()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='municipioResidencia' value='{$historia->getMunicipioResidencia()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= " <div class='col-sm-10'>";
    $lista .= " <input type='text' class='form-control' name='direccionResidencia' value='{$historia->getDireccionResidencia()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </th>";
    $lista .= " </tr>";
    $lista .= " </table>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= "<table style='width: 100%;'>";
    $lista .= "<tr>";
    $lista .= "<th>Barrio: (*)</th>";
    $lista .= "<th>Tipo de Vivienda: (*)</th>";
    $lista .= "<th>Estrato Socioeconomico: (*)</th>";
    $lista .= "<th>Telefono Fijo: (*)</th>";
    $lista .= "<th>Celular: (*)</th>";
    $lista .= "</tr>";
    $lista .= "<tr>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='barrio'  value='{$historia->getBarrio()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-8'>";
    $lista .= "<input type='text' class='form-control' name='tipoVivienda' value='{$historia->getTipoVivienda()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
  
    $lista .= "<th>";
  
    $lista .= "<div class='col-sm-8'>";
    $lista .= "<input type='text' class='form-control' name='estratoEconomico' value='{$historia->getEstratoEconomico()}' readonly='readonly'>";
    $lista .= "</div>";
    
    $lista .= " </th>";
    $lista .= " <th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='telResidencia' value='{$historia->getTelResidencia()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='celular' value='{$historia->getCelular()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "</tr>";
    $lista .= "</table>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= " <div class='form-group row'>";
    $lista .= " <label for='staticEmail' class='col-sm-3 col-form-label'>E-mail: (*)</label>";
    $lista .= " <div class='col-sm-9'>";
    $lista .= " <input type='text' class='form-control' name='email' value='{$historia->getEmail()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </div>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= " <div class='form-group row'>";
    $lista .= " <label for='staticEmail' class='col-sm-3 col-form-label'>Numero de Persona a Cargo: (*)</label>";
    $lista .= "  <div class='col-sm-9'>";
    $lista .= "  <input type='number' class='form-control' name='personasCargo' value='{$historia->getPersonasCargo()}' readonly='readonly'>";
    $lista .= " </div>";
    $lista .= " </div>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='staticEmail' class='col-sm-3 col-form-label'>Grupo Sanguineo: (*)</label>";
    $lista .= "<div class='col-sm-9'>";
    $lista .= "<input type='text' class='form-control' name='grupoSanguineo' value='{$historia->getGrupoSanguineo()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</div>";
  
    $lista .= "<br>";
    $lista .= "<br>";
  
    $lista .= "<table style='width: 100%;'>";
    $lista .= " <tr>";
    $lista .= "<th>Afiliacion a</th>";
    $lista .= "<th>EPS: (*)</th>";
    $lista .= "<th>Fondo de Pension: (*)</th>";
    $lista .= "<th>Cesantias: (*)</th>";
    $lista .= "</tr>";
  
    $lista .= "<tr>";
    $lista .= "<th>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='eps' value='{$historia->getEps()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='fondoPension' value='{$historia->getFondoPension()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= "</th>";
    $lista .= "<th>";
    $lista .= "<div class='col-sm-10'>";
    $lista .= "<input type='text' class='form-control' name='cesantias' value='{$historia->getCesantias()}' readonly='readonly'>";
    $lista .= "</div>";
    $lista .= " </th>";
    $lista .= "</tr>";
    $lista .= "</table>";
    $lista .= "<br>";
    $lista .= "<br>";
  
    
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su cédula: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getCC()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";
  
    $lista .= "</br>";
    $lista .= "</br>";
  
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su Libreta militar: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getFileLibretaMilitar()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";
  
    $lista .= "</br>";
    $lista .= "</br>";
  
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de Fondo de Pension: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getArchivoPension()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";
  
    $lista .= "</br>";
    $lista .= "</br>";
  
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de Afiliacion a la EPS: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getAfiliacionEps()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
  
    $lista .= "</div>";
  
    $lista .= "</br>";
    $lista .= "</br>";
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de Cesantias: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getArchivoCesantias()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";
    
    $lista .= "</br>";
    $lista .= "</br>";
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de Rethus: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getArchivoRethus()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";

    $lista .= "</br>";
    $lista .= "</br>";
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de Cuenta Bancaria: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getArchivoBancaria()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";

    $lista .= "</br>";
    $lista .= "</br>";
    $lista .= "<div class='form-group row'>";
    $lista .= "<label for='formFile' class='form-label mt-2'>Archivo adjunto de su certificado de RUT: </label>";
    $lista .= "<a href='presentacion/hojaDeVida/documentos/{$historia->getArchivoRut()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a>";
    $lista .= "</div>";
  
    $lista .= "</br>";
    $lista .= "</br>";
    $lista .= "<button type='submit' name='accion' class='btn btn-primary' value='Modificar'>Actualizar Datos</button>";
    $lista .= "   ";
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/familiarFormulario.php&idPersona={$historia->getNumeroDocumento()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";
  
    $lista .= "<input type='hidden' name='idAnterior' value='{$historia->getId()}'>";
    $lista .= "</form>";
  }
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
          <h2>FORMATO HOJA DE VIDA</h2>
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
            <input type="text" class="form-control" name="primerApellido" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="segundoApellido" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nombres" required>
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
        
        <th>Pais: (*)</th>
      </tr>
      <tr>
        <th>
          <div class="col-sm-11">
            <select class="form-select" name="tipoDocumento" required>
              <option>C.C</option>
              <option>C.E</option>
              <option>PAS</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="numeroDocumento" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="lugarExpedicion" required>
          </div>
        </th>
        <th>
          <div class="col-sm-11">
            <select class="form-select" name="sexo" required>
              <option>Masculino</option>
              <option>Femenino</option>
              <option>Otro</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control d-none" name="nacionalidad" >
          </div>
        </th>
        <th>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="paisExpedicion" required>
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
            <input type="text" class="form-control d-none" name="lugarNacimiento">
          </div>
          <div class="col-sm-8">
            <input type="date" class="form-control" name="fechaNacimiento" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="paisNacionalidad" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="departamentoNacionalidad" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="municipioNacionalidad" required>
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
              <option>Soltero(a)</option>
              <option>Casado(a)</option>
              <option>Viudo(a)</option>
              <option>Union Libre</option>
            </select>
          </div>
        <th>
          <div class="col-sm-10">
            <select name="libretaMilitar" class="form-select" id="">
              <option value="si">si</option>
              <option value="no">no</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="numeroLibreta">
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="distrito">
          </div>
        </th>
      </tr>
    </table>

    <br>
    <br>

    <table style="width: 100%;">
      <tr>
        <th>Pais: </th>
        <th>Departamento: </th>
        <th>Municipio: </th>
        
      </tr>
      <tr>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="paisResidencia" >
          </div>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="departamentoResidencia" >
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="municipioResidencia" >
          </div>
        </th>
       
      </tr>
    </table>

    <br>
    <br>

    <table style="width: 100%;">
      <tr>
      <th>Direccion Residencial: </th>
        <th>Barrio: (*)</th>
        <th>Tipo de Vivienda: (*)</th>
        <th>Estrato Socioeconomico: (*)</th>
        <th>Telefono Fijo: (*)</th>
        <th>Celular: (*)</th>
      </tr>
      <tr>
      <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="direccionResidencia" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="barrio" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <select class="form-select" name="tipoVivienda" required>
              <option>Propia</option>
              <option>Arrendada</option>
              <option>Familiar</option>
            </select>
          </div>
        <th>
          <div class="col-sm-10">
            <select class="form-select" name="estratoEconomico" required>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>Rural</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="telResidencia" required>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="celular" required>
          </div>
        </th>
      </tr>
    </table>

    <br>
    <br>

    <div class="form-group row">
      <label for="staticEmail" class="col-sm-3 col-form-label">E-mail: (*)</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="email" required>
      </div>
    </div>

    <br>
    <br>

    <div class="form-group row">
      <label for="staticEmail" class="col-sm-3 col-form-label">Numero de Persona a Cargo: (*)</label>
      <div class="col-sm-9">
        <input type="number" class="form-control" name="personasCargo" required>
      </div>
    </div>

    <br>
    <br>

    <div class="form-group row">
      <label for="staticEmail" class="col-sm-3 col-form-label">Grupo Sanguineo: (*)</label>
      <div class="col-sm-9">
        <select class="form-select" name="grupoSanguineo" id="" required>
          <option value="A+">A+</option>
          <option value="O+">O+</option>
          <option value="B+">B+</option>
          <option value="AB+">AB+</option>
          <option value="A-">A-</option>
          <option value="O-">O-</option>
          <option value="B-">B-</option>
          <option value="AB-">AB-</option>
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
            <select class="form-select" name="eps" id="" required>
              <option value="ALIANSALUD EPS S.A.">ALIANSALUD EPS S.A.</option>
              <option value="ALIANZA MEDELLIN ANTIOQUIA EPS SAS">ALIANZA MEDELLIN ANTIOQUIA EPS SAS</option>
              <option value="ANAS WAYUU EPS">ANAS WAYUU EPS</option>
              <option value="ASMET SALUD EPS SAS">ASMET SALUD EPS SAS</option>
              <option value="ASOCIACION INDIGENA DEL CAUCA "A.I.C"">ASOCIACION INDIGENA DEL CAUCA "A.I.C"</option>
              <option value="Capresoca EPS">Capresoca EPS</option>
              <option value="Comfenalco valle E.P.S.">Comfenalco valle E.P.S.</option>
              <option value="Compensar EPS">Compensar EPS</option>
              <option value="DUSAKAWI EPS">DUSAKAWI EPS</option>
              <option value="Empresas Publicas de Medellin departamento Medico">Empresas Publicas de Medellin departamento Medico</option>
              <option value="Entidad Promotora de Salud Mallamas">Entidad Promotora de Salud Mallamas</option>
              <option value="Entidad Promotora de Salud Pijaosalud E">Entidad Promotora de Salud Pijaosalud E</option>
              <option value="EPS COOSALUD">EPS COOSALUD</option>
              <option value="EPS ECOOPSOS S.A.S">EPS ECOOPSOS S.A.S</option>
              <option value="EPS Sura">EPS Sura</option>
              <option value="EPS-S Convida">EPS-S Convida</option>
              <option value="EPS-S Coosalud">EPS-S Coosalud</option>
              <option value="EPS-S Emssanar">EPS-S Emssanar</option>
              <option value="EPS-S Mutual Ser">EPS-S Mutual Ser</option>
              <option value="EPS-S Mutual Ser">EPS-S Mutual Ser</option>
              <option value="Famisanar EPS Cafam Colsubsidio">Famisanar EPS Cafam Colsubsidio</option>
              <option value="Fondo de Pasivo Social de Ferrocarriles Nacionales de Colombia">Fondo de Pasivo Social de Ferrocarriles Nacionales de Colombia</option>
              <option value="NUEVA E.P.S. S.A. MOV">NUEVA E.P.S. S.A. MOV</option>
              <option value="Nueva Promotora de Salud - Nueva EPS">Nueva Promotora de Salud - Nueva EPS</option>
              <option value="Recaudo SGP Capital Salud">Recaudo SGP Capital Salud</option>
              <option value="SALUD MIA EPS">SALUD MIA EPS</option>
              <option value="Salud Total EPS">Salud Total EPS</option>
              <option value="Sanitas EPS">Sanitas EPS</option>
              <option value="Seguros Bolivar EPS">Seguros Bolivar EPS</option>
              <option value="Servicio Occidental de Salud S.A. S.O.S EPS">Servicio Occidental de Salud S.A. S.O.S EPS</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <select name="fondoPension" class="form-select" id="">
              <option value="Colfondos">Colfondos</option>
              <option value="Colpensiones">Colpensiones</option>
              <option value="PROTECION ">PROTECION </option>
              <option value="FONDO ALTERNATIVO DE PENSIONES SKANDIA">FONDO ALTERNATIVO DE PENSIONES SKANDIA</option>
              <option value="Porvenir">Porvenir</option>
            </select>
          </div>
        </th>
        <th>
          <div class="col-sm-10">
            <select class="form-select" name="cesantias" required>
              <option value="Colfondos">Colfondos</option>
              <option value="Porvenir">Porvenir</option>
              <option value="Protección">Protección</option>
              <option value="Skandia">Skandia</option>
              <option value="Fondo Nacional del Ahorro">Fondo Nacional del Ahorro</option>
            </select>
          </div>
        </th>
      </tr>
    </table>
    <br>
    <br>

    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su cedula: (*)</label>
      <input class="form-control" name="cc" type="file" id="formFile" required>
    </div>

    </br>
    </br>

    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su Libreta militar: </label>
      <input class="form-control" name="libreta" type="file" id="formFile">
    </div>

    </br>
    </br>

    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado de Fondo de Pension: </label>
      <input class="form-control" name="archivoPension" type="file" id="formFile">
    </div>

    </br>
    </br>

    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado de Afiliacion a la EPS: </label>
      <input class="form-control" name="archivoEps" type="file" id="formFile">
    </div>

    </br>
    </br>
    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado de Cesantias: </label>
      <input class="form-control" name="archivoCesantias" type="file" id="formFile">
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
      <label for="formFile" class="form-label mt-2">Adjunte su Constancia de cuenta bancaria: </label>
      <input class="form-control" name="archivobancaria" type="file" id="formFile">
    </div>
    </br>
    </br>
    <div class="form-group row">
      <label for="formFile" class="form-label mt-2">Adjunte su certificado de RUT: </label>
      <input class="form-control" name="archivorut" type="file" id="formFile">
    </div>

    </br>
    </br>


    <input type="hidden" name="id" value="<?= $historia->getId() ?>">
    <input type="hidden" name="idAnterior" value="<?= $historia->getId() ?>">
    <button type="submit" name="accion" class="btn btn-primary" value="<?= $titulo ?>"><?= $titulo ?></button>
    <!--<button type="button" name="accion" class="btn btn-success" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarFamiliar.php'" >Siguiente</button>-->
    <!--<button type="button" class="btn btn-danger" value="Cancelar" onclick="location='principal.php?CONTENIDO=presentacion/inicio.php'">Cancelar</button>-->
    <!--<input type="button" id="form_button" value="Cancelar" onclick="location='principal.php?CONTENIDO=presentacion/empresa/empresaFormulario.php'"  >-->
  </form>
<?php
} else {
?>

  <table class="table table">
    <tr>
      <th scope="col"><img src="presentacion/img/medicronLogo.png" width="250"></th>
      <th scope="col">
        <center>
          <h2>FORMATO HOJA DE VIDA</h2>
          <center>
      </th>
      <th scope="col">VERSIÓN: 00</th>
      <th scope="col">EDICION: SEPTIEMBRE DE 2022</th>
      <th scope="col">CODIGO: FR-AST-15</th>
    </tr>
  </table>

  <center>
    </br>
    <h4>1. INFORMACION PERSONAL </h4>
    <P>Háblanos un poco más de ti: Explícanos quién eres, de qué formas te puede contactar una empresa y cuál es tu profesión.</P>

  </center>
  <?= $lista ?>
<?php
}
?>

<script type="text/javascript">
  function mostrarFoto() {
    var lector = new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function() {
      document.getElementById("foto").src = lector.result;
    };
  }
</script>