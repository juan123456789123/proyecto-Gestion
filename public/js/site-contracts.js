$(document).ready(function () {
    $('.select').select2();

    CargarContratos();

    $(document).on('submit', '#contract-entry-form', function () {

        if ($('#idcontract').val() !== null) {
            AgregarContrato();
        } else {
            return false;
        }
        return false;
    });

    $(document).on('submit', '#contract-update-entry-form', function () {

        if ($('#id_contrato_modi').val() !== null) {
            ActualizarContrato();
        } else {
            return false;
        }
        return false;
    });

});

// ------------------------------------------------------------------------------------------------------

function CargarContratos() {
    $.ajax({
        url: "?controlador=Contrato&accion=listarContrato",
        type: "GET",
        success: function (response) {
            Contrato = JSON.parse(response);

            var html = '';
            for (let i = 0; i < Contrato.data.length; i++) {

                html += '<tr>';
                html += '<td>' + Contrato.data[i][0] + '</td>';
                html += '<td>' + Contrato.data[i][1] + '</td>';
                html += '<td>' + Contrato.data[i][2] + '</td>';
                html += '<td>' + Contrato.data[i][5] + '</td>';
                html += '<td>' + Contrato.data[i][7] + '</td>';
                html += '<td>' + Contrato.data[i][8] + '</td>';
                html += '<td class="acciones"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#infoModal" onclick="ObtenerContratoPorId(\'' + Contrato.data[i][0] + '\')"><i class="fas fa-info-circle"></i></button> | <form method="post" action="?controlador=Contrato&accion=modificarContrato"><input type="hidden" id="' + Contrato.data[i][0] + '" name="id" value= "' + Contrato.data[i][0] + '"><button type="submit" class="btn btn-success"><i class="fas fa-pen-square"></i></button></form> | <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal" onclick="ObtenerContratoAEliminar(\'' + Contrato.data[i][0] + '\')"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
            }
            $('#contrato-tbody').html(html);

            $(document).ready(function () {
                $('#contrato-table').DataTable();
            });

        },
        error: function (errorMessage) {
            Swal.fire(
                'Error en la conexión',
                'Favor verificar la conexión',
                'warning'
            );
        }
    });
}

// -------------------------------------------------------------------------------------------------------

function ObtenerContratoPorId(idContract) {

    var id = "";
    $.ajax({
        url: "?controlador=Contrato&accion=obtenerContratoPorID",
        type: "GET",
        data: { id: idContract },

        success: function (response) {
            ContratoObtenido = JSON.parse(response);
            var html = '';
            for (let i = 0; i < ContratoObtenido.data.length; i++) {

                html += '<h5>Nombre del contrato: <label id="nombreContrato">' + ContratoObtenido.data[i][1] + '</label></h5>'
                html += '<h5>Nombre del cliente: <label id="nombreCliente">' + ContratoObtenido.data[i][2] + '</label></h5>'
                html += '<h5>Tipo de contrato: <label id="tipoContrato">' + ContratoObtenido.data[i][3] + '</label></h5>'
                html += '<h5>Horas contratadas: <label id="horasContrato">' + ContratoObtenido.data[i][4] + '</label></h5>'
                html += '<h5>Horas disponibles: <label id="horasDisponibles">' + ContratoObtenido.data[i][5] + '</label></h5>'
                html += '<h5>Fecha de inicio del contrato: <label id="fechaInicio">' + ContratoObtenido.data[i][6] + '</label></h5>'
                html += '<h5>Fecha de cierre: <label id="fechaFinal">' + ContratoObtenido.data[i][7] + '</label></h5>'
                html += '<h5>Orden de compra: <label id="orden_compra">' + ContratoObtenido.data[i][10] + '</label></h5>'
                html += '<h5>Descripción: <label id="descripcion">' + ContratoObtenido.data[i][9] + '</label></h5>'
                html += '<h5>Estado: <label id="estadoContrato">' + ContratoObtenido.data[i][8] + '</label></h5>'



            }
            $('#bodyInfo').html(html);

        },
        error: function (errorMessage) {
            if (errorMessage === "no connection") {
                Swal.fire(
                    'Error en la conexión',
                    'Favor verificar la conexión',
                    'error'
                );
            }
            Swal.fire(
                'Error en los datos',
                'Favor verificar los datos',
                'error'
            );
        }
    });
}

