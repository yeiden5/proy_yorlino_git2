<?php
session_start();
require_once("../../conexion.php");

$cod_paciente = $_REQUEST["cod_paciente"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$sql_check = $db->Prepare("SELECT COUNT(*) as count
                           FROM consultas
                           WHERE cod_paciente = ?");
$rs_check = $db->GetOne($sql_check, array($cod_paciente));

if ($rs_check['count'] == 0) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_cod_usuario"];
    $rs1 = $db->AutoExecute("pacientes", $reg, "UPDATE", "cod_paciente='".$cod_paciente."'");
    
    if ($rs1) {
        header("Location: pacientes.php");
        exit();
    } else {
        $mensaje = "ERROR AL ELIMINAR EL PACIENTE";
    }
} else {
    $mensaje = "NO SE PUEDE ELIMINAR EL PACIENTE PORQUE TIENE REGISTROS RELACIONADOS";
}

require_once("../../libreria_menu.php");
echo "<div class='mensaje'>";
echo "<h1>".$mensaje."</h1>";
echo "<a href='pacientes.php'>
        <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
      </a>";
echo "</div>";

echo "</body>
      </html>";
?>