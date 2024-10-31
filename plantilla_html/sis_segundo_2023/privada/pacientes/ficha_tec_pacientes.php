<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

echo "<html>
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_pacientes.js'></script>
         <script type='text/javascript' src='js/mostrar.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";

echo "
<!----- INICIO BUSCADOR ------------>
    <center>
    <h1>FICHA TECNICA PACIENTES</h1>
    <form action='#' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Apellido Paterno</b><br/>
          <input type='text' name='ap' value='' size='10' onkeyup='buscar_pacientes()'>
        </th>
        <th>
          <b>Apellido Materno</b><br/>
          <input type='text' name='am' value='' size='10' onkeyup='buscar_pacientes()'>
        </th>
        <th>
          <b>Nombres</b><br/>
          <input type='text' name='nombre' value='' size='10' onkeyup='buscar_pacientes()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
<!----- FIN BUSCADOR ------------>";

echo "<div id='pacientes1'></div>";

contarRegistros($db, "pacientes");
paginacion("pacientes.php?");

$sql = $db->Prepare("SELECT *
                     FROM pacientes
                     WHERE estado <> 'X' 
                     ORDER BY cod_paciente DESC    
                     LIMIT ? OFFSET ?                  
                    ");
$rs = $db->GetAll($sql, array($nElem, $regIni));

if ($rs) {
    echo "<center>
              <h1>LISTADO DE PACIENTES</h1>
              <b><a href='paciente_nuevo.php'>Nuevo Paciente>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['nombre']."</td>
                <td>".$fila['direccion']."</td>
                <td>".$fila['telefono']."</td>
                <td align='center'>
                  <form name='formModif".$fila["cod_paciente"]."' method='post' action='paciente_modificar.php'>
                    <input type='hidden' name='cod_paciente' value='".$fila['cod_paciente']."'>
                    <a href='javascript:document.formModif".$fila['cod_paciente'].".submit();' title='Modificar Paciente'>
                      Modificar>>
                    </a>
                  </form>
                </td>
                <td align='center'>  
                  <form name='formElimi".$fila["cod_paciente"]."' method='post' action='paciente_eliminar.php'>
                    <input type='hidden' name='cod_paciente' value='".$fila["cod_paciente"]."'>
                    <a href='javascript:document.formElimi".$fila['cod_paciente'].".submit();' title='Eliminar Paciente' onclick='javascript:return(confirm(\"Desea realmente Eliminar al Paciente: ".$fila["nombre"]." ?\"))';> 
                      Eliminar>>
                    </a>
                  </form>                        
                </td>
             </tr>";
        $b = $b + 1;
    }
    echo "</table>
          </center>";
    mostrar_paginacion();
}

echo "</body>
      </html>";
?>
