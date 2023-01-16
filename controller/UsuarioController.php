<?php

class UsuarioController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function accionMostrarUsuarios()
    {
        //llamar modelo para traer datos 
        // $this->view->show("usuario/usuarioView.php", 1, 0);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("usuario/usuarioView.php", 1, 0);
        }
    } //acciondefault
    public function accionAgregarUsuario()
    {
        //llamar modelo para traer datos 
        // $this->view->show("usuario/agregarUsuarioView.php", null);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("usuario/agregarUsuarioView.php", null);
        }
    }

    public function modificarUsuario()
    {
        // require 'model/UsuarioModel.php';
        // $items = new UsuarioModel();
        // $datos['registro'] = $items->obtenerUsuarioPorID($_POST['id']);
        // return $this->view->show("usuario/modificarUsuarioView.php", $datos);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            require 'model/UsuarioModel.php';
            $items = new UsuarioModel();
            if ($_POST['id'] == null) {
                $this->view->show("usuario/usuarioView.php", 1, 0);
            } else {
                $datos['registro'] = $items->obtenerUsuarioPorID($_POST['id']);
                return $this->view->show("usuario/modificarUsuarioView.php", $datos);
            }
        }
    }

    public function accionDetalleUsuario()
    {
        //llamar modelo para traer datos 
        $this->view->show("usuario/modificarUsuarioView.php", null);
    }

    public function listarUsuarios()
    {
        require 'model/UsuarioModel.php';
        $items = new UsuarioModel();
        $datos['data'] = $items->cargarUsuarios();
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerUsuarioPorID()
    {
        require 'model/UsuarioModel.php';
        $items = new UsuarioModel();
        $datos['data'] = $items->obtenerUsuarioPorID($_GET['id']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function eliminarUsuarioPorID()
    {
        require 'model/UsuarioModel.php';
        $model = new UsuarioModel();
        $model->eliminarUsuarioPorID($_GET['id']);
    }

    public function agregarUsuario()
    {
        require 'model/UsuarioModel.php';
        $model = new UsuarioModel();
        $model->agregarUsuario(
            $_POST['username'],
            $_POST['contrasena'],
            $_POST['name'],
            $_POST['lastname'],
            $_POST['ID_'],
            $_POST['IDvalidity']
        );
    }

    public function actualizarUsuario()
    {
        require 'model/UsuarioModel.php';
        $model = new UsuarioModel();

        $model->actualizarUsuario(
            $_POST['id_User_modi'],
            $_POST['username_modi'],
            $_POST['contrasena_modi'],
            $_POST['name_modi'],
            $_POST['lastname_modi'],
            $_POST['ID_modi'],
            $_POST['estado_modi']
        );
    }
}//Fin Clase