<?php
session_start();
include_once 'public/header.php';
?>


<div class="container container-body" style="width: 80%;">



    <div id="main" class="">
        <h2 class=" text-center">Agregar nuevo cliente</h2>
        <hr>
        <form id="customer-entry-form" class="form-control bg-dark redondear centrar" action="" method="post">
            <div class="">
                <input type="text" name="idcustomer" id="idcustomer" hidden>
                <div class="centrar">
                    <img class="img-fluid" id="logo" src="public/img/logo-greencore-solutions.png" alt="logo" width="200" />
                </div>
                <br>
                <div class="alinear">
                    <div>
                        <label for="nombre_cliente">Nombre del cliente</label><br>
                        <input class="form-control" type="text" name="nombre_cliente" id="nombre_cliente" value="" placeholder="Nombre del cliente" required>
                    </div>
                    <div>
                        <label for="nombre_responsable">Nombre del responsable</label><br>

                        <input class="form-control" type="text" name="nombre_responsable" id="nombre_responsable" value="" placeholder="Nombre del reponsable" required>
                    </div>
                    <div>
                        <label for="nombre_institucion">Nombre de institución</label><br>
                        <input class="form-control" type="text" name="nombre_institucion" id="nombre_institucion" value="" placeholder="Nombre de institución" required>
                    </div>
                </div>
                <br>
                <div class="alinear2">
                    <div>
                        <label for="nombre_OTOBO">Nombre OTOBO</label><br>
                        <input class="form-control" type="text" name="nombre_OTOBO" id="nombre_OTOBO" value="" placeholder="Nombre refereciado de OTOBO" required>
                        <small id="helpId" class="form-text text-muted">Nombre referenciado de OTOBO</small>

                    </div>
                    <div>
                        <label for="estado">Estado</label><br>
                        <select class="form-control without-margin" name="estado" id="estado">
                            <option value="">--Seleccione un estado--</option>
                        </select>
                        <small id="estado_escoger" class=""></small>

                    </div>
                </div>
                <hr style="background-color: white;">
                <div class="centrar">
                    <div class="botones">
                        <a href="?controlador=Cliente&accion=accionMostrarClientes" class="btn btn-primary" style="width: 48%;">Volver</a>
                        <button type="submit" class="btn btn-success" onsubmit="return AgregarCliente();" style="width: 48%;">Registrar</button>
                    </div>
                </div>

            </div>
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