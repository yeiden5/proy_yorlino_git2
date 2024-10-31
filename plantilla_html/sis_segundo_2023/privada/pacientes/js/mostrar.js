"use strict";
function mostrar(cod_paciente) {
    var ventanaCalendario;
    ventanaCalendario = window.open("ficha_tec_pacientes1.php?cod_paciente=" + cod_paciente, "calendario", "width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=no,status=no,resizable=yes,location=NO");
}
