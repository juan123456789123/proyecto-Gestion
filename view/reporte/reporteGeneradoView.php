<?php
session_start();
include_once 'public/header.php';
?>
<br />
<br />
<br />
<br />
<br />

<?php
foreach ($vars['registro'] as $item) {
?>

    <input type="hidden" name="otobo_customer" id="otobo_customer" value="<?php echo $item[0] ?>" required>
    <input type="hidden" name="contract_name" id="contract_name" value="<?php echo $item[1] ?>" required>
    <input type="hidden" name="init_date" id="init_date" value="<?php echo $item[2] ?>" required>
    <input type="hidden" name="final_date" id="final_date" value="<?php echo $item[3] ?>" required>
    <input type="hidden" name="ID_tickets" id="ID_tickets" value="<?php echo $item[4] ?>" required>
    <input type="hidden" name="previous_hours" id="previous_hours" value="<?php echo $item[5] ?>" required>
    <input type="hidden" name="current_hours" id="current_hours" value="<?php echo $item[6] ?>" required>
    <input type="hidden" name="date_case" id="date_case" value="<?php echo $item[7] ?>" required>

<?php
}
?>

<div class="section" id="cabecera_regenerado">
    <div id="cabezaPagina_regenerado" class="fixed-top" style="visibility:hidden;">
        <img src="public/img/encabezado.png" width="100%" height="30%">
    </div>
</div>

