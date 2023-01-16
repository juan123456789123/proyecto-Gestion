<?php
session_start();
include_once 'public/header.php';
?>



<div id="main" class="container container-body ">

    <div class="row">
        <div class="col-lg-8">
            <h1>Lista de Clientes</h1>
        </div>

        <div class="col-lg-4 text-center">
            <form action="" id="client-entry-form">
                <a class="btn btn-success" href="?controlador=Cliente&accion=accionAgregarCliente">Agregar Cliente</a>
            </form>
        </div>
    </div>

    <hr>

    <div class="table-responsive-sm ">
        <table id="cliente-table" class="table table-light table-hover table-bordered schedule-table">
            <caption>Lista de datos</caption>
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Institución</th>
                    <th>Nombre OTOBO</th>
                    <th>Estado</th>
                    <th style=text-align:center;>Acciones</th>
                </tr>
            </thead>

            <tbody id="cliente-tbody">

            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Institución</th>
                    <th>Nombre OTOBO</th>
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
    <div class="modal fade model-eliminar" id="exampleModalCenterCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modelEliminar text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyEliminarInfoCliente" class="modal-body">

                </div>
                <div id="bodyEliminarCliente">
                    <label id="idcliente" hidden></label>
                </div>
                <div class="modal-footer">
                    <label id="modalResult-cliente"></label>
                    <button type="button" class="btn btn-success" onclick="return EliminarCliente();" data-dismiss="modal">Eliminar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <br />
    <br />
    <br />
    <br />

</div>




<?php
include_once 'public/footer.php';
?>