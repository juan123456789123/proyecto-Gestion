<?php

class ClienteController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function accionMostrarClientes()
    {
        //llamar modelo para traer datos 
        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("cliente/clienteView.php", null);
        }
    } //acciondefault

    public function accionAgregarCliente()
    {
        //llamar modelo para traer datos         
        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("cliente/agregarClienteView.php", null);
        }
    }

    public function accionDetalleCliente()
    {
        //llamar modelo para traer datos 
        $this->view->show("cliente/modificarClienteView.php", null);
    }

    public function listarClientes()
    {
        require 'model/ClienteModel.php';
        $items = new ClienteModel();
        $datos['data'] = $items->cargarClientes();
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerClientePorID()
    {
        require 'model/ClienteModel.php';
        $items = new ClienteModel();
        $datos['data'] = $items->obtenerClientePorID($_GET['id']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }
    public function eliminarClientePorID()
    {
        require 'model/ClienteModel.php';
        $model = new ClienteModel();
        $model->eliminarClientePorID($_GET['id']);
    }

    public function agregarCliente()
    {
        require 'model/ClienteModel.php';
        $model = new ClienteModel();
        $model->agregarCliente(
            $_POST['customer_name'],
            $_POST['responsible_name'],
            $_POST['institution_name'],
            $_POST['otobo_name'],
            $_POST['IDvalidity']
        );
    }

    public function modificarCliente()
    {
        // require 'model/ClienteModel.php';
        // $items = new ClienteModel();
        // $datos['registro'] = $items->obtenerClientePorID($_POST['id']);
        // return $this->view->show("cliente/modificarClienteView.php", $datos);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            require 'model/ClienteModel.php';
            $items = new ClienteModel();
            if ($_POST['id'] == null) {
                $this->view->show("cliente/clienteView.php", null);
            } else {
                $datos['registro'] = $items->obtenerClientePorID($_POST['id']);
                return $this->view->show("cliente/modificarClienteView.php", $datos);
            }
        }
    }

    public function actualizarCliente()
    {
        require 'model/ClienteModel.php';
        $model = new ClienteModel();

        $model->actualizarCliente(
            $_POST['IDcustomer_modi'],
            $_POST['customer_name_modi'],
            $_POST['responsible_name_modi'],
            $_POST['institution_name_modi'],
            $_POST['otobo_name_modi'],
            $_POST['IDvalidity_modi']
        );
    }
}//Fin Clase