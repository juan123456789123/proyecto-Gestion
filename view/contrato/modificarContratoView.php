<?php
session_start();
include_once 'public/header.php';
?>




<div class="container container-body">

    <div id="main" class="containe" style="margin-bottom:13%; margin-top: -1%;">

        <div class="">
            <h2 class=" text-center">Modificando contrato</h2>
            <hr>
            <form class="form-control bg-dark redondear centrar" id="contract-update-entry-form" action="" method="post">

                <?php
                foreach ($vars['registro'] as $item) {
                ?>
                    <div class="centrar">
                        <img class="img-fluid" id="logo" src="public/img/logo-greencore-solutions.png" alt="logo" width="200" />
                    </div>
                    <div class="alinear">
                        <div class="">
                            <label for="nombre_contrato_modi">Nombre del contrato</label><br>
                            <input class="form-control" type="text" name="nombre_contrato_modi" id="nombre_contrato_modi" value="<?php echo $item[1] ?>" placeholder="Nombre del contrato" required>
                            <input class="form-control" type="hidden" name="id_contrato_modi" id="id_contrato_modi" readonly value="<?php echo $item[0] ?>" required>


                        </div>
                        <div class="">
                            <label for="identificacion">Cliente</label><br>
                            <input class="form-control" type="text" name="identificacion" id="identificacion" readonly value="<?php echo $item[2] ?>" placeholder="Identificación" required>
                        </div>
                        <div class="">
                            <label for="tipo_Contrato_modi">Tipo de contrato</label><br>
                            <input class="form-control" type="text" name="tipo_Contrato_modi" id="tipo_Contrato_modi" value="<?php echo $item[3] ?>" placeholder="Tipo de contrato" required>
                        </div>


                        <div class="">
                            <label for="orden_compra_modi">Orden de compra</label><br>
                            <input type="text" class="form-control" name="orden_compra_modi" value="<?php echo $item[10] ?>" placeholder="Orden de compra" id="orden_compra_modi">
                        </div>

                    </div>
                    <br>
                    <div class="alinear">
                        <div class="">
                            <label for="fecha_inicio_modi">Fecha de inicio</label><br>
                            <input class="form-control" type="datetime-local" name="fecha_inicio_modi" id="fecha_inicio_modi" value="<?php echo $item[6] ?>" placeholder="Fecha de inicio" required>
                            <small id="helpId" class="form-text text-muted">Fecha en la inició el contrato</small>
                        </div>
                        <div class="">
                            <label for="fecha_finalizacion_modi">Fecha de finalización</label><br>
                            <input class="form-control" type="datetime-local" name="fecha_finalizacion_modi" id="fecha_finalizacion_modi" value="<?php echo $item[7] ?>" placeholder="Fecha de finalización" required>
                            <small id="helpId" class="form-text text-muted">Fecha en la terminará el contrato</small>
                        </div>
                        <div class="">
                            <label for="horas_contratadas_modi">Horas contratadas</label><br>
                            <input class="form-control" type="number" name="horas_contratadas_modi" id="horas_contratadas_modi" onkeypress="return validarNumeros(event)" pattern="[0-1000]+" value="<?php echo $item[4] ?>" placeholder="Horas contratadas" required>
                        </div>
                        <div class="">
                            <label for="horas_disponibles_modi"> Horas disponibles</label><br>
                            <input class="form-control" type="number" name="horas_disponibles_modi" id="horas_disponibles_modi" onkeypress="return validarNumeros(event)" pattern="[0-1000]+" value="<?php echo $item[5] ?>" placeholder="Horas disponibles" required>
                        </div>
                    </div>
                    <div class="alinear">
                        <div class="">
                            <label for="descripcion_modi">Descripción</label><br>
                            <input class="form-control" type="text" name="descripcion_modi" id="descripcion_modi" value="<?php echo $item[9] ?>" value="" placeholder="Descripción" required>
                        </div>
                        <div class="">
                            <label for="estado_modi">Estado</label><br>
                            <select class="form-control without-margin" name="estado_modi" id="estado_modi">
                                <option id="<?php echo $item[11] ?>" value="<?php echo $item[11] ?>"><?php echo $item[8] ?></option>
                            </select>
                            <small id="estado_escoger" class=""></small>

                        </div>

                    </div>



                    <hr style="background-color: white;">
                    <div class="centrar">
                        <div class="botones">
                            <a href="?controlador=Contrato&accion=accionMostrarContratos" class="btn btn-danger" style="width: 48%;">Cancelar</a>
                            <button type="submit" class="btn btn-success" onsubmit="return AgregarContrato();" style="width: 48%;">Modificar</button>
                        </div>
                    </div>


                <?php
                }
                ?>
            </form>
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