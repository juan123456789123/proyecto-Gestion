<?php
session_start();
include_once 'public/header.php';
?>



<div id="main" class="container container-body">

    <div class="row">
        <div class="col-lg-8">
            <h1>Lista de Usuarios</h1>
        </div>

        <div class="col-lg-4 text-center">
            <form action="" id="user-entry-form">
                <a class="btn btn-success" href="?controlador=Usuario&accion=accionAgregarUsuario">Agregar Usuario</a>
            </form>
        </div>
    </div>


    <hr>

    <div class="table-responsive-sm">
        <table id="usuario-table" class="table table-light table-hover table-bordered schedule-table">
            <caption>Lista de datos</caption>
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Estado</th>
                    <th style=text-align:center;>Acciones</th>
                </tr>
            </thead>

            <tbody id="usuario-tbody">

            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Estado</th>
                    <th style=text-align:center;>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>
</div>
<div>

    <!-- Modal -->
    <div class="modal fade model-eliminar" id="exampleModalCenterUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modelEliminar text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyEliminarInfoUsuario" class="modal-body">

                </div>
                <div id="bodyEliminarUsuario">
                    <label id="idusuario" hidden></label>
                </div>

                <div class="modal-footer">
                    <label id="modalResult-usuario"></label>
                    <button type="button" class="btn btn-success" onclick="return EliminarUsuario();" data-dismiss="modal">Eliminar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>

                </div>
            </div>
        </div>
    </div>
</div>

<br />
<br />
<br />
<br />


<?php
include_once 'public/footer.php';
?>