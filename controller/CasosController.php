<?php

use LDAP\Result;

class CasosController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }


    public function listarCasos()
    {
        require 'model/CasosModel.php';
        $items = new CasosModel();
        $datos['data'] = $items->cargarCasos();
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function agregarCaso()
    {
        require 'model/CasosModel.php';
        $model = new CasosModel();
        $model->agregarCaso(
            $_POST['contract_name'],
            $_POST['IDtickets'],
            $_POST['incidents'],
            $_POST['hours'],
            $_POST['used_hours'],
            $_POST['init'],
            $_POST['final'],
            $_POST['otobo_customer'],
            $_POST['previous_hours'],
            $_POST['current_hours']
        );
    }

    public function accionMostrarReporteGenerado()
    {
        // require 'model/CasosModel.php';
        // $items = new CasosModel();
        // $datos['registro'] = $items->obtenerDatosReportePorID($_POST['id']);
        // return $this->view->show("reporte/reporteGeneradoView.php", $datos);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            require 'model/CasosModel.php';
            $items = new CasosModel();            
            if ($_POST['id'] == null){
                return $this->view->show("principalView.php", null);
            } else{
                $datos['registro'] = $items->obtenerDatosReportePorID($_POST['id']);
                return $this->view->show("reporte/reporteGeneradoView.php", $datos);
            }            
        }
    }
}
