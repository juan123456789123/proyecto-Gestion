<?php

class EstadoModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function cargarEstados()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call getValidity()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
}
