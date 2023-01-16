<?php
session_start();
include_once 'public/header.php';
?>

<br />
<br />
<br />

<div class="section" id="seccion-busqueda">
    <div class="row">
        <div class="col-lg-3">
            <h3 class="mt-4 mb-3">Busqueda de casos</h3>
            <form action="" id="ticket-entry-form">
                <input type="text" name="idreporte" id="idreporte" hidden>
                <label for="cliente">Cliente </label>
                <select class="form-control without-margin select" name="nombre_cliente" id="nombre_cliente">
                    <option value="">--Seleccione un cliente--</option>
                </select>
                <small id="helpCliente"></small>
                <br />
                <br>
                <label for="contrato">Contratos </label>
                <select class="form-control without-margin select" name="nombre_contrato" id="nombre_contrato">
                </select>
                <small id="helpContrato"></small>
                <br />
                <br>
                <label for="fecha_inicio">Fecha inicio</label>
                <input id="fecha_inicio" class="form-control" type="date" />
                <small id="helpInicio"></small>
                <br />
                <label for="fecha_final">Fecha final</label>
                <input id="fecha_final" class="form-control" type="date" />
                <small id="helpFinal"></small>
                <hr>
                <div class="text-center">
                    <button type="submit" class="center btn btn-success" onsubmit="return BuscarTickets();">Buscar</button>
                </div>
            </form>
        </div>

        <div class="col-lg-9">
            <h2 class="mt-4 mb-3">Lista de casos</h2>


            <div class="container">
                <div class="row">
                    <div class="table-responsive text-black">
                        <table class="text-black table table-bordered schedule-table" id="ticket-table">
                            <caption>Lista de datos</caption>
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="btnCheckTodos" value="todos" name="cb">
                                    </th>
                                    <th>
                                        Numero de ticket
                                    </th>
                                    <th>
                                        Actividad
                                    </th>
                                    <th>
                                        Cliente
                                    </th>
                                    <th>
                                        tipo
                                    </th>
                                    <th>
                                        Última fecha
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="tickets-tbody">

                            </tbody>

<!-- cuerpo -->
                        </table>
                        <div id="divSeleccionados"></div>
                        <small id="helpTicket"></small>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-8">
                    <h3 class="centrar" id="resultBusqueda"></h3>
                </div>

                <div class="col-lg-4 text-center">
                    <form method="" action="" id="reporte-entry-form">
                        <input type="hidden" id="IDtickets" hidden>
                        <button type="submit" id="enviar" class="center btn btn-success" onsubmit="return GeneraReporte();">Generar reporte</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <br />
    <hr>
    <br />

</div>


<!-- <br><br> -->
<!-- background-image: url(public/img/PlantillaVerticalVentas.png);-->

<!-- <div class="fondo" id="fondos" style="background-image: url(public/img/PlantillaVerticalVentas\ .png); background-attachment: local;background-size: 100%; background-repeat: no;"> -->
<!-- <img src="public/img/PlantillaVerticalVentas .png"  width="100%"  height="100px"> -->

<div class="section" id="cabecera"></div>


<br><br>

<div class="section" id="cuerpo-impresion">

    <div class="section" id="seccion-encabezado">

    </div>

    <div class="section" id="seccion-politicas">

    </div>

    <div class="section" id="seccion-intro">

    </div>

    <div class="section" id="seccion-resumen-consumidas">

    </div>

    <div id="seccion-resumen-horas-consumidas" class="section col-lg-12" style=text-align:center;>

    </div>

    <div class="section col-lg-12" style=text-align:center; id="seccion-resumen-contratadas">

    </div>

    <div class="section" id="historico_horas_mes">

    </div>
    <div class="section" id="resumen_historico_horas_mes">

    </div>

    <div class="section" id="seccion-incidencias">

    </div>

    <div class="section col-lg-12" id="seccion-total-incidencias">

    </div>


    <div class="section col-lg-12" id="seccion-confirmar">

    </div>
</div>


<div class="" id="pie_pagina" style="visibility: hidden;"></div>


</div>

<script src="public/js/check-tickets.js"></script>



<?php
include_once 'public/footer.php';
?>