<?php

class LoginModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function autenticar($usuario, $contrasena)
    {

        $consulta = $this->db->prepare("call login('$usuario','$contrasena')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function iniciarSesion($usuario, $contrasena)
    {
        $consulta = $this->db->prepare('call autenticacion("' . $usuario . '","' . $contrasena . '")');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
}
