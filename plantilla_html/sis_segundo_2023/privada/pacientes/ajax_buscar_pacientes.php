<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$ap = isset($_POST["ap"]) ? $_POST["ap"] : '';
$am = isset($_POST["am"]) ? $_POST["am"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';

$sql = $db->Prepare("SELECT *
                     FROM pacientes
                     WHERE ap LIKE ?
                     AND am LIKE ?
                     AND nombre LIKE ?
                     AND estado <> 'X'
                     ORDER BY ap, am, nombre");

$rs = $db->GetAll($sql, array(
    '%' . $ap . '%', 
    '%' . $am . '%', 
    '%' . $nombre . '%'
));

if ($rs) {
    echo "<table class='listado'>
            <tr>
                <th>Nro</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        $cod_paciente = $fila['cod_paciente'];
        echo "<tr>
                <td align='center'>" . $b . "</td>
                <td>" . resaltar($ap, $fila['ap']) . "</td>
                <td>" . resaltar($am, $fila['am']) . "</td>
                <td>" . resaltar($nombre, $fila['nombre']) . "</td>
                <td>" . $fila['direccion'] . "</td>
                <td>" . $fila['telefono'] . "</td>
                <td align='center'>
                    <a href='javascript:void(0);' onclick='mostrar_paciente(" . $cod_paciente . ")' title='Modificar Paciente'>
                        Modificar
                    </a>
                </td>
                <td align='center'>
                    <a href='javascript:void(0);' onclick='eliminar_paciente(" . $cod_paciente . ")' title='Eliminar Paciente'>
                        Eliminar
                    </a>
                </td>
             </tr>";
        $b++;
    }
    echo "</table>";
} else {
    echo "<p><b>No se encontraron pacientes con los criterios proporcionados.</b></p>";
}
?>