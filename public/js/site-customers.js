$(document).ready(function () {
    CargarClientes();
    ObtenerClientes();

    $(document).on('submit', '#customer-entry-form', function () {

        if ($('#idcustomer').val() !== null) {

            AgregarCliente();

        } else {

            return false;

        }
        return false;
    });

    $(document).on('submit', '#customer-update-entry-form', function () {

        if ($('#id_cliente_modi').val() !== null) {
            ActualizarCliente();
        } else {
            return false;
        }
        return false;
    });
});

// ------------------------------------------------------------------------------------------------------

function CargarClientes() {
    $.ajax({
        url: "?controlador=Cliente&accion=listarClientes",
        type: "GET",
        success: function (response) {
            Cliente = JSON.parse(response);

            var html = '';
            for (let i = 0; i < Cliente.data.length; i++) {

                html += '<tr>';
                html += '<td>' + Cliente.data[i][0] + '</td>';
                html += '<td>' + Cliente.data[i][1] + '</td>';
                html += '<td>' + Cliente.data[i][2] + '</td>';
                html += '<td>' + Cliente.data[i][3] + '</td>';
                html += '<td>' + Cliente.data[i][4] + '</td>';
                html += '<td>' + Cliente.data[i][5] + '</td>';
                html += '<td class="acciones"><form method="post" action="?controlador=Cliente&accion=modificarCliente"><input type="hidden" id="' + Cliente.data[i][0] + '" name="id" value= "' + Cliente.data[i][0] + '"><button type="submit" class="btn btn-success"><i class="fas fa-pen-square"></i></button></form>  | <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenterCliente" onclick="ObtenerClienteAEliminar(\'' + Cliente.data[i][0] + '\')"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
            }
            $('#cliente-tbody').html(html);

            $(document).ready(function () {
                $('#cliente-table').DataTable();
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


function ObtenerClientes() {

    $.ajax({
        url: "?controlador=Cliente&accion=listarClientes",
        type: "GET",
        success: function (response) {
            listaCliente = JSON.parse(response);
            var html = '';
            for (let i = 0; i < listaCliente.data.length; i++) {
                html += '<option value="' + listaCliente.data[i][0] + '" id="' + listaCliente.data[i][0] + '">' + listaCliente.data[i][4] + '</option>';
            }
            $('#cliente').append(html);
        },
        error: function (errorMessage) {
            Swal.fire(
                'Error en la conexión',
                'Favor verificar la conexión',
                'error'
            );
        }
    });
}

//--------------------------------------------------------------------------------------------------------
function AgregarCliente() {
    var existe = "no";

    var cliente_in = {
        customer_name: $('#nombre_cliente').val(),
        responsible_name: $('#nombre_responsable').val(),
        institution_name: $('#nombre_institucion').val(),
        otobo_name: $('#nombre_OTOBO').val(),
        IDvalidity: parseInt($('#estado').val()),

    };

    var otobo_nameExiste = $('#nombre_OTOBO').val()
    var EstadoValido = parseInt($('#estado').val())

    if (isNaN(EstadoValido) == true) {
        $('#estado_escoger').show();
        $('#estado_escoger').text("*Escoja un estado*");
        $('#estado_escoger').css('color', 'red');
    }
    else if (cliente_in != null) {
        $.ajax({
            url: "?controlador=Cliente&accion=listarClientes",
            type: "GET",
            success: function (response) {
                Cliente = JSON.parse(response);
                var entra = "no";
                for (let i = 0; i < Cliente.data.length; i++) {

                    if (Cliente.data[i][4] === otobo_nameExiste) {
                        Swal.fire(
                            'Error al registrar',
                            'El nombre referenciado de OTOBO ya se ecuentra registrado',
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
            $.ajax({
                type: "POST",
                url: "?controlador=Cliente&accion=agregarCliente",
                data: cliente_in,
                success: function (result) {


                    $('#nombre_cliente').val('');
                    $('#nombre_responsable').val('');
                    $('#nombre_institucion').val('');
                    $('#nombre_OTOBO').val('');
                    $('#estado').val('');
                    exitocliente();
                },
                error: function (errorMessage) {
                    if (errorMessage === "no connection") {
                        Swal.fire(
                            'Error en la conexión',
                            'Favor verificar la conexión',
                            'error'
                        );
                    }
                    if (entra == "si") {
                    } else {

                        Swal.fire(
                            'Error al agregar cliente',
                            'Verifique los datos',
                            'error'
                        );
                    }
                }
            });
        }

    }
}

function ObtenerClienteAEliminar(idcustomer) {

    var id = "";
    $.ajax({
        url: "?controlador=Cliente&accion=obtenerClientePorID",
        type: "GET",
        data: { id: idcustomer },
        success: function (response) {
            ClienteObtenido = JSON.parse(response);
            var html = '';
            for (let i = 0; i < ClienteObtenido.data.length; i++) {
                html += '<h5>¿Desea eliminar el Cliente: <label id="nombreCliente">' + ClienteObtenido.data[i][1] + '</label>?</h5>'
                $('#idcliente').val(ClienteObtenido.data[0][0]);

            }
            $('#bodyEliminarInfoCliente').html(html);
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
//----------------------------------------------------------------
function EliminarCliente() {

    var id = document.getElementById("idcliente").value;
    $.ajax({
        url: "?controlador=Cliente&accion=eliminarClientePorID",
        type: "GET",
        data: { id: id },
        success: function (response) {
            CargarClientes();
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

function ActualizarCliente() {
    var existe = "no";
    var cliente_modi = {
        IDcustomer_modi: parseInt($('#id_cliente_modi').val()),
        customer_name_modi: $('#nombre_cliente_modi').val(),
        responsible_name_modi: $('#nombre_responsable_modi').val(),
        institution_name_modi: $('#nombre_institucion_modi').val(),
        otobo_name_modi: $('#nombre_otobo_modi').val(),
        IDvalidity_modi: parseInt($('#estado_modi').val())
    };
    var IDcustomer_modi_existe = parseInt($('#id_cliente_modi').val());
    var otobo_name_modi_existe = $('#nombre_otobo_modi').val();

    var EstadoValido = parseInt($('#estado_modi').val())


    if (isNaN(EstadoValido) == true) {
        $('#estado_escoger').show();
        $('#estado_escoger').text("*Escoja un estado*");
        $('#estado_escoger').css('color', 'red');
    }
    else if (cliente_modi != null) {
        //-----

        $.ajax({
            url: "?controlador=Cliente&accion=listarClientes",
            type: "GET",
            success: function (response) {
                Cliente = JSON.parse(response);
                var entra = "no";
                for (let i = 0; i < Cliente.data.length; i++) {

                    if (Cliente.data[i][0] !== IDcustomer_modi_existe && Cliente.data[i][4] === otobo_name_modi_existe) {
                        Swal.fire(
                            'Error al registrar',
                            'El nombre referenciado de OTOBO ya se ecuentra registrado para otro cliente',
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
                    'Error en los datos',
                    'Favor verificar los datos',
                    'error'
                );
            }
        });
        if (existe == "no") {
            $.ajax({
                type: "POST",
                url: "?controlador=Cliente&accion=actualizarCliente",
                data: cliente_modi,
                success: function (result) {
                    exitoclienteModi();
                },
                error: function (errorMessage) {
                    if (errorMessage === "no connection") {
                        Swal.fire(
                            'Error en la conexión',
                            'Favor verificar la conexión',
                            'error'
                        );
                    }

                    if (entra == "si") {

                    }
                    else {

                        Swal.fire(
                            'Error al actualizar',
                            'Verifique los datos',
                            'error'
                        );;
                    }
                }
            });
        }

    }
}


function exitocliente() {

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

function exitoclienteModi(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })

    Toast.fire({
        icon: 'success',
        title: 'Cliente modificado con éxito'
    });
}

