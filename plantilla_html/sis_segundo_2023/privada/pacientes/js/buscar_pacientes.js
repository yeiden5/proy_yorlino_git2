function buscar_pacientes() {
    var ap = document.getElementById('ap').value;
    var am = document.getElementById('am').value;
    var nombre = document.getElementById('nombre').value;
    
    var parametros = {
        "ap" : ap,
        "am" : am,
        "nombre" : nombre
    };
    $.ajax({
        url: 'ajax_buscar_pacientes.php',
        method: 'POST',
        data: parametros,
        success: function(data) {
            $("#pacientes1").html(data);
        }
    });
}

function mostrar_paciente(cod_paciente) {
    window.location.href = 'paciente_modificar.php?cod_paciente=' + cod_paciente;
}

function eliminar_paciente(cod_paciente) {
    if (confirm('¿Está seguro de eliminar este paciente?')) {
        window.location.href = 'paciente_eliminar.php?cod_paciente=' + cod_paciente;
    }
}

// Ejecutar búsqueda cuando se carga la página
$(document).ready(function() {
    buscar_pacientes();
    
    // Ejecutar búsqueda cuando se escribe en los campos
    $('#ap, #am, #nombre').on('input', function() {
        buscar_pacientes();
    });
});