// -------------------------------------------------------------------------------------------------------

function ObtenerContratoAEliminar(idContract) {

    var id = "";
    $.ajax({
        url: "?controlador=Contrato&accion=obtenerContratoPorID",
        type: "GET",
        data: { id: idContract },
        success: function (response) {
            ContratoObtenido = JSON.parse(response);
            var html = '';
            for (let i = 0; i < ContratoObtenido.data.length; i++) {
                html += '<h5>¿Desea eliminar el contrato: <label id="nombreContrato">' + ContratoObtenido.data[i][1] + '</label>?</h5>'
                $('#idcontrato').val(ContratoObtenido.data[0][0]);

            }
            $('#bodyEliminarInfo').html(html);
        },
        error: function (errorMessage) {
            if (errorMessage === "no connection") {
                Swal.fire(
                    'Error en la conexión',
                    'Favor verificar la conexión',
                    'error'
                );
            }
            Swal.fire(
                'Error en los datos',
                'Favor verificar los datos',
                'error'
            );
        }
    });
}

// -------------------------------------------------------------------------------------------------------

function EliminarContrato() {
    var id = document.getElementById("idcontrato").value;
    $.ajax({
        url: "?controlador=Contrato&accion=eliminarContratoPorID",
        type: "GET",
        data: { id: id },
        success: function (response) {
            CargarContratos();
        },
        error: function (errorMessage) {
            if (errorMessage === "no connection") {
                Swal.fire(
                    'Error en la conexión',
                    'Favor verificar la conexión',
                    'error'
                );
            }
            Swal.fire(
                'Error en los datos',
                'Favor verificar los datos',
                'error'
            );
        }
    });
}

// -------------------------------------------------------------------------------------------------------

function AgregarContrato() {

    var existe = "no";
    $('#cliente_escoger').val('');

    var contrato_in = {
        nombre_contrato: $('#nombre_contrato').val(),
        IDcliente: parseInt($('#cliente').val()),
        tipo_Contrato: $('#tipo_Contrato').val(),
        horas_contratadas: parseInt($('#horas_contratadas').val()),
        fecha_inicio: $('#fecha_inicio').val(),
        fecha_finalizacion: $('#fecha_finalizacion').val(),
        estado: parseInt($('#estado').val()),
        detalle: $('#descripcion').val(),
        orden: $('#orden_compra').val(),
    };
    var nombre_contratoExiste = $('#nombre_contrato').val()
    var EstadoValido = parseInt($('#estado').val())
    var ClienteValido = parseInt($('#cliente').val())

    if (isNaN(EstadoValido) == true || isNaN(ClienteValido) == true) {

        if (isNaN(EstadoValido) == true) {
            $('#estado_escoger').show();
            $('#estado_escoger').text("*Seleccione un estado*");
            $('#estado_escoger').css('color', 'red');
        } else if (isNaN(EstadoValido) == false) {
            $('#estado_escoger').show();
            $('#estado_escoger').text('');
            // $('#estado_escoger').val('');
        }
        if (isNaN(ClienteValido) == true) {
            $('#cliente_escoger').show();
            $('#cliente_escoger').text("*Seleccione un cliente*");
            $('#cliente_escoger').css('color', 'red');
        } else if (isNaN(ClienteValido) == false) {
            $('#cliente_escoger').show();
            $('#cliente_escoger').text('');
            // $('#cliente_escoger').val('');
        }

    }
    else if (contrato_in != null) {
        $('#cliente_escoger').text('');
        $('#estado_escoger').text('');

        ///---------------------

        $.ajax({
            url: "?controlador=Contrato&accion=listarContrato",
            type: "GET",
            success: function (response) {
                Contrato = JSON.parse(response);

                for (let i = 0; i < Contrato.data.length; i++) {

                    if (Contrato.data[i][1] === nombre_contratoExiste) {
                        Swal.fire(
                            'Error al registrar',
                            'El contrato ya existe',
                            'error'
                        );
                       
                        existe = "si";
                    }
                    else {
                        existe = "no";
                    }
                }
            },
            error: function (errorMessage) {
                Swal.fire(
                    'Error en la conexión',
                    'Favor verificar la conexión',
                    'error'
                );
            }
        });

        if (existe == "no") {
            ///------------
            $.ajax({
                type: "POST",
                url: "?controlador=Contrato&accion=agregarContrato",
                data: contrato_in,
                success: function (result) {
                    $('#nombre_contrato').val('');
                    $('#cliente').val('').trigger('change.select2');
                    $('#tipo_Contrato').val('');
                    $('#horas_contratadas').val('');
                    $('#fecha_inicio').val('');
                    $('#fecha_finalizacion').val('');
                    $('#estado').val('');
                    $('#descripcion').val('');
                    $('#orden_compra').val('');
                    exitoContrato();
                },
                error: function (errorMessage) {
                    if (errorMessage === "no connection") {
                        Swal.fire(
                            'Error en la conexión',
                            'Favor verificar la conexión',
                            'error'
                        );
                    }
                    Swal.fire(
                        'Error al agregar contrato',
                        'Verifique los datos',
                        'error'
                    );
                }
            });
        }
    }
}


