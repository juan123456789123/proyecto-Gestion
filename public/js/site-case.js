$(document).ready(function () {
    CargarCasos();

    $(document).on('submit', '#case-entry-form', function () {

        if ($('#id').val() !== null) {

            ConfirmarReporte();
        } else {
            return false;

        }
        return false;
    });

});


function CargarCasos() {
    $.ajax({
        url: "?controlador=Casos&accion=listarCasos",
        type: "GET",
        success: function (response) {
            casos = JSON.parse(response);

            var html = '';
            for (let i = 0; i < casos.data.length; i++) {

                var f_r = casos.data[i][5];
                var f_r_compuesta = f_r.split(' ');

                html += '<tr>';
                html += '<td>' + casos.data[i][1] + '</td>';
                html += '<td>' + casos.data[i][2] + '</td>';
                html += '<td>' + casos.data[i][3] + '</td>';
                html += '<td>' + casos.data[i][4] + '</td>';
                html += '<td>' + f_r_compuesta[0] + '</td>';
                html += '<td class="acciones"><form method="post" action="?controlador=Casos&accion=accionMostrarReporteGenerado"><input type="hidden" id="' + casos.data[i][0] + '" name="id" value= "' + casos.data[i][0] + '"><button type="submit" class="btn btn-success"><i class="fa-solid fa-rotate"></i></button></form> </td>';
                html += '</tr>';
            }
            $('#casos-tbody').html(html);

            $(document).ready(function () {
                $('#casos-table').DataTable();
            });

        },
        error: function (errorMessage) {
            console.log(errorMessage)
            alert(errorMessage.responseText);
        }
    });
}

// ------------------------------------------------------------------------------------------------------

function ConfirmarReporte() {
    var contract_name_val = document.getElementById("nombreContrato_reporte").innerText;
    var hours_val = parseInt(document.getElementById("tiempoTotal").innerText);
    var used_hours_val = parseInt(document.getElementById("horasUsadas_reporte").innerText);
    var init_val = document.getElementById("fechaInicio_reporte").innerText;
    var final_val = document.getElementById("fechaFinal_reporte").innerText;
    var previous_hours_val = document.getElementById("horasMesAnterior_reporte").innerText;
    var current_hours_val = document.getElementById("horasUsadas_reporte").innerText; 

    var tickets_obtenidos = new Array();
    tickets_obtenidos = localStorage.getItem("tickets");
    if (tickets_obtenidos[0] == "t") {
        var valores_tickets = localStorage.getItem("todos");
    }
    else {
        var valores_tickets = localStorage.getItem("tickets");
    }
    var horas_usadas = localStorage.getItem("horas_usadas");

    var reporte_in = {
        contract_name: contract_name_val,
        IDtickets: valores_tickets,
        incidents: localStorage.getItem("incidencias"),
        hours: hours_val,
        used_hours: used_hours_val,
        init: init_val,
        final: final_val,
        otobo_customer: localStorage.getItem("otobo_customer"),
        previous_hours: previous_hours_val,
        current_hours: current_hours_val,
    };

    if (reporte_in != null) {
        $.ajax({
            type: "POST",
            url: "?controlador=Casos&accion=agregarCaso",
            data: reporte_in,
            success: function (result) {

                $('#resultReporte').text("Reporte registrado con éxito");
                $('#resultReporte').css({ 'color': 'white', 'background-color': '#5cb85c', 'margin': '4px', 'border-radius': '1em' });
                $("#resultReporte").fadeIn(2000);
                $("#resultReporte").fadeOut(3000);

            },
            error: function (errorMessage) {
                if (errorMessage === "no connection") {
                    $('#resultUser').text("Error en la conexión.");
                }
                $('#contrasenna').val('');
                $('#resultUser').text("Error al registrar");
                $('#resultUser').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '1em' });
                $("#resultUser").fadeIn(2000);
                $("#resultUser").fadeOut(3000);
            }
        });
    }
}