<?php
session_start();
include_once 'public/header.php';
?>



<div id="main" class="container container-body">

    <div class="row">
        <div class="col-lg-8">
            <h1>Lista de Contratos</h1>
        </div>

        <div class="col-lg-4 text-center">
            <form action="" id="contract-entry-form">
                <a class="btn btn-success" href="?controlador=Contrato&accion=accionMostrarAgregarContrato">Agregar Contrato</a>
            </form>
        </div>
    </div>


    <hr>

    <div class="table-responsive-sm">
        <table id="contrato-table" class="table table-light table-hover table-bordered schedule-table">
            <caption>Lista de datos</caption>
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Nombre Contrato</th>
                    <th>Nombre del cliente</th>
                    <th>Horas disponibles</th>
                    <th>Fecha final</th>
                    <th>Estado</th>
                    <th style=text-align:center;>Acciones</th>
                </tr>
            </thead>

            <tbody id="contrato-tbody">

            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nombre Contrato</th>
                    <th>Nombre del cliente</th>
                    <th>Horas disponibles</th>
                    <th>Fecha final</th>
                    <th>Estado</th>
                    <th style=text-align:center;>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>

<div>

    <!-- Modal eliminar -->
    <div class="modal fade model-eliminar" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modelEliminar text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Contrato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyEliminarInfo" class="modal-body">

                </div>
                <div id="bodyEliminar">
                    <label id="idcontrato" hidden></label>
                </div>
                <div class="modal-footer">
                    <label id="modalResult-contrato"></label>
                    <button type="button" class="btn btn-success" onclick="return EliminarContrato();" data-dismiss="modal">Eliminar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal info-->
    <div class="modal fade model-info" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" ;>
                    <h5 class="modal-title" id="exampleModalLongTitle">Información de contrato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodyInfo" class="modal-body">

                </div>
                <div class="modal-footer">
                    <label id="modalResult-contrato"></label>
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