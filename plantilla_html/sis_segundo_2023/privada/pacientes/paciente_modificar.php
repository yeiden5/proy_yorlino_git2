<?php 
session_start(); 
require_once("../../conexion.php"); 
require_once("../../libreria_menu.php");

// Verificar si se ha enviado un código de paciente
$cod_paciente = isset($_REQUEST["cod_paciente"]) ? $_REQUEST["cod_paciente"] : null;

if (!$cod_paciente) {
    // Si no se proporciona un código de paciente, redirigir a la lista de pacientes
    header("Location: pacientes.php");
    exit;
}

$sql = $db->Prepare("SELECT *
                     FROM pacientes
                     WHERE cod_paciente = ?
                     AND estado <> 'X'                        
                    ");
$rs = $db->GetAll($sql, array($cod_paciente));

if (!$rs) {
    // Si no se encuentra el paciente, redirigir a la lista de pacientes
    header("Location: pacientes.php");
    exit;
}

$paciente = $rs[0];

echo "<!DOCTYPE html> 
<html> 
<head>     
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>     
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src='../js/validacion.js'></script>
    <script src='../js/nuevos.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
</head> 
<body>     
    <div class='formulario-responsive'>         
        <h1>MODIFICAR PACIENTE</h1>         
        <form id='pacienteModificarForm'>
            <input type='hidden' name='cod_paciente' value='".$paciente['cod_paciente']."'>
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <label for='nombre'><b>(*) Nombre</b></label>                     
                    <input type='text' id='nombre' name='nombre' value='".$paciente['nombre']."' required maxlength='25'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='ap'><b>Apellido Paterno</b></label>                     
                    <input type='text' id='ap' name='ap' value='".$paciente['ap']."' maxlength='25'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='am'><b>Apellido Materno</b></label>                     
                    <input type='text' id='am' name='am' value='".$paciente['am']."' maxlength='50'>                 
                </div>             
            </div>             
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <label for='direccion'><b>(*) Dirección</b></label>                     
                    <input type='text' id='direccion' name='direccion' value='".$paciente['direccion']."' required maxlength='50'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='telefono'><b>(*) Teléfono</b></label>                     
                    <input type='text' id='telefono' name='telefono' value='".$paciente['telefono']."' required maxlength='15'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='fec_nac'><b>(*) Fecha de Nacimiento</b></label>                     
                    <input type='date' id='fec_nac' name='fec_nac' value='".$paciente['fec_nac']."' required>                 
                </div>             
            </div>             
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <button type='submit' class='boton'>MODIFICAR PACIENTE</button>                 
                </div>             
            </div>         
        </form>         
        <div id='mensaje'></div>     
    </div>      
</body> 
</html>"; 
?>