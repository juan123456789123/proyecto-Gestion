<?php

class ContratoModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function cargarContratos()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call getContracts()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerContratoPorID($id)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getContractById('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function eliminarContratoPorID($id)
    {
        $consulta = $this->db->prepare("call getDeleteContract('$id')");
        $consulta->execute();
        $consulta->CloseCursor();
        return $consulta;
    }

    public function agregarContrato($nombre_contrato, $IDcliente, $tipo_Contrato, $horas_contratadas, $fecha_inicio, $fecha_finalizacion, $estado, $detalle, $orden)
    {
        echo $nombre_contrato;
        $consulta = $this->db->prepare("call insertContract('$nombre_contrato','$IDcliente','$tipo_Contrato','$horas_contratadas','$fecha_inicio','$fecha_finalizacion','$estado','$detalle','$orden')");
        $consulta->execute();
        return $consulta;
    }

    public function actualizarContrato($id_contrato_modi, $nombre_contrato_modi, $tipo_Contrato_modi, $horas_contratadas_modi, $fecha_inicio_modi, $fecha_finalizacion_modi, $horas_disponibles_modi, $estado_modi, $detalle_modi, $orden_modi)
    {
        echo $id_contrato_modi;
        var_dump($id_contrato_modi, $nombre_contrato_modi, $tipo_Contrato_modi, $horas_contratadas_modi, $fecha_inicio_modi, $fecha_finalizacion_modi, $horas_disponibles_modi, $estado_modi);
        $consulta = $this->db->prepare("call updateContract('$id_contrato_modi','$nombre_contrato_modi','$tipo_Contrato_modi', '$horas_contratadas_modi','$fecha_inicio_modi','$fecha_finalizacion_modi','$horas_disponibles_modi','$estado_modi','$detalle_modi','$orden_modi')");
        $consulta->execute();
        return $consulta;
    }
}