// -------------------------------------------------------------------------------------------------------

function ActualizarContrato() {
    var existe = "no";
    var contrato_modi = {
        id_contrato_modi: parseInt($('#id_contrato_modi').val()),
        nombre_contrato_modi: $('#nombre_contrato_modi').val(),
        tipo_Contrato_modi: $('#tipo_Contrato_modi').val(),
        horas_contratadas_modi: parseInt($('#horas_contratadas_modi').val()),
        fecha_inicio_modi: $('#fecha_inicio_modi').val(),
        fecha_finalizacion_modi: $('#fecha_finalizacion_modi').val(),
        horas_disponibles_modi: parseInt($('#horas_disponibles_modi').val()),
        estado_modi: parseInt($('#estado_modi').val()),
        detalle_modi: $('#descripcion_modi').val(),
        orden_modi: $('#orden_compra_modi').val(),
    };
    var id_contrato_modi_Existe = parseInt($('#id_contrato_modi').val());
    var nombre_contrato_modi_Existe = $('#nombre_contrato_modi').val();
    var EstadoValido = parseInt($('#estado_modi').val())

    if (isNaN(EstadoValido) == true) {
        $('#estado_escoger').show();
        $('#estado_escoger').text("*Escoja un estado*");
        $('#estado_escoger').css('color', 'red');
    }
    else if (contrato_modi != null) {

        //------------

        $.ajax({
            url: "?controlador=Contrato&accion=listarContrato",
            type: "GET",
            success: function (response) {
                Contrato = JSON.parse(response);
                var entra = "no";
                for (let i = 0; i < Contrato.data.length; i++) {
                    if (Contrato.data[i][0] !== id_contrato_modi_Existe && Contrato.data[i][1] === nombre_contrato_modi_Existe) {
                        Swal.fire(
                            'Error al modificar',
                            'El nombre del contrato ya existe en otro contrato',
                            'error'
                        );
                        existe = "si";
                        entra = "si";
                    }
                    else {
                        existe = "no";
                    }


                }
            },
            error: function (errorMessage) {
                  Swal.fire(
                            'Error en la conexión',
                            'Favor verificar la conexión',
                            'error'
                        );
            }
        });

        if (existe == "no") {

            //------------

            $.ajax({
                type: "POST",
                url: "?controlador=Contrato&accion=actualizarContrato",
                data: contrato_modi,
                success: function (result) {
                    exitoContratoModi();
                },
                error: function (errorMessage) {
                    if (errorMessage === "no connection") {
                        Swal.fire(
                            'Error en la conexión',
                            'Favor verificar la conexión',
                            'error'
                        );
                    }
                    if (entra = "si") {


                    } else {
                        Swal.fire(
                            'Error al actualizar',
                            'Verifique los datos',
                            'error'
                        );
                    }
                }
            });
        }

    }
}

// -------------------------------------------------------------------------------------------------------
function exitoContrato() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
       
      })

      Toast.fire({
        icon: 'success',
        title: 'Contrato guardado con éxito'
      });

}

 function exitoContratoModi(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
       
      })

      Toast.fire({
        icon: 'success',
        title: 'Contrato modificado con éxito'
      });
 }
