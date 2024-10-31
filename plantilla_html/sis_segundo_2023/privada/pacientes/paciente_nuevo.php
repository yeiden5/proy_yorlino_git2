<?php 
session_start(); 
require_once("../../conexion.php"); 
require_once("../../libreria_menu.php");  

echo "<!DOCTYPE html> 
<html> 
<head>     
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src='../js/validacion.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
</head> 
<body>     
    <div class='formulario-responsive'>         
        <h1>INSERTAR NUEVO PACIENTE</h1>         
        <form id='pacienteNuevoForm'>             
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <label for='nombre'><b>(*) Nombre</b></label>                     
                    <input type='text' id='nombre' name='nombre' required maxlength='25'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='ap'><b>Apellido Paterno</b></label>                     
                    <input type='text' id='ap' name='ap' maxlength='25'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='am'><b>Apellido Materno</b></label>                     
                    <input type='text' id='am' name='am' maxlength='50'>                 
                </div>             
            </div>             
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <label for='direccion'><b>(*) Dirección</b></label>                     
                    <input type='text' id='direccion' name='direccion' required maxlength='50'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='telefono'><b>(*) Teléfono</b></label>                     
                    <input type='text' id='telefono' name='telefono' required maxlength='15'>                 
                </div>                 
                <div class='form-column'>                     
                    <label for='fec_nac'><b>(*) Fecha de Nacimiento</b></label>                     
                    <input type='date' id='fec_nac' name='fec_nac' required>                 
                </div>             
            </div>             
            <div class='form-row'>                 
                <div class='form-column'>                     
                    <button type='submit' class='boton'>ADICIONAR PACIENTE</button>                 
                </div>             
            </div>         
        </form>         
        <div id='mensaje'></div>     
    </div>      
</body> 
</html>"; 
?>