$(document).ready(function () {
    GeneraReporte();
    historicoHorasMensuales();
});

function GeneraReporte() {
    var meses_regenerado = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var fecha_regenerado = new Date();
    var fecha_actual_regenerado = meses_regenerado[fecha_regenerado.getMonth()] + ", " + fecha_regenerado.getFullYear();

    var fecha_inicio_regenerado = $('#init_date').val();
    var fecha_final_regenerado = $('#final_date').val();
    var contrato_reporte_regenerado = $('#contract_name').val();
    var otobo_customer_regenerado = $('#otobo_customer').val();
    var tickets_regenerado = $('#ID_tickets').val();
    var compuesta_regenerado = tickets_regenerado.replace(/\D/g, ' ');
    var valoresCheck_regenerado = compuesta_regenerado.split(' ');

    var valoresInit_regenerado = fecha_inicio_regenerado.split(' ');
    var valoresFinal_regenerado = fecha_final_regenerado.split(' ');

    $('#fechaActual_regenerado').html(fecha_actual_regenerado);
    $('#fechaInicio_regenerado').html(valoresInit_regenerado[0]);
    $('#fechaFinal_regenerado').html(valoresFinal_regenerado[0]);

    CargarInfoReporte(valoresCheck_regenerado, fecha_inicio_regenerado, fecha_final_regenerado, contrato_reporte_regenerado, otobo_customer_regenerado);


}

