<?php
session_start();
include_once 'public/header.php';
?>




<div class="container container-body" style="width: 80%;">



    <div id="main">
        <h2 class=" text-center">Modificando usuario</h2>
        <hr>
        <form class="form-control bg-dark redondear centrar" id="user-update-entry-form" action="" method="post">
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
                            <label for="nombre_modi">Nombre</label><br>



                            <input class="form-control" type="text" name="nombre_modi" id="nombre_modi" value="<?php echo $item[3] ?>" placeholder="Nombre" required>
                            <input class="form-control" type="hidden" name="id_usuario_modi" id="id_usuario_modi" value="<?php echo $item[0] ?>" required>

                        </div>
                        <div>
                            <label for="apellidos_modi">Apellidos</label><br>
                            <input class="form-control" type="text" name="apellidos_modi" id="apellidos_modi" value="<?php echo $item[4] ?>" placeholder="Apellidos" required>
                        </div>
                        <div>
                            <label for="ID_modi">Identificación</label><br>
                            <input class="form-control" type="text" name="ID_modi" id="ID_modi" value="<?php echo $item[5] ?>" placeholder="Identificación" required>
                        </div>
                    </div>
                    <br>
                    <div class="alinear">
                        <div>
                            <label for="nombre_usuario_modi">Usuario</label><br>
                            <input class="form-control" type="text" name="nombre_usuario_modi" id="nombre_usuario_modi" value="<?php echo $item[1] ?>" placeholder="Usuario" required>
                        </div>
                        <div>
                            <label for="contrasena_modi">Contraseña</label><br>

                            <input class="form-control" type="password" name="contrasena_modi" id="contrasena_modi" value="<?php echo $item[2] ?>" placeholder="Contraseña" required>
                            <svg id="show-hide-passwd" action="hide" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                        </div>
                        <div>
                            <label for="estado_modi">Estado</label><br>
                            <select class="form-control without-margin" name="estado_modi" id="estado_modi">
                                <option id="<?php echo $item[6] ?>" value="<?php echo $item[6] ?>"><?php echo $item[7] ?></option>
                            </select>
                            <small id="estado_escoger" class=""></small>
                        </div>
                    </div>
                    <label id="result-update-user"></label>
                    <hr style="background-color: white;">
                    <div class="centrar">
                        <div class="botones">
                            <a href="?controlador=Usuario&accion=accionMostrarUsuarios" class="btn btn-danger" style="width: 48%;">Cancelar</a>
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