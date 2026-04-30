<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$filtro = '';
$buscar = isset($buscar) ? $buscar : '';


if (isset($buscador)) {
    if (is_numeric($buscar)) {
        $filtro = "fecha like '%" . strtoupper($buscar) . "%'";
    } else {
        $filtro = "fecha like '%" . strtoupper($buscar) . "%'";
    }
}

$lista = '';

if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
    $resultado = Novedades::getListaEnObjetos("concat(nombres,' ',apellidos) = '$USUARIO'", null);
    for ($i = 0; $i < count($resultado); $i++) {
        $academica = $resultado[$i];
        $lista .= '<tr>';
        $lista .= "<td>{$academica->getId()}</td>";
        $lista .= "<td>{$academica->getIdPersona()}</td>";
        $lista .= "<td>{$academica->getFecha()}</td>";
        $lista .= "<td><a href='presentacion/novedades/documentos/{$academica->getEvaluacionPdf()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
        $lista .= '</tr>';
    }
} else {

    $resultado = Novedades::getListaEnObjetos($filtro, null);
    for ($i = 0; $i < count($resultado); $i++) {
        $academica = $resultado[$i];
        $lista .= '<tr>';
        $lista .= "<td>{$academica->getId()}</td>";
        $lista .= "<td>{$academica->getIdPersona()}</td>";
        $lista .= "<td>{$academica->getFecha()}</td>";
        $lista .= "<td><a href='presentacion/novedades/documentos/{$academica->getEvaluacionPdf()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
        $lista .= '<td>';
        $lista .= "<a href='principal.php?CONTENIDO=presentacion/novedades/novedadesFormulario.php&accion=Modificar&id={$academica->getId()}'><img src='presentacion/img/modificar.png'></a>";
        $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$academica->getId()})'>";
        $lista .= '</td>';
        $lista .= '</tr>';
    }
}


?>
</br>

<center>
    <h1>NOVEDADES </h1>
    <center>

        </br>

        <?php
        if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
        } else {

            echo "<form method='post' action'principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php' class='d-flex'>
           <input class='form-control me-sm-3' type='text' name='buscar' id='buscar' placeholder='Buscador' title='Ingrese el valor que desea buscar y presione el boton buscar'>
            <button class='btn btn-secondary my-2 my-sm-0' name='buscador' id='buscador' type='submit' value='Buscar'>Buscar</button>
    </form>";
        }
        ?>


        <br>

        <?php
        if ($USUARIO->getTipoEnObjeto() == "Colaborador") {

            echo "<table class='table table-hover'>
        <tr class='table-success'>
          <th scope='row'>ID</th>
          <td>PERSONA</td>
          <td>FECHA</td>
          <td>NOVEDADES</td>
        </tr>
        $lista
        
        </table>";
        } else {
            echo "<table class='table table-hover'>
        <tr class='table-success'>
        <th scope='row'>ID</th>
        <td>PERSONA</td>
        <td>FECHA</td>
        <td>NOVEDADES</td>
        
        <th><a href='principal.php?CONTENIDO=presentacion/novedades/novedadesFormulario.php'><img src='presentacion/img/adicionar.png'></a></th>
        </tr>

      
        $lista
        
        </table>";
        }


        ?>


        <!--<button type="button" name="accion" class="btn btn-success" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciasLaborales.php'" >Siguiente</button>
<button type="button" class="btn btn-danger" value="Cancelar" onclick="location='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarComplementaria.php'">Cancelar</button>  -->

        <script type="text/javascript">
            function eliminar(id) {
                var respuesta = confirm("Esta seguro de eliminar este registro");
                if (respuesta) location = "principal.php?CONTENIDO=presentacion/novedades/novedadesActualizar.php&accion=Eliminar&id=" + id;
            }
        </script>