function CargarInfoReporte(valoresCheck_regenerado, fecha_inicio_regenerado, fecha_final_regenerado, contrato_reporte_regenerado, otobo_customer_regenerado) {
    var meses_regenerado = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    // var fecha = new Date();
    var inicio_regenerado = fecha_inicio_regenerado;
    var final_regenerado = fecha_final_regenerado;
    var customer_regenerado = otobo_customer_regenerado;
    var nombre_contrato_reporte_regenerado = contrato_reporte_regenerado;
    var NA_regenerado = "NA";

    var parametros = {
        IDtickets: valoresCheck_regenerado,
    }
    $.ajax({
        type: 'GET',
        url: "?controlador=Reporte&accion=accionReporteGenerado",
        data: parametros,
        success: function (response) {
            console.log(response);
            reporte_regenerado = JSON.parse(response);
            console.log(reporte_regenerado);

            var html_regenerado = '';
            var incidencia_regenerado = '';
            let tiempoTotalReporte_regenerado = 0;
            let total_incidencias_regenerado = new Array();

            for (let i = 0; i < reporte_regenerado.length; i++) {
                for (let j = 0; j < reporte_regenerado[i].length; j++) {
                    datos_regenerado = JSON.parse(reporte_regenerado[i][j])
                    for (let x = 0; x < datos_regenerado.Ticket.length; x++) {

                        tiempoTotalReporte_regenerado = tiempoTotalReporte_regenerado + datos_regenerado.Ticket[x].TimeUnit;
                        total_incidencias_regenerado[x] = datos_regenerado.Ticket[x].Title;

                        var f_regenerado = datos_regenerado.Ticket[x].Created;
                        var fechacompuesta_regenerado = f_regenerado.replace(/\D/g, ' ');
                        var componentes_regenerado = fechacompuesta_regenerado.split(' ');

                        html_regenerado += '<tr>';
                        html_regenerado += '<td>' + meses_regenerado[componentes_regenerado[1] - 1] + '</td>';
                        html_regenerado += '<td>' + datos_regenerado.Ticket[x].State + '</td>';
                        html_regenerado += '<td>' + datos_regenerado.Ticket[x].Title + '</td>';
                        html_regenerado += '<td>' + datos_regenerado.Ticket[x].TimeUnit + '</td>';
                        html_regenerado += '<td>' + datos_regenerado.Ticket[x].TicketNumber + '</td>';
                        html_regenerado += '</tr>';

                    }
                }
            }


            for (let i = 0; i < reporte_regenerado.length; i++) {
                for (let j = 0; j < reporte_regenerado[i].length; j++) {
                    datos_regenerado = JSON.parse(reporte_regenerado[i][j])
                    for (let x = 0; x < datos_regenerado.Ticket.length; x++) {
                        let reply_regenerado = '';
                        for (let y = 0; y < datos_regenerado.Ticket[x].Article.length; y++) {
                            let re_regenerado = '';
                            re_regenerado = datos_regenerado.Ticket[x].Article[y].Subject;
                            if (re_regenerado == "Re: [Caso#" + datos_regenerado.Ticket[x].TicketNumber + "] Reporte" || re_regenerado == "Re: [Caso#" + datos_regenerado.Ticket[x].TicketNumber + "] CIERRE_CASO") {
                                reply_regenerado = datos_regenerado.Ticket[x].Article[y].Body;
                            }
                        }

                        var f_inicio_regenerado = inicio_regenerado;
                        var fechacompuesta_inicio_regenerado = f_inicio_regenerado.split(' ');
                        var f_final_regenerado = final_regenerado;
                        var fechacompuesta_final_regenerado = f_final_regenerado.split(' ');

                        var cuerpo_regenerado = reply_regenerado.replace(/\n/g, "<br>");


                        // incidencia_regenerado += '<tr>';
                        // incidencia_regenerado += '<td> <h5 style=text-align:center;><b>' + "Caso de soporte #" + datos_regenerado.Ticket[x].TicketNumber + '</b></h5></td>';
                        // incidencia_regenerado += '</tr>';

                        // incidencia_regenerado += '<tr>';
                        // incidencia_regenerado += '<td style=text-align:justify>' + "Fecha y hora <br> inicio: " + fechacompuesta_inicio_regenerado[0] + " ---- final: " + fechacompuesta_final_regenerado[0] + " ---- tipo: " + datos_regenerado.Ticket[x].Type + '</td>';
                        // incidencia_regenerado += '</tr>';

                        // incidencia_regenerado += '<tr>';
                        // incidencia_regenerado += '<td style=text-align:justify>' + "Tiempo <br>  horario regular: " + datos_regenerado.Ticket[x].TimeUnit + " Hora(s) ---- Horario extraordinario: " + NA_regenerado + " ---- Total " + datos_regenerado.Ticket[x].TimeUnit + '</td>';
                        // incidencia_regenerado += '</tr>';

                        // incidencia_regenerado += '<tr>';
                        // incidencia_regenerado += '<td style=text-align:justify>' + "Incidencias <br>" + cuerpo_regenerado + '</td>';
                        // incidencia_regenerado += '</tr>';

                        // incidencia_regenerado += '<tr>';
                        // incidencia_regenerado += '<td>' + "<br> " + '</td>';
                        // incidencia_regenerado += '</tr>';


                        incidencia_regenerado += '<div>';
                        incidencia_regenerado += '<h5 style=text-align:center;><b>' + "Caso de soporte #" + datos_regenerado.Ticket[x].TicketNumber + '</b></h5>';
                        incidencia_regenerado += '<p style=text-align:justify>' + "Fecha y hora <br> inicio: " + fechacompuesta_inicio_regenerado[0] + " ---- final: " + fechacompuesta_final_regenerado[0] + " ---- tipo: " + datos_regenerado.Ticket[x].Type + '</p>';
                        incidencia_regenerado += '<p style=text-align:justify>' + "Tiempo <br>  horario regular: " + datos_regenerado.Ticket[x].TimeUnit + " Hora(s) ---- Horario extraordinario: " + NA_regenerado + " ---- Total " + datos_regenerado.Ticket[x].TimeUnit + '</p>';
                        incidencia_regenerado += '<p style=text-align:justify>' + "Incidencias <br>" + cuerpo_regenerado + '</p>';
                        incidencia_regenerado += '<br><br></div>';
                    }
                }
            }

            $('#horas-consumidas-tbody_regenerado').html(html_regenerado);
            $('#tiempoTotal_regenerado').append(tiempoTotalReporte_regenerado + " hora(s)");
            $('#incidencia-tbody_regenerado').html(incidencia_regenerado);

            ObtenerInfoContrato(nombre_contrato_reporte_regenerado, inicio_regenerado, final_regenerado, tiempoTotalReporte_regenerado);
        },
        error: function (errorMessage) {

            console.log(errorMessage)
            alert("error");
        }

    });
}

