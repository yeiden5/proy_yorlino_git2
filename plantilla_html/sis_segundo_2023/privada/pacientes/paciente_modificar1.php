<?php
session_start();
require_once("../../conexion.php");

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod_paciente = isset($_POST["cod_paciente"]) ? $_POST["cod_paciente"] : null;
    
    if (!$cod_paciente) {
        $response['message'] = 'Código de paciente no proporcionado';
        echo json_encode($response);
        exit;
    }

    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $direccion = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : "";
    $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
    $ap = isset($_POST["ap"]) ? trim($_POST["ap"]) : "";
    $am = isset($_POST["am"]) ? trim($_POST["am"]) : "";
    $fec_nac = isset($_POST["fec_nac"]) ? trim($_POST["fec_nac"]) : "";

    if ($nombre != "" && $direccion != "" && $telefono != "" && $fec_nac != "" && ($ap != "" || $am != "")) {
        $reg = array();
        $reg["nombre"] = $nombre;
        $reg["direccion"] = $direccion;
        $reg["telefono"] = $telefono;
        $reg["ap"] = $ap;
        $reg["am"] = $am;
        $reg["fec_nac"] = $fec_nac;
        $reg["usuario"] = $_SESSION["sesion_cod_usuario"];   

        $rs1 = $db->AutoExecute("pacientes", $reg, "UPDATE", "cod_paciente='".$cod_paciente."'");
        
        if ($rs1) {
            $response['success'] = true;
            $response['message'] = 'Paciente modificado correctamente';
        } else {
            $response['message'] = 'Error al modificar el paciente: ' . $db->ErrorMsg();
        }
    } else {
        $response['message'] = 'Todos los campos obligatorios deben ser completados, incluyendo al menos un apellido';
    }
} else {
    $response['message'] = 'Método de solicitud no válido';
}

echo json_encode($response);
?>