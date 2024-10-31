<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Ficha Técnica Pacientes</title>
    <script src='../js/nuevos.js'></script>
<script src='../js/validacion.js'></script> 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='../js/formularios.js'></script>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
</head>
<body>
    <div class='contenedor-centrado'>
        <h1>FICHA TÉCNICA PACIENTES</h1>";

// Consulta para obtener todos los pacientes
contarRegistros($db, "pacientes");
paginacion("pacientes.php?");

$sql = $db->Prepare("SELECT *
                     FROM pacientes
                     WHERE estado <> 'X' 
                     ORDER BY ap, am, nombre    
                     LIMIT ? OFFSET ?                  
                    ");
$rs = $db->GetAll($sql, array($nElem, $regIni));

if ($rs) {
    echo "<div class='listado-pacientes'>
            <h2>LISTADO DE PACIENTES</h2>
            <p><a href='paciente_nuevo.php' class='boton'>Nuevo Paciente>>>></a></p>
            <table class='listado'>
                <tr>                                   
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th>
                    <th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
                </tr>";
    
    $b = $regIni + 1;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['nombre']." ".$fila['ap']." ".$fila['am']."</td>
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
        $b++;
    }
    echo "</table>
          </div>";
    mostrar_paginacion();
} else {
    echo "<p>No se encontraron pacientes.</p>";
}

echo "</div>
</body>
</html>";
?>