function ObtenerInfoContrato(contrato_reporte_regenerado, fecha_inicio_regenerado, fecha_final_regenerado, tiempoTotalReporte_regenerado) {
    var inicio_regenerado = fecha_inicio_regenerado;
    var final_regenerado = fecha_final_regenerado;
    var tiempo_total_regenerado = tiempoTotalReporte_regenerado;

    var previous = $('#previous_hours').val();
    var current = $('#current_hours').val();


    var parametros = {
        contrato: contrato_reporte_regenerado
    }
    $.ajax({
        url: "?controlador=Reporte&accion=obtenerInfoContrato",
        type: "GET",
        data: parametros,

        success: function (response) {
            ContratoObtenido_Reporte_regenerado = JSON.parse(response);
            var html_regenerado = '';
            let horas_usadas_regenerado = (ContratoObtenido_Reporte_regenerado.data[0][7] - tiempo_total_regenerado);

            $('#nombreContrato_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][1]);
            $('#nombreCliente_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][3]);
            $('#nombreCliente_intro_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][3]);
            $('#tipoContrato_intro_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][5]);

            $('#nombreContrato_horasContratadas_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][1]);

            $('#descripcion_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][10]);
            $('#orden_compra_regenerado').append(ContratoObtenido_Reporte_regenerado.data[0][11]);

            var f_inicio_regenerado = inicio_regenerado;
            var fechacompuesta_inicio_regenerado = f_inicio_regenerado.split(' ');
            var f_final_regenerado = final_regenerado;
            var fechacompuesta_final_regenerado = f_final_regenerado.split(' ');


            html_regenerado += '<tr>';
            html_regenerado += '<td>' + "Fecha" + '</td>';
            html_regenerado += '<td>' + fechacompuesta_inicio_regenerado[0] + " al " + fechacompuesta_final_regenerado[0] + '</td>';
            html_regenerado += '</tr>';

            html_regenerado += '<tr>';
            html_regenerado += '<td>' + "Horas Contratadas" + '</td>';
            html_regenerado += '<td>' + ContratoObtenido_Reporte_regenerado.data[0][6] + '</td>';
            html_regenerado += '</tr>';

            html_regenerado += '<tr>';
            html_regenerado += '<td>' + "Horas Disponibles mes anterior" + '</td>';
            html_regenerado += '<td>' + previous + '</td>';
            html_regenerado += '</tr>';

            html_regenerado += '<tr>';
            html_regenerado += '<td>' + "Horas Consumidas" + '</td>';
            html_regenerado += '<td>' + tiempo_total_regenerado + '</td>';
            html_regenerado += '</tr>';

            html_regenerado += '<tr>';
            html_regenerado += '<td>' + "Horas disponibles actualmente" + '</td>';
            html_regenerado += '<td>' + current + '</td>';
            html_regenerado += '</tr>';


            $('#resumen-tbody_regenerado').html(html_regenerado);

        },
        error: function (errorMessage) {
            if (errorMessage === "no connection") {
                $('#modalResult-contrato').text("Error en la conexión.");
            }
            $('#modalResult-contrato').text("Error capa 8");
            $('#modalResult-contrato').css('color', 'red');
        }
    });
}

function historicoHorasMensuales() {
    var nombre_contrato_historico = $('#contract_name').val();
    var fecha_de_generado = $('#date_case').val();

    var parametros = {
        contrato: nombre_contrato_historico,
        fecha: fecha_de_generado,
    }

    $.ajax({
        url: "?controlador=Reporte&accion=obtenerCasosParaHistoricoGenerado",
        type: "GET",
        data: parametros,
        success: function (response) {
            ContratoObtenido_regenerado = JSON.parse(response);
            var html_regenerado = '';
            for (let i = 0; i < ContratoObtenido_regenerado.data.length; i++) {

                var f_regenerado = ContratoObtenido_regenerado.data[i][2];
                var fechacompuesta_regenerado = f_regenerado.split(' ');

                html_regenerado += '<tr>';
                html_regenerado += '<td>' + ContratoObtenido_regenerado.data[i][0] + '</td>';
                html_regenerado += '<td>' + ContratoObtenido_regenerado.data[i][1] + '</td>';
                html_regenerado += '<td>' + fechacompuesta_regenerado[0] + '</td>';
                html_regenerado += '</tr>';

            }

            $('#horas-meses-consumidas-tbody_regenerado').html(html_regenerado);
        },
        error: function (errorMessage) {
            if (errorMessage === "no connection") {
                $('#modalResult-cliente').text("Error en la conexión.");
            }
            $('#modalResult-cliente').text("Error capa 8");
            $('#modalResult-cliente').css('color', 'red');
        }
    });


}


function imprimir() {
    $('#BotonConfirmarReporte_regenerado').hide();
    $('#botonImprimirReporte_regenerado').hide();
    javascript: window.print();
    $('#BotonConfirmarReporte_regenerado').show();
    $('#botonImprimirReporte_regenerado').show();
}