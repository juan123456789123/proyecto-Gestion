<?php

class ReporteController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function accionMostrarReportes()
    {
        //llamar modelo para traer datos 
        
        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("reporte/reporteView.php", null);
        }
    } //acciondefault


    public function accionReporteGenerado()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos[] = ($items->obtenerInfoTickets(
            $_GET['IDtickets']
        ));
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerTickets()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos = $items->obtenerTickets(
            $_GET['nombre_cliente'],
            $_GET['estado'],
            $_GET['fecha_inicio'],
            $_GET['fecha_final']
        );
        echo $datos;
        return $datos;
    }

    public function obtenerInfoTickets()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos[] = ($items->obtenerInfoTickets(
            $_GET['IDtickets']
        ));
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerContratosPorNombre()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos['data'] = $items->obtenerContratosPorNombre($_GET['cliente']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerInfoContrato()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos['data'] = $items->obtenerInfoContrato($_GET['contrato']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    //---
    public function obteneCasosPorNombreContrato()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos['data'] = $items->obteneCasosPorNombreContrato($_GET['nombre_contrato']);
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    public function obtenerCasosParaHistoricoGenerado()
    {
        require 'model/ReporteModel.php';
        $items = new ReporteModel();
        $datos['data'] = $items->obtenerCasosParaHistoricoGenerado(
            $_GET['contrato'],
            $_GET['fecha']
        );
        $resultado = json_encode($datos);
        echo $resultado;
        return $resultado;
    }

    //----
}//Fin Clase