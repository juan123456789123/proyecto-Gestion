<?php
session_start();
include_once 'public/header.php';
?>
<div class="container container-body ">


    <!-- <div id="condicionContrato" style="height:30px; text-align: center;">
        <h3 id="resultContract"></h3>
    </div> -->
    <div id="main" class="container  ">
        <h3 class=" text-center">Agregar nuevo contrato</h3>
        <hr>
        <div class="">
            <form id="contract-entry-form" class="form-control bg-dark redondear centrar" action="" method="post">
                <input type="text" name="idcontract" id="idcontract" hidden>
                <div class="centrar">
                    <img class="img-fluid" id="logo" src="public/img/logo-greencore-solutions.png" alt="logo" width="200" />
                </div>

                <div class="alinear">
                    <div class="">
                        <label for="nombre_contrato">Nombre del contrato</label><br>
                        <input class="form-control" type="text" name="nombre_contrato" id="nombre_contrato" value="" placeholder="Nombre del contrato" required>

                    </div>
                    <div class="">
                        <label for="cliente">Cliente</label><br>
                        <select class="form-control without-margin select" name="cliente" id="cliente">
                            <option selected value="">--Seleccione un cliente--</option>
                        </select>
                        <small id="cliente_escoger" class=""></small>
                    </div>
                    <div class="">
                        <label for="tipo_Contrato">Tipo de contrato</label><br>
                        <input class="form-control" type="text" name="tipo_Contrato" id="tipo_Contrato" value="" placeholder="Tipo de contrato" required>
                    </div>

                    <div class="">
                        <label for="orden_compra">Orden de compra</label><br>
                        <input type="text" class="form-control" name="orden_compra" placeholder="Orden de compra" id="orden_compra">
                    </div>

                </div>
                <br>
                <div class="alinear">
                    <div class="">
                        <label for="fecha_inicio">Fecha de inicio</label><br>
                        <input class="form-control" type="datetime-local" name="fecha_inicio" id="fecha_inicio" value="" placeholder="Fecha de inicio" required>
                        <small id="helpId" class="form-text text-muted">Fecha en la inició el contrato</small>
                    </div>
                    <div class="">
                        <label for="fecha_finalizacion">Fecha de finalización</label><br>
                        <input class="form-control" type="datetime-local" name="fecha_finalizacion" id="fecha_finalizacion" value="" placeholder="Fecha de finalización" required>
                        <small id="helpId" class="form-text text-muted">Fecha en la terminará el contrato</small>
                    </div>
                    <div class="">
                        <label for="horas_contratadas">Horas contratadas</label><br>
                        <input type="number" class="form-control" name="horas_contratadas" id="horas_contratadas" onkeypress="return validarNumeros(event)" placeholder=" Horas, ej:120" pattern="[0-1000]+" required>
                    </div>

                </div>

                <div class="alinear">
                    <div class="">
                        <label for="descripcion">Descripción</label><br>
                        <input class="form-control" type="text" name="descripcion" id="descripcion" value="" placeholder="Descripción" required>
                    </div>
                    <div class="">
                        <label for="estado">Estado</label>
                        <select class="form-control without-margin" name="estado" id="estado">
                            <option value="">--Seleccione un estado--</option>
                        </select>
                        <small id="estado_escoger" class=""></small>

                    </div>

                </div>
                <hr style="background-color: white;">
                <div class="centrar">
                    <div class="botones">
                        <a href="?controlador=Contrato&accion=accionMostrarContratos" class="btn btn-primary" style="width: 48%;">Volver</a>
                        <button type="submit" class="btn btn-success" onsubmit="return agregarContrato();" style="width: 48%;">Registrar</button>
                    </div>
                </div>
            </form>
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