<div class="section" id="cuerpo-impresion_regenerado">


    <div class="section" id="seccion-encabezado_regenerado">
        <div id="encabezado_regenerado">
            <div class="col-lg-12 text-center">
                <h5><b>Reporte mensual Labores Realizadas</b></h5>
                <h5><b>por Greencore <label id="nombreContrato_regenerado"></label></b></h5><br />
                <h5><b>Cliente: <label id="nombreCliente_regenerado"></label></b></h5><br />
                <h5><b><label id="fechaActual_regenerado"></label></b></h5>
            </div>
        </div>
        <hr>
    </div>

    <div class="section" id="seccion-politicas_regenerado">
        <div id="politicas_regenerado"><br />
            <div class="col-lg-12">
                <h5><b>1. Política de Privacidad</b></h5>
                <p style=text-align:justify;>El contenido de este documento, así como los archivos adjuntos al mismo, son de carácter confidencial y dirigido al destinatario solamente. La distribución y difusión tanto impresa, verbal o electrónica se deberá realizar con la previa autorización del remitente. Si usted no es el destinatario, se le prohíbe su utilización total o parcial para cualquier fin. Lo anterior según el Artículo 2, de la Ley de Información No Divulgada No. 7975 de la República de Costa Rica.</p><br /><br />
                <h5><b>Privacy Policy</b></h5>
                <p style=text-align:justify;>The contents of this document, including the attachments, are confidential and are to the designated recipient only. The distribution and dissemination printed, verbal or electronic has to be authorized by the sender. If you are not the designated recipient, it's prohibited the total or partial use of this information. The foregoing according to Article 2 of the Law of Undisclosed Information No. 7975 of the Republic of Costa Rica.</p>
            </div>
        </div>
    </div>

    <div class="section" id="seccion-intro_regenerado">
        <div id="intro_regenerado"><br />
            <hr><br />
            <div class="col-lg-12">
                <h5><b>2. Introducción</b></h5>
                <p style=text-align:justify;>Este documento presenta el resumen de labores, resultados y tiempo para cliente <label id="nombreCliente_intro_regenerado"></label> bajo la contratación <label id="tipoContrato_intro_regenerado"></label></p>
            </div>
        </div>
    </div>

    <div class="section" id="seccion-resumen-consumidas_regenerado">
        <div id="resumen_regenerado"><br />
            <hr>
            
            <div class="col-lg-12" style="page-break-before: always;margin-top:10%;padding-top:10%">
                <h5><b>3. Resumen de horas consumidas</b></h5>
                <p style=text-align:justify;>Los siguientes datos resumen las labores realizadas por Greencore Solutions S.R.L. mediante el contrato citado anteriormente.</p>
            </div>
        </div><br /><br />
    </div>

    <div id="seccion-resumen-horas-consumidas_regenerado" class="section col-lg-12" style=text-align:center;>
        <div class="table-responsive text-black">
            <table class="text-black table table-bordered schedule-table" id="horas-consumidas-table_regenerado">
                <thead class="thead-light">
                    <tr>
                        <th>Mes</th>
                        <th>Estado</th>
                        <th>Actividad</th>
                        <th>Horas</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tbody id="horas-consumidas-tbody_regenerado"></tbody>
            </table><br />
            <h5 style=text-align:center;>Tiempo total: <label id="tiempoTotal_regenerado"></label></h5>
        </div><br /><br />
    </div>

    <div class="section col-lg-12" style=text-align:center; id="seccion-resumen-contratadas_regenerado">
        <h6 style=text-align:center;><b>Resumen de Horas, Contrato <label id="nombreContrato_horasContratadas_regenerado"></label></b></h6>
        <div class="table-responsive text-black text-center">
            <table class="text-black table table-bordered schedule-table" id="resumen-table_regenerado">
                <thead class="thead-light">
                    <tr>
                        <th>Detalle</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody id="resumen-tbody_regenerado"></tbody>
            </table> <b>
                <div id="orden_compra_regenerado"> </div>
            </b>
            <div id="descripcion_regenerado"></div> <br />
        </div>
    </div>

    <div class="section" id="historico_horas_mes_regenerado">
        <hr><br />
        <div class="col-lg-12" style="page-break-before: always;margin-top:10%;padding-top:10%">
            <h5><b>4. Histórico de horas por mes</b></h5>
            <p style=text-align:left;>A continuación se detallan las horas cosumidas:</p><br /><br />
        </div>
    </div>

    <div class="section" id="resumen_historico_horas_mes_regenerado">
        <div class="table-responsive text-black">
            <table class="text-black table table-bordered schedule-table" id="horas-meses-consumidas-table_regenerado">
                <thead class="thead-light">
                    <tr>
                        <th>Contrato</th>
                        <th>Horas</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="horas-meses-consumidas-tbody_regenerado"></tbody>
            </table><br />
        </div><br /><br />

    </div>

    <div class="section" id="seccion-incidencias_regenerado">
        <hr><br />
        <div class="col-lg-12">
            <h5><b>5. Descripción de las incidencias</b></h5>
            <p style=text-align:justify;>A continuación de desarrollan los aspectos generales de cada solicitud de labores ejecutada mediante la relación comercial con del cliente desde <label id="fechaInicio_regenerado"></label> al <label id="fechaFinal_regenerado"></label></p><br /><br />
        </div><br /><br />
    </div>

    <!-- <div class="section col-lg-12" id="seccion-total-incidencias_regenerado">
    <div class="table-responsive text-black text-center">
        <table class="text-black table table-bordered schedule-table" id="incidencia-table_regenerado">
            <thead class="thead-light">
                <tr>
                    <th>Incidencias</th>
                </tr>
            </thead>
            <tbody id="incidencia-tbody_regenerado"></tbody>
        </table><br />
    </div><br />
    <hr><br />
    </div> -->

    <div class="section col-lg-12" id="seccion-total-incidencias_regenerado">
        <div class="responsive text-black text-center">
            <h5><b>Incidencias</b></h5>
            <div id="incidencia-tbody_regenerado">

            </div>
            <br />
        </div><br />
        <hr><br />
    </div>


    <div class="section col-lg-12" id="seccion-confirmar_regenerado">
        <h3 class="centrar" id="resultReporte_regenerado"></h3>
        <div class="acciones">
            <!-- <form id="case-entry-form" action="" method="post" style="display: flex;"><input type="text" name="id" id="id" hidden><br><button type="submit" id="BotonConfirmarReporte" class="btn btn-success" onsubmit="return ConfirmarReporte();">Confirmar</button> </form> -->
            <div><button class="btn btn-primary" id="botonImprimirReporte_regenerado" onclick="imprimir()" style="margin-left: 10%;">Imprimir</button> </div>
        </div> <br /><br /><br /><br />
    </div>

</div>

<div class="" id="pie_pagina_regenerado" style="visibility: hidden;">
    <div id="piepagina_regenerado" class="fixed-bottom" style="visibility:hidden;">
        <img src="public/img/pie.png" width="100%" height="30%">
    </div>
</div>


<script src="public/js/site-report.js"></script>


<br />
<br />
<br />
<br />

<?php
include_once 'public/footer.php';
?>