<?php
session_start();
include_once 'public/header.php';
?>


<div class="container container-body" style="width: 80%;">


    <div id="main" class="">
        <h2 class=" text-center">Modificando cliente</h2>
        <hr>
        <form class="form-control bg-dark redondear centrar" id="customer-update-entry-form" action="" method="post">
            <?php
            foreach ($vars['registro'] as $item) {
            ?>


                <div class="">
                    <div class="centrar">
                        <img class="img-fluid" id="logo" src="public/img/logo-greencore-solutions.png" alt="logo" width="200" />
                    </div>
                    <br>
                    <div class="alinear">
                        <div>
                            <label for="nombre_cliente_modi">Nombre del cliente</label><br>
                            <input class="form-control" type="text" name="nombre_cliente_modi" id="nombre_cliente_modi" value="<?php echo $item[1] ?>" placeholder="Nombre del cliente" required>
                            <input class="form-control" type="hidden" name="id_cliente_modi" id="id_cliente_modi" value="<?php echo $item[0] ?>" required>

                        </div>
                        <div>
                            <label for="nombre_responsable_modi">Nombre del responsable</label><br>

                            <input class="form-control" type="text" name="nombre_responsable_modi" id="nombre_responsable_modi" value="<?php echo $item[2] ?>" placeholder="Nombre del reponsable" required>
                        </div>
                        <div>
                            <label for="nombre_institucion_modi">Nombre de institución</label><br>
                            <input class="form-control" type="text" name="nombre_institucion_modi" id="nombre_institucion_modi" value="<?php echo $item[3] ?>" placeholder="Nombre de institución" required>
                        </div>
                    </div>
                    <br>
                    <div class="alinear2">
                        <div>
                            <label for="nombre_otobo_modi">Nombre OTOBO</label><br>
                            <input class="form-control" type="text" name="nombre_otobo_modi" id="nombre_otobo_modi" value="<?php echo $item[4] ?>" placeholder="Nombre refereciado de OTOBO" required>
                            <small id="helpId" class="form-text text-muted">Nombre referenciado de OTOBO</small>

                        </div>
                        <div>
                            <label for="estado_modi">Estado</label><br>
                            <select class="form-control without-margin" name="estado_modi" id="estado_modi">
                                <option id="<?php echo $item[5] ?>" value="<?php echo $item[5] ?>"><?php echo $item[6] ?></option>
                            </select>
                            <small id="estado_escoger" class=""></small>
                        </div>
                    </div>
                    <hr style="background-color: white;">
                    <div class="centrar">
                        <div class="botones">
                            <a href="?controlador=Cliente&accion=accionMostrarClientes" class="btn btn-danger" style="width: 48%;">Cancelar</a>
                            <button type="submit" class="btn btn-success" onsubmit="return AgregarUsuario();" style="width: 48%;">Modificar</button>
                        </div>
                    </div>

                </div>

            <?php
            }
            ?>
        </form>
    </div>

    <br />
    <br />
    <br />
    <br />

</div>





<?php
include_once 'public/footer.php';
?>