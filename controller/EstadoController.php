<?php

class EstadoController{
    public function __construct(){
        $this->view = new View();
    } //Constructor


    public function listarEstados() {
        require 'model/EstadoModel.php';
        $items = new EstadoModel();
        $datos['data'] = $items->cargarEstados();
        $resultado =json_encode($datos);
        echo $resultado;
        return $resultado;
    }
}
