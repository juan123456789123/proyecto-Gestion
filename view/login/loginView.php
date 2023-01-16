<?php
session_destroy();
include_once 'public/headerLogin.php';
?>

<div class="">

    <section class="vh-100 gradient-custom login-section">

        <div class="login-center ">
            <div class="bg-dark text-white login">
                <form method="post" action="?controlador=Login&accion=iniciarsesion" id="p" class="login-form" onsubmit="return validacion()">
                    <div class="card-body  text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <div class="form-outline form-white mb-4 input-login">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                </div>
                                <div style="width:70%;">
                                    <input type="text" id="usuario" name="usuario" class="form-control " placeholder="Usuario" required />
                                </div>
                            </div>
                            <div class="form-outline form-white mb-4 input-login" style="margin-top: 10%; ">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="35" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                    </svg>
                                </div>
                                <div style="width:70%;">
                                    <div class="input-group" style="background-color: white;border-radius: 5px;">
                                        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" style="margin-bottom: -1px; border-style: none;" required />
                                        <span style="background-color: white;border-style: none;" id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-login">
                                <button class="btn btn-success px-5" type="submit">Ingresar</button>
                            </div>
                            <br>
                            <h4 id="resultLogin"></h4>
                        </div>

                    </div>
                </form>
            </div>
        </div>

</div>
</section>


</div>

</body>

</html>