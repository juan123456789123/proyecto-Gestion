<?php
// session_start();

include_once 'public/header.php';
?>



<div id="main" class="container container-body ">

    <div class="row">
        <div class="col-lg-8">
            <h1>Lista de Casos</h1>
        </div>


    </div>

    <hr>

    <div class="table-responsive-sm ">
        <table id="casos-table" class="table table-light table-hover table-bordered schedule-table">
            <caption>Lista de Reportes</caption>
            <thead class="bg-dark text-white">
                <tr>
                    <th>Contrato</th>
                    <th>Tickets</th>
                    <th>Incidencias</th>
                    <th>Horas</th>
                    <th>Fecha de reporte</th>
                    <th>Volver a generar</th>
                </tr>
            </thead>

            <tbody id="casos-tbody">

            </tbody>

            <tfoot>
                <tr>
                    <th>Contrato</th>
                    <th>Tickets</th>
                    <th>Incidencias</th>
                    <th>Horas</th>
                    <th>Fecha de reporte</th>
                    <th >Volver a generar</th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>
</div>
<div>

    <br />
    <br />
    <br />
    <br />


    <?php
    include_once 'public/footer.php';
    ?>