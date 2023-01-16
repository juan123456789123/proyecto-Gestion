$(document).ready(function () {
    $('.select').select2();
    ObtenerClienteReporte();
    checkBoxList();
    ObtenerContratosPorNombre();


    localStorage.clear();

    $('#nombre_cliente').change(function () {
        limpiarSelect();
        ObtenerContratosPorNombre();
    });

    $(document).on('submit', '#ticket-entry-form', function () {
        if ($('#idreporte').val() !== null) {
            BuscarTickets();
        } else {
            return false;
        }
        return false;
    });

    $(document).on('submit', '#reporte-entry-form', function () {
        if (localStorage.getItem("tickets") !== null) {
            GeneraReporte();
        } else {
            // return false;
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_final = $('#fecha_final').val();
            var contrato_reporte = $('#nombre_contrato').val();
            var cliente = $('#nombre_cliente').val();
            var ticket_aux = localStorage.getItem("tickets");

            $('#helpCliente').text('');
            $('#helpInicio').text('');
            $('#helpFinal').text('');
            $('#helpContrato').text('');
            $('#helpTicket').text('');

            // if (cliente == "" || ticket_aux !== null || fecha_inicio == "" || fecha_final == "" || contrato_reporte == "0") {
            if (ticket_aux === null) {


                $('#resultBusqueda').text("Seleccione la información requerida");
                $('#resultBusqueda').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '1em' });
                $("#resultBusqueda").fadeIn(2000);
                $("#resultBusqueda").fadeOut(5000);


                if (cliente == "") {
                    $('#helpCliente').text("Seleccione un cliente");
                    $('#helpCliente').css('color', 'red');
                }
                if (fecha_inicio == "") {
                    $('#helpInicio').text("ingrese de nuevo fecha de inicio");
                    $('#helpInicio').css('color', 'red');
                }
                if (fecha_final == "") {
                    $('#helpFinal').text("Ingrese de nuevo la fecha final");
                    $('#helpFinal').css('color', 'red');
                }
                if (contrato_reporte == "0") {
                    $('#helpContrato').text("Seleccione de nuevo el contrato");
                    $('#helpContrato').css('color', 'red');
                }
                if (ticket_aux === null) {
                    $('#helpTicket').text("Seleccione el o los tickets deseados a generar reporte");
                    $('#helpTicket').css('color', 'red');
                }

            }
        }
        return false;
    });



});

//------------------------------------------------------------------------------------------------------

function BuscarTickets() {
    var string = $('#nombre_cliente').val();
    var contrato_nombre = $('#nombre_contrato').val();
    var fecha_inicio_busqueda = $('#fecha_inicio').val();
    var fecha_final_busqueda = $('#fecha_final').val();

    var cliente = string.replace(/ /g, "%20");

    var parametros = {
        nombre_cliente: cliente,
        estado: "cerrado",
        fecha_inicio: fecha_inicio_busqueda,
        fecha_final: fecha_final_busqueda,
    }

    $('#helpCliente').text('');
    $('#helpInicio').text('');
    $('#helpFinal').text('');
    $('#helpContrato').text('');

    if (cliente == "" || fecha_inicio_busqueda == "" || fecha_final_busqueda == "" || contrato_nombre == "0") {

        if (cliente == "") {
            $('#helpCliente').text("Seleccione un cliente");
            $('#helpCliente').css('color', 'red');
        }
        if (fecha_inicio_busqueda == "") {
            $('#helpInicio').text("ingrese una fecha de inicio");
            $('#helpInicio').css('color', 'red');
        }
        if (fecha_final_busqueda == "") {
            $('#helpFinal').text("Ingrese una fecha final");
            $('#helpFinal').css('color', 'red');
        }
        if (contrato_nombre == "0") {
            $('#helpContrato').text("Seleccione un contrato");
            $('#helpContrato').css('color', 'red');
        }

    } else {
        $.ajax({
            type: 'GET',
            url: "?controlador=Reporte&accion=obtenerTickets",
            data: parametros,
            success: function (response) {

                if (response == "\n\n") {
                    $('#resultBusqueda').text("Error al conectar con OTOBO");
                    $('#resultBusqueda').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '1em' });
                    $("#resultBusqueda").fadeIn(2000);
                    $("#resultBusqueda").fadeOut(3000);
                } else {

                    console.log(response);
                    IDs = JSON.parse(response);
                    localStorage.setItem("todos", IDs.TicketID);
                    localStorage.setItem("tickets", 0);
                    ObtenerInfoTickets(IDs.TicketID);

                }
            },
            error: function (errorMessage) {

                $('#resultBusqueda').text("Error al conectar con OTOBO");
                $('#resultBusqueda').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '1em' });
                $("#resultBusqueda").fadeIn(2000);
                $("#resultBusqueda").fadeOut(3000);

            }

        });
    }

}

