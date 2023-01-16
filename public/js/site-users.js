$(document).ready(function () {
    CargarUsuarios();
    $(document).on('submit', '#user-entry-form', function () {

        if ($('#iduser').val() !== null) {

            AgregarUsuario();
        } else {
            return false;

        }
        return false;
    });


    $(document).on('submit', '#user-update-entry-form', function () {

        if ($('#id_usuario_modi').val() !== null) {
            ActualizarUsuario();
        } else {
            return false;
        }
        return false;
    });
});

// ------------------------------------------------------------------------------------------------------

function CargarUsuarios() {
    $.ajax({
        url: "?controlador=Usuario&accion=listarUsuarios",
        type: "GET",
        success: function (response) {
            Usuario = JSON.parse(response);

            var html = '';
            for (let i = 0; i < Usuario.data.length; i++) {

                html += '<tr>';
                html += '<td>' + Usuario.data[i][0] + '</td>';
                html += '<td>' + Usuario.data[i][1] + '</td>';
                html += '<td>' + Usuario.data[i][2] + '</td>';
                html += '<td>' + Usuario.data[i][3] + '</td>';
                html += '<td>' + Usuario.data[i][4] + '</td>';
                html += '<td>' + Usuario.data[i][5] + '</td>';
                html += '<td  class="acciones"><form method="post" action="?controlador=Usuario&accion=modificarUsuario"><input type="hidden" id="' + Usuario.data[i][0] + '" name="id" value= "' + Usuario.data[i][0] + '"><button type="submit" class="btn btn-success"><i class="fas fa-pen-square"></i></button></form>  | <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenterUsuario" onclick="ObtenerUsuarioAEliminar(\'' + Usuario.data[i][0] + '\')"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
            }
            $('#usuario-tbody').html(html);

            $(document).ready(function () {
                $('#usuario-table').DataTable();
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

// ------------------------------------------------------------------------------------------------------

function ObtenerUsuarioAEliminar(iduser) {

    var id = "";
    $.ajax({
        url: "?controlador=Usuario&accion=obtenerUsuarioPorID",
        type: "GET",
        data: { id: iduser },
        success: function (response) {
            UsuarioObtenido = JSON.parse(response);
            var html = '';
            for (let i = 0; i < UsuarioObtenido.data.length; i++) {
                html += '<h5>¿Desea eliminar el usuario: <label id="nombreUsuario">' + UsuarioObtenido.data[i][1] + '</label>?</h5>'
                $('#idusuario').val(UsuarioObtenido.data[0][0]);

            }
            $('#bodyEliminarInfoUsuario').html(html);
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
function EliminarUsuario() {

    var id = document.getElementById("idusuario").value;
    $.ajax({
        url: "?controlador=Usuario&accion=eliminarUsuarioPorID",
        type: "GET",
        data: { id: id },
        success: function (response) {
            CargarUsuarios();
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
// ----------------------------------------------------------------------

function AgregarUsuario() {
    var usuario_in = {
        username: $('#nombre_usuario').val(),
        contrasena: $('#contrasenna').val(),
        name: $('#nombre').val(),
        lastname: $('#apellidos').val(),
        ID_: $('#identificacion').val(),
        IDvalidity: parseInt($('#estado').val()),

    };

    var EstadoValido = parseInt($('#estado').val())


    if (isNaN(EstadoValido) == true) {
        $('#estado_escoger').show();
        $('#estado_escoger').text("*Escoja un estado*");
        $('#estado_escoger').css('color', 'red');
    }
    else if (usuario_in != null) {

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=agregarUsuario",
            data: usuario_in,
            success: function (result) {


                $('#nombre_usuario').val('');
                $('#contrasenna').val('');
                $('#apellidos').val('');
                $('#identificacion').val('');
                $('#nombre').val('');
                $('#estado').val('');
                exitoUsuario();
            },
            error: function (errorMessage) {
                if (errorMessage === "no connection") {
                    Swal.fire(
                        'Error en la conexión',
                        'Favor verificar la conexión',
                        'error'
                    );
                }
                $('#contrasenna').val('');
                Swal.fire(
                    'Error al registrar',
                    'Verifique los datos',
                    'error'
                );
            }
        });

    }
}


// -------------------------------------

function ActualizarUsuario() {
    var usuario_modi = {
        id_User_modi: parseInt($('#id_usuario_modi').val()),
        username_modi: $('#nombre_usuario_modi').val(),
        contrasena_modi: $('#contrasena_modi').val(),
        name_modi: $('#nombre_modi').val(),
        lastname_modi: $('#apellidos_modi').val(),
        ID_modi: $('#ID_modi').val(),
        estado_modi: parseInt($('#estado_modi').val())
    };

    var EstadoValido = parseInt($('#estado_modi').val())

    if (isNaN(EstadoValido) == true) {
        $('#estado_escoger').show();
        $('#estado_escoger').text("*Escoja un estado*");
        $('#estado_escoger').css('color', 'red');
    }
    else if (usuario_modi != null) {

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=actualizarUsuario",
            data: usuario_modi,
            success: function (result) {
                exitoUsuarioModi();
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
                            'Error al actualizar',
                            'Verifique los datos',
                            'error'
                        );
            }
        });

    }
}



function exitoUsuario() {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })

    Toast.fire({
        icon: 'success',
        title: 'Usuario guardado con éxito'
    });

}

function exitoUsuarioModi(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })

    Toast.fire({
        icon: 'success',
        title: 'Usuario modificado con éxito'
    });
}

