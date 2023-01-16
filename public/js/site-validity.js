$(document).ready(function () {
    ObtenerEstado();
});

//--------------------------------------------------------------------------------------------------------

function ObtenerEstado() {
    var validacion = parseInt($('#estado_modi').val());

    $.ajax({
        url: "?controlador=Estado&accion=listarEstados",
        type: "GET",
        success: function (response) {
            Estado = JSON.parse(response);
            var html = '';
            for (let i = 0; i < Estado.data.length; i++) {
                if(validacion !== Estado.data[i][0]){
                    html += '<option value="' + Estado.data[i][0] + '" id="' + Estado.data[i][0] + '">' + Estado.data[i][1] + '</option>';

                }
            }
            $('#estado').append(html);   
            $('#estado_modi').append(html);   
        },
        error: function (errorMessage) {
            alert(errorMessage.responseText);
        }
    });
}

//--------------------------------------------------------------------------------------------------------

function validarNumeros(evento) {
    tecla = (document.all) ? evento.keyCode : evento.which;
    if ((tecla > 47 && tecla < 58) || tecla === 8 || tecla === 13 || tecla === 6) {
    return true;
    } else {
    return false;
    }
    }