//------------------------------------------------------------------------------------------------------

function ObtenerInfoTickets(IDs) {
    var parametros = {
        IDtickets: IDs
    }
    CargandoCasos();
    $.ajax({
        type: 'GET',
        url: "?controlador=Reporte&accion=obtenerInfoTickets",
        data: parametros,
        success: function (response) {
            console.log(response);

            caso = JSON.parse(response);
            var html = '';

            for (let i = 0; i < caso.length; i++) {
                for (let j = 0; j < caso[i].length; j++) {
                    tiquete = JSON.parse(caso[i][j])
                    for (let x = 0; x < tiquete.Ticket.length; x++) {
                        html += '<tr>';
                        html += '<td><input type="checkbox" id="cbTicket" class="cbTicket" value="' + tiquete.Ticket[x].TicketID + '" name="cbTicket"></td>';
                        html += '<td>' + tiquete.Ticket[x].TicketNumber + '</td>';
                        html += '<td>' + tiquete.Ticket[x].Title + '</td>';
                        html += '<td>' + tiquete.Ticket[x].CustomerID + '</td>';
                        html += '<td>' + tiquete.Ticket[x].Type + '</td>';
                        html += '<td>' + tiquete.Ticket[x].Changed + '</td>';
                        html += '</tr>';
                    }
                }
            }
            $('#tickets-tbody').html(html);

            checkBoxList();

        },
        error: function (errorMessage) {
            console.log(errorMessage)
            Swal.fire(
                'Error de busqueda',
                'La información solicitada no existe',
                'error'
            );
        }
    });
}

//------------------------------------------------------------------------------------------------------

function ObtenerClienteReporte() {
    $.ajax({
        url: "?controlador=Cliente&accion=listarClientes",
        type: "GET",
        success: function (response) {
            listaCliente = JSON.parse(response);
            console.log(listaCliente);
            var html = '';
            for (let i = 0; i < listaCliente.data.length; i++) {
                if (listaCliente.data[i][5] == "válido") {
                    html += '<option value="' + listaCliente.data[i][4] + '" id="' + listaCliente.data[i][4] + '">' + listaCliente.data[i][4] + '</option>';
                }
            }
            $('#nombre_cliente').append(html);
        },
        error: function (errorMessage) {
            alert(errorMessage.responseText);
        }
    });
}

//------------------------------------------------------------------------------------------------------

