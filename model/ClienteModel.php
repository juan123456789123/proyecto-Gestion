<?php

class ClienteModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function cargarClientes()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call getCustomer()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerClientePorID($id)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getCustomerById('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function eliminarClientePorID($id)
    {
        $consulta = $this->db->prepare("call getDeleteCUSTOMER('$id')");
        $consulta->execute();
        $consulta->CloseCursor();
        return $consulta;
    }

    public function agregarCliente($customer_name, $responsible_name, $institution_name, $otobo_name, $IDvalidity)
    {
        $consulta = $this->db->prepare("call insertCustomer('$customer_name','$responsible_name','$institution_name','$otobo_name','$IDvalidity')");
        $consulta->execute();
        return $consulta;
    }

    public function actualizarCliente($IDcustomer_modi, $customer_name_modi, $responsible_name_modi, $institution_name_modi, $otobo_name_modi, $IDvalidity_modi)
    {

        $consulta = $this->db->prepare("call updateCustomer('$IDcustomer_modi','$customer_name_modi','$responsible_name_modi', '$institution_name_modi','$otobo_name_modi','$IDvalidity_modi')");
        $consulta->execute();
        return $consulta;
    }
}
