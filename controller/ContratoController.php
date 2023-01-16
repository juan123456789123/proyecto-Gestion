<?php

use LDAP\Result;

class ContratoController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function accionMostrarContratos()
    {
        //llamar modelo para traer datos 


        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("contrato/contratoView.php", null);
        }
    } //acciondefault

    public function accionMostrarAgregarContrato()
    {
        //llamar modelo para traer datos 

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("contrato/agregarContratoView.php", null);
        }
    }

    public function modificarContrato()
    {
        // require 'model/ContratoModel.php';
        // $items = new ContratoModel();
        // $datos['registro'] = $items->obtenerContratoPorID($_POST['id']);
        // return $this->view->show("contrato/modificarContratoView.php", $datos);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            require 'model/ContratoModel.php';
            $items = new ContratoModel();
            if ($_POST['id'] == null) {
                $this->view->show("contrato/contratoView.php", null);
            } else {
                $datos['registro'] = $items->obtenerContratoPorID($_POST['id']);
                return $this->view->show("contrato/modificarContratoView.php", $datos);
            }
        }
    }

    public function listarContrato()
    {
        require 'model/ContratoModel.php';
        $items = new ContratoModel();
        $datos['data'] = $items->cargarContratos();
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerContratoPorID()
    {
        require 'model/ContratoModel.php';
        $items = new ContratoModel();
        $datos['data'] = $items->obtenerContratoPorID($_GET['id']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function eliminarContratoPorID()
    {
        require 'model/ContratoModel.php';
        $model = new ContratoModel();
        $model->eliminarContratoPorID($_GET['id']);
    }

    public function agregarContrato()
    {
        require 'model/ContratoModel.php';
        $model = new ContratoModel();
        $model->agregarContrato(
            $_POST['nombre_contrato'],
            $_POST['IDcliente'],
            $_POST['tipo_Contrato'],
            $_POST['horas_contratadas'],
            $_POST['fecha_inicio'],
            $_POST['fecha_finalizacion'],
            $_POST['estado'],
            $_POST['detalle'],
            $_POST['orden']
        );
    }

    public function actualizarContrato()
    {
        require 'model/ContratoModel.php';
        $model = new ContratoModel();
        $model->actualizarContrato(
            $_POST['id_contrato_modi'],
            $_POST['nombre_contrato_modi'],
            $_POST['tipo_Contrato_modi'],
            $_POST['horas_contratadas_modi'],
            $_POST['fecha_inicio_modi'],
            $_POST['fecha_finalizacion_modi'],
            $_POST['horas_disponibles_modi'],
            $_POST['estado_modi'],
            $_POST['detalle_modi'],
            $_POST['orden_modi']
        );
    }
}//Fin Clase