function GeneraReporte() {
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var fecha = new Date();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_final = $('#fecha_final').val();
    var fecha_actual = meses[fecha.getMonth()] + ", " + fecha.getFullYear();
    var contrato_reporte = $('#nombre_contrato').val();

    var otobo_customer = $('#nombre_cliente').val();

    var asignar_valores = new Array();
    asignar_valores = localStorage.getItem("tickets");
    if (asignar_valores[0] == "t") {
        var valoresCheck = [localStorage.getItem("todos")];
    }
    else {
        var valoresCheck = [localStorage.getItem("tickets")];
    }

    $('#helpInicio').text('');
    $('#helpFinal').text('');
    $('#helpContrato').text('');
    $('#helpTicket').text('');

    if (valoresCheck == 0 || fecha_inicio == "" || fecha_final == "" || contrato_reporte == "0") {

        $('#resultBusqueda').text("Seleccione la información requerida");
        $('#resultBusqueda').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '1em' });
        $("#resultBusqueda").fadeIn(2000);
        $("#resultBusqueda").fadeOut(5000);


        if (fecha_inicio == "") {
            $('#helpInicio').text("ingrese de nuevo fecha de inicio");
            $('#helpInicio').css('color', 'red');
        }
        if (fecha_final == "") {
            $('#helpFinal').text("Ingrese de nuevo la fecha final");
            $('#helpFinal').css('color', 'red');
        }
        if (contrato_reporte == "0") {
            $('#helpContrato').text("Seleccione de nuevo el contrato");
            $('#helpContrato').css('color', 'red');
        }
        if (valoresCheck == 0) {
            $('#helpTicket').text("Seleccione el o los tickets deseados a generar reporte");
            $('#helpTicket').css('color', 'red');
        }

    } else {

        var busqueda = '';
        var cabecera = '<div id="cabezaPagina" class="fixed-top" style="visibility:hidden;"><img src="public/img/encabezado.png"  width="100%"  height="30%"></div>'

        var encabezado = '<div id="encabezado"><div class="col-lg-12 text-center"><h5><b>Reporte mensual Labores Realizadas</b></h5><h5><b>por Greencore <label id="nombreContrato"></label></b></h5><br /><h5><b>Cliente: <label id="nombreCliente"></label></b></h5><br /><h5><b><label id="fechaActual">' + fecha_actual + '</label></b></h5></div></div><hr>';
        var politicas = '<div id="politicas"><br /><div class="col-lg-12"><h5><b>1. Política de Privacidad</b></h5><p style=text-align:justify;>El contenido de este documento, así como los archivos adjuntos al mismo, son de carácter confidencial y dirigido al destinatario solamente. La distribución y difusión tanto impresa, verbal o electrónica se deberá realizar con la previa autorización del remitente. Si usted no es el destinatario, se le prohíbe su utilización total o parcial para cualquier fin. Lo anterior según el Artículo 2, de la Ley de Información No Divulgada No. 7975 de la República de Costa Rica.</p><br /><br /> <h5><b>Privacy Policy</b></h5> <p style=text-align:justify;> The contents of this document, including the attachments, are confidential and are to the designated recipient only. The distribution and dissemination printed, verbal or electronic has to be authorized by the sender. If you are not the designated recipient, it\'\s prohibited the total or partial use of this information. The foregoing according to Article 2 of the Law of Undisclosed Information No. 7975 of the Republic of Costa Rica. </p></div></div>';
        var intro = '<div id="intro"><br /><hr><br /><div class="col-lg-12"><h5><b>2. Introducción</b></h5><p style=text-align:justify;>Este documento presenta el resumen de labores, resultados y tiempo para cliente <label id="nombreCliente_intro"></label> bajo la contratación <label id="tipoContrato_intro"></label></p></div></div>';
        var resumenConsumidas = '<div id="resumen"><br /><hr><div class="col-lg-12" style="page-break-before: always;margin-top:10%;padding-top:10%"><h5><b>3. Resumen de horas consumidas</b></h5><p style=text-align:justify;>Los siguientes datos resumen las labores realizadas por Greencore Solutions S.R.L. mediante el contrato citado anteriormente.</p></div></div><br /><br />';
        var horasConsumidas = '<div class="table-responsive text-black"><table class="text-black table table-bordered schedule-table" id="horas-consumidas-table"><thead class="thead-light"><tr><th>Mes</th><th>Estado</th><th>Actividad</th><th>Horas</th><th>Referencia</th></tr></thead><tbody id="horas-consumidas-tbody"></tbody></table><br /><h5 style=text-align:center;>Tiempo total: <label id="tiempoTotal"></label></h5></div><br /><br />';
        var horasContratadas = '<h6 style=text-align:center;><b>Resumen de Horas, Contrato <label id="nombreContrato_reporte"></label></b></h6><div class="table-responsive text-black text-center"><table class="text-black table table-bordered schedule-table" id="resumen-table"><thead class="thead-light"><tr><th>Detalle</th><th>Valor</th></tr></thead><tbody id="resumen-tbody"></tbody></table>  <b><div id="orden_compra"> </div></b> <div id="descripcion"></div> <br /> </div>';
        //------------------------
        var historico_mensual = '<hr><br /><div class="col-lg-12" style="page-break-before: always;margin-top:10%;padding-top:10%"><h5><b>4. Histórico de horas por mes</b></h5><p style=text-align:left;>A continuación se detallan las horas cosumidas:</p><br /><br /></div>';
        var tabla_historico_mensual = '<div class="table-responsive text-black"><table class="text-black table table-bordered schedule-table" id="horas-meses-consumidas-table"><thead class="thead-light"><tr><th>Contrato</th><th>Horas</th><th>Fecha</th></tr></thead><tbody id="horas-meses-consumidas-tbody"></tbody></table><br /></div><br /><br />';

        //--------------------------

        var incidencias = '<hr><br /><div class="col-lg-12" ><h5><b>5. Descripción de las incidencias</b></h5><p style=text-align:justify;>A continuación de desarrollan los aspectos generales de cada solicitud de labores ejecutada mediante la relación comercial con del cliente desde <label id="fechaInicio">' + fecha_inicio + '</label> al <label id="fechaFinal">' + fecha_final + '</label></p><br /><br /></div><br /><br />';
        // var tablaIncidencias = '<div class="table-responsive text-black text-center"><table class="text-black table table-bordered schedule-table" id="incidencia-table"><thead class="thead-light"><tr class="incidence"><th>Incidencias</th></tr></thead><tbody id="incidencia-tbody"></tbody></table><br /></div><br /><hr><br />';
        var tablaIncidencias = '<div class="responsive text-black text-center id="cuerpoIncidencia""><h5><b>Incidencias</b></h5><div id="incidencia-tbody"></div><br /></div><br />';//<hr><br />
        var confirmar = '<h3 class="centrar" id="resultReporte"></h3> <div class="acciones"><form id="case-entry-form" action="" method="post" style="display: flex;"><input id="fechaInicio_reporte" hidden><input id="fechaFinal_reporte" hidden><input id="horasContratadas_reporte" hidden><input id="horasMesAnterior_reporte" hidden><input id="tiempoTotal_reporte" hidden><input id="horasUsadas_reporte" hidden><input type="text" name="id" id="id" hidden><br><button type="submit" id="BotonConfirmarReporte" class="btn btn-success" onsubmit="return ConfirmarReporte();">Confirmar</button> </form> <div><button class="btn btn-primary" id="botonImprimirReporte"onclick="imprimir()" style="margin-left: 10%;">Imprimir</button> </div></div> <br />'//<br /><br /><br />
        var pie = '<div id="piepagina" class="fixed-bottom" style="visibility:hidden;"><img src="public/img/pie.png"  width="100%"  height="30%"></div>'

        $('#seccion-busqueda').html(busqueda);
        $('#cabecera').html(cabecera);
        $('#seccion-encabezado').html(encabezado);
        $('#seccion-politicas').html(politicas);
        $('#seccion-intro').html(intro);
        $('#seccion-resumen-consumidas').html(resumenConsumidas);
        $('#seccion-resumen-horas-consumidas').html(horasConsumidas);
        $('#seccion-resumen-contratadas').html(horasContratadas);

        //---
        $('#historico_horas_mes').html(historico_mensual);
        $('#resumen_historico_horas_mes').html(tabla_historico_mensual);
        //---

        $('#seccion-incidencias').html(incidencias);
        $('#seccion-total-incidencias').html(tablaIncidencias);
        $('#seccion-confirmar').html(confirmar);
        $('#pie_pagina').html(pie);


        CargarInfoReporte(valoresCheck, fecha_inicio, fecha_final, contrato_reporte, otobo_customer);
        generandoReporteExitoso();
    }



}

