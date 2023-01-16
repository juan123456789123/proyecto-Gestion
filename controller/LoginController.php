<?php

class LoginController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function accionMostrarLogin()
    {
        //llamar modelo para traer datos 
        $this->view->show("login/loginView.php", null);
    } //acciondefault


    public function iniciarsesion()
    {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        require 'model/LoginModel.php';
        $items = new LoginModel();
        $data['registro'] = $items->iniciarSesion($usuario, $contrasena);


        if ($data['registro'] == null) {
            $this->view->show("login/loginView.php", null);
            echo "<script>            
            
            $('#resultLogin').text('Datos inválidos');
            $('#resultLogin').css({ 'color': 'white', 'background-color': '#dc3545', 'margin': '4px', 'border-radius': '5px','padding-top':'4px' });
            
            </script>;";
        } else {
            session_start();            
            $_SESSION['session'] = 'started';
            $this->view->show("principalView.php", null);
        }
    }
    public function cerrarSession()
    {
        session_start();
        $_SESSION['session'] = 'stoped';
        unset($_SESSION['session']);
        session_destroy();
        $this->view->show("login/loginView.php", null);
    }
}//Fin Clase