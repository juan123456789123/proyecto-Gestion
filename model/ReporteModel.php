<?php

class ReporteModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }


    public function obtenerTickets($nombre_cliente, $estado, $fecha_inicio, $fecha_final)
    {
        $url = 'http://soporte.greencore.co.cr/otobo/nph-genericinterface.pl/Webservice/OTOBOProvider/SearchTicket/' . $nombre_cliente . '/' . $estado . '/' . $fecha_inicio . '%2000:00:00/' . $fecha_final . '%2023:59:59?UserLogin=root@localhost&Password=root.gcs';
        $respuesta = file_get_contents($url);
        return $respuesta;
    }

    public function obtenerInfoTickets($IDs)
    {
        $respuesta = [];
        for ($i = 0; $i < count($IDs); $i++) {
            $url = 'http://soporte.greencore.co.cr/otobo/nph-genericinterface.pl/Webservice/OTOBOProvider/GetTicket/' . $IDs[$i] . '/1/1?UserLogin=root@localhost&Password=root.gcs';
            // echo $IDticket[$i] . "<br>";
            // $url = 'http://soporte.greencore.co.cr/otobo/nph-genericinterface.pl/Webservice/OTOBOProvider/GetTicket/38/1/1?UserLogin=hansel.carpio&Password=hansel.gcs';
            $respuesta[$i] = file_get_contents($url);
            // $dato = $respuesta;
        }
        return $respuesta;
    }


    public function obtenerContratosPorNombre($cliente)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getContractsByName('$cliente')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerInfoContrato($contrato)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getContractInfo('$contrato')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    //----

    public function obteneCasosPorNombreContrato($nombre_contrato)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getCasesBycontractname('$nombre_contrato')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerCasosParaHistoricoGenerado($contrato, $fecha)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getCasesForHistoric('$contrato', '$fecha')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    ///---
}