//------------------------------------------------------------------------------------------------------

function CargarInfoReporte(valoresCheck, fecha_inicio, fecha_final, contrato_reporte, otobo_customer) {
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var fecha = new Date();
    var inicio = fecha_inicio;
    var final = fecha_final;
    var customer = otobo_customer;
    var nombre_contrato_reporte = contrato_reporte;
    var NA = "NA";

    var parametros = {
        IDtickets: valoresCheck,
    }
    $.ajax({
        type: 'GET',
        url: "?controlador=Reporte&accion=accionReporteGenerado",
        data: parametros,
        success: function (response) {
            console.log(response);
            reporte = JSON.parse(response);
            console.log(reporte);

            var html = '';
            var incidencia = '';
            let tiempoTotalReporte = 0;
            let total_incidencias = new Array();

            for (let i = 0; i < reporte.length; i++) {
                for (let j = 0; j < reporte[i].length; j++) {
                    datos = JSON.parse(reporte[i][j])
                    for (let x = 0; x < datos.Ticket.length; x++) {

                        tiempoTotalReporte = tiempoTotalReporte + datos.Ticket[x].TimeUnit;
                        total_incidencias[x] = datos.Ticket[x].Title;

                        var f = datos.Ticket[x].Created;
                        var fechacompuesta = f.replace(/\D/g, ' ');
                        var componentes = fechacompuesta.split(' ');

                        html += '<tr>';
                        html += '<td>' + meses[componentes[1] - 1] + '</td>';
                        html += '<td>' + datos.Ticket[x].State + '</td>';
                        html += '<td>' + datos.Ticket[x].Title + '</td>';
                        html += '<td>' + datos.Ticket[x].TimeUnit + '</td>';
                        html += '<td>' + datos.Ticket[x].TicketNumber + '</td>';
                        html += '</tr>';

                    }
                }
            }

            for (let i = 0; i < reporte.length; i++) {
                for (let j = 0; j < reporte[i].length; j++) {
                    datos = JSON.parse(reporte[i][j])
                    for (let x = 0; x < datos.Ticket.length; x++) {
                        let reply = '';
                        for (let y = 0; y < datos.Ticket[x].Article.length; y++) {
                            let re = '';
                            re = datos.Ticket[x].Article[y].Subject;
                            if (re == "Re: [Caso#" + datos.Ticket[x].TicketNumber + "] Reporte" || re == "Re: [Caso#" + datos.Ticket[x].TicketNumber + "] CIERRE_CASO") {
                                reply = datos.Ticket[x].Article[y].Body;
                            }
                        }

                        var cuerpo = reply.replace(/\n/g, "<br>");


                        // incidencia += '<tr class="incidence">';
                        // incidencia += '<td> <h5 style=text-align:center;><b>' + "Caso de soporte #" + datos.Ticket[x].TicketNumber + '</b></h5></td>';
                        // incidencia += '</tr>';

                        // incidencia += '<tr>';
                        // incidencia += '<td style=text-align:justify>' + "Fecha y hora <br> inicio: " + inicio + " ---- final: " + final + " ---- tipo: " + datos.Ticket[x].Type + '</td>';
                        // incidencia += '</tr>';

                        // incidencia += '<tr>';
                        // incidencia += '<td style=text-align:justify>' + "Tiempo <br>  horario regular: " + datos.Ticket[x].TimeUnit + " Hora(s) ---- Horario extraordinario: " + NA + " ---- Total " + datos.Ticket[x].TimeUnit + '</td>';
                        // incidencia += '</tr>';

                        // incidencia += '<tr>';
                        // incidencia += '<td style=text-align:justify>' + "Incidencias <br>" + cuerpo + '</td>';
                        // incidencia += '</tr>';

                        // incidencia += '<tr>';
                        // incidencia += '<td><div class="incidende">' + "<br> " + '</div></td>';
                        // incidencia += '</tr>';

                        // ------------------------------------------------------------------------

                        incidencia += '<div>';
                        incidencia += '<h5 style=text-align:center;><b>' + "Caso de soporte #" + datos.Ticket[x].TicketNumber + '</b></h5>';
                        incidencia += '<p style=text-align:justify>' + "Fecha y hora <br> inicio: " + inicio + " ---- final: " + final + " ---- tipo: " + datos.Ticket[x].Type + '</p>';
                        incidencia += '<p style=text-align:justify>' + "Tiempo <br>  horario regular: " + datos.Ticket[x].TimeUnit + " Hora(s) ---- Horario extraordinario: " + NA + " ---- Total " + datos.Ticket[x].TimeUnit + '</p>';
                        incidencia += '<p style=text-align:justify>' + "Incidencias <br>" + cuerpo + '</p>';
                        incidencia += '<br><br></div>';
                    }
                }
            }

            localStorage.setItem("otobo_customer", otobo_customer);


            $('#horas-consumidas-tbody').html(html);
            $('#tiempoTotal').append(tiempoTotalReporte + " hora(s)");
            $('#incidencia-tbody').html(incidencia);

            localStorage.setItem("incidencias", total_incidencias);

            ObtenerInfoContrato(nombre_contrato_reporte, inicio, final, tiempoTotalReporte);
            //---

            var nombreContratosCasos = contrato_reporte;

            historicoHorasMensuales(contrato_reporte);
            //--
        },
        error: function (errorMessage) {

            console.log(errorMessage)
            alert("error");
        }

    });
}

