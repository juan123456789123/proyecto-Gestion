<?php

class CasosModel {

    protected $db;

    public function __construct() {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function cargarCasos() {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call getCases()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function agregarCaso($contract_name, $IDtickets, $incidents, $hours, $used_hours, $init, $final, $otobo_customer, $previous_hours, $current_hours)
    {
        $consulta = $this->db->prepare("call insertCase('$contract_name','$IDtickets','$incidents','$hours','$used_hours','$init','$final','$otobo_customer','$previous_hours','$current_hours')");
        $consulta->execute();
        return $consulta;
    }

    public function obtenerDatosReportePorID($id)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getCaseById('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

}