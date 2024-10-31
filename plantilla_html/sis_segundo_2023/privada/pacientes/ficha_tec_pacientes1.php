<?php
require_once("../../conexion.php");

$cod_paciente = $_REQUEST["cod_paciente"] ?? '';

$sql = $db->Prepare("SELECT *
                     FROM pacientes
                     WHERE cod_paciente = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($cod_paciente));

if ($rs) {
    // Generar el resultado HTML
    echo "<table width='100%' border='0'>
            <tr>                                   
              <td><h1>FICHA TÉCNICA DE PACIENTES</h1></td>
            </tr>
        </table>";
    echo "<center>
          <table border='1' cellspacing='0'>";
    foreach ($rs as $fila) {  
        echo "<tr>
           <th align='right'>Nombres</th><th>:</th>
           <td><input type='text' name='nombres' value='".$fila['nombres']."' disabled=''></td>
         </tr>
         <tr>
           <th align='right'>Apellido Paterno</th><th>:</th>
           <td><input type='text' name='ap' value='".$fila['ap']."' disabled=''></td>
         </tr>
         <tr>
           <th align='right'>Apellido Materno</th><th>:</th>
           <td><input type='text' name='am' value='".$fila['am']."' disabled=''></td>
         </tr>
         <tr>
           <th align='right'>Dirección</th><th>:</th>
           <td><input type='text' name='direccion' value='".$fila['direccion']."' disabled=''></td>
         </tr>
         <tr>
           <th align='right'>Teléfono</th><th>:</th>
           <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled=''></td>
         </tr>
         <tr>
           <th align='right'>Género</th><th>:</th>
           <td>";
           echo $fila['genero'] == 'F' ? "FEMENINO" : "MASCULINO";
           echo "</td>
         </tr>
      </table>
    </center>";
}
?>