// -------------------------------------------------------------------------------------------------------

function ObtenerContratosPorNombre() {

    var parametros = {
        cliente: $('#nombre_cliente').val()
    }
    $.ajax({
        url: "?controlador=Reporte&accion=obtenerContratosPorNombre",
        type: "GET",
        data: parametros,

        success: function (response) {
            listaContratos = JSON.parse(response);
            console.log(listaContratos);

            var html = '';
            html += '<option value="0">' + "--Seleccione un contrato--" + '</option>';
            for (let i = 0; i < listaContratos.data.length; i++) {
                if (listaContratos.data[i][3] == 1) {
                    html += '<option value="' + listaContratos.data[i][1] + '" id="' + listaContratos.data[i][1] + '">' + listaContratos.data[i][1] + '</option>';
                }
            }
            $('#nombre_contrato').append(html);

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

// -------------------------------------------------------------------------------------------------------

function limpiarSelect() {

    const $select = document.querySelector("#nombre_contrato");
    for (let a = $select.options.length; a >= 0; a--) {
        $select.remove(a);
    }

}

// -------------------------------------------------------------------------------------------------------

function ObtenerInfoContrato(contrato_reporte, fecha_inicio, fecha_final, tiempoTotalReporte) {
    var inicio = fecha_inicio;
    var final = fecha_final;
    var tiempo_total = tiempoTotalReporte;


    var parametros = {
        contrato: contrato_reporte
    }
    $.ajax({
        url: "?controlador=Reporte&accion=obtenerInfoContrato",
        type: "GET",
        data: parametros,

        success: function (response) {
            ContratoObtenido_Reporte = JSON.parse(response);
            var html = '';
            let horas_usadas = (ContratoObtenido_Reporte.data[0][7] - tiempo_total);

            $('#nombreContrato').append(ContratoObtenido_Reporte.data[0][1]);
            $('#nombreCliente').append(ContratoObtenido_Reporte.data[0][3]);
            $('#nombreCliente_intro').append(ContratoObtenido_Reporte.data[0][3]);
            $('#tipoContrato_intro').append(ContratoObtenido_Reporte.data[0][5]);
            $('#nombreContrato_reporte').append(ContratoObtenido_Reporte.data[0][1]);

            $('#descripcion').append(ContratoObtenido_Reporte.data[0][10]);
            $('#orden_compra').append(ContratoObtenido_Reporte.data[0][11]);


            html += '<tr>';
            html += '<td>' + "Fecha" + '</td>';
            html += '<td>' + inicio + " al " + final + '</td>';
            html += '</tr>';

            $('#fechaInicio_reporte').text(inicio);
            $('#fechaFinal_reporte').text(final);

            html += '<tr>';
            html += '<td>' + "Horas Contratadas" + '</td>';
            html += '<td>' + ContratoObtenido_Reporte.data[0][6] + '</td>';
            html += '</tr>';

            $('#horasContratadas_reporte').text(ContratoObtenido_Reporte.data[0][6]);

            html += '<tr>';
            html += '<td>' + "Horas Disponibles mes anterior" + '</td>';
            html += '<td>' + ContratoObtenido_Reporte.data[0][7] + '</td>';
            html += '</tr>';

            $('#horasMesAnterior_reporte').text(ContratoObtenido_Reporte.data[0][7]);

            html += '<tr>';
            html += '<td>' + "Horas Consumidas" + '</td>';
            html += '<td>' + tiempo_total + '</td>';
            html += '</tr>';

            $('#tiempoTotal_reporte').text(tiempo_total);

            html += '<tr>';
            html += '<td>' + "Horas disponibles actualmente" + '</td>';
            html += '<td>' + horas_usadas + '</td>';
            html += '</tr>';

            $('#horasUsadas_reporte').text(horas_usadas);
            $('#resumen-tbody').html(html);



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



//------------------------------------------------------------------------------------------------------

function checkBoxList() {
    var btnTodos = $('#btnTodos');
    var btnNinguno = $('#btnNinguno');
    var btnCheckTodos = $('#btnCheckTodos');
    var tbTickets = $('#ticket-table');
    var divSeleccionados = $('#divSeleccionados');

    // Inicializa
    var checkTodos = false;
    var checkboxList = GetAllCheckbox();

    // Eventos
    btnCheckTodos.click(function () {
        checkTodos = !checkTodos;
        checkboxList.prop('checked', checkTodos);
        ActualizaSeleccionados();
    });

    checkboxList.change(function () {

        var selected = new Array();
        localStorage.setItem("tickets", 0);

        $("input:checkbox:checked").each(function () {
            selected[selected.length] = $(this).val();
            localStorage.setItem("tickets", selected);
        });

        ActualizaSeleccionados();
    });

    // Funciones
    function ActualizaSeleccionados() {


        var seleccionados = GetChecked().length;
        var todos = checkboxList.length;
        divSeleccionados.text(seleccionados + " registro/s de " + todos);
    }

    // Se ejecuta una sola vez al principio
    function GetAllCheckbox() {
        return tbTickets.find(':checkbox');
    }

    // Se ejecuta cada vez porque puede cambiar    
    function GetChecked() {
        return tbTickets.find(':checked');
    }

    // Inicial
    ActualizaSeleccionados();
}

function imprimir() {
    $('#BotonConfirmarReporte').hide();


    $('#pie_pagina').show();

    javascript: window.print();
    $('#BotonConfirmarReporte').show();
    $('#botonImprimirReporte').show();

}

//_________________________________---------------------------
function historicoHorasMensuales(contrato_reporte) {
    var nombre_contrato = "";
    $.ajax({
        url: "?controlador=Reporte&accion=obteneCasosPorNombreContrato",
        type: "GET",
        data: { nombre_contrato: contrato_reporte },
        success: function (response) {
            ContratoObtenido = JSON.parse(response);
            var html = '';
            for (let i = 0; i < ContratoObtenido.data.length; i++) {

                var f_h= ContratoObtenido.data[i][2];
                var fechacompuesta_h= f_h.split(' ');

                html += '<tr>';
                html += '<td>' + ContratoObtenido.data[i][0] + '</td>';
                html += '<td>' + ContratoObtenido.data[i][1] + '</td>';
                html += '<td>' + fechacompuesta_h[0] + '</td>';
                html += '</tr>';

            }

            $('#horas-meses-consumidas-tbody').html(html);
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

function CargandoCasos() {


    let timerInterval
    Swal.fire({
        title: 'Consultando casos',
        html: 'Un momento...',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
}

function generandoReporteExitoso() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,

    })

    Toast.fire({
        icon: 'success',
        title: 'Reporte generado con exito'
    })
}