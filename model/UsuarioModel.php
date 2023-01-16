<?php

class UsuarioModel
{

    protected $db;

    public function __construct()
    {

        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function cargarUsuarios()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call getUsers()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerUsuarioPorID($id)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare("call getUserById('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }



    public function eliminarUsuarioPorID($id)
    {
        $consulta = $this->db->prepare("call getDeleteUser('$id')");
        $consulta->execute();
        $consulta->CloseCursor();
        return $consulta;
    }




    public function agregarUsuario($username, $contrasena, $name, $lastname, $ID_, $IDvalidity)
    {
        $consulta = $this->db->prepare("call insertUser('$username','$contrasena','$name','$lastname','$ID_','$IDvalidity')");
        $consulta->execute();
        return $consulta;
    }


    public function actualizarUsuario($id_User_modi, $username_modi, $contrasena_modi, $name_modi, $lastname_modi, $ID_modi, $estado_modi)
    {
        $consulta = $this->db->prepare("call updateUser('$id_User_modi','$username_modi','$contrasena_modi', '$name_modi','$lastname_modi','$ID_modi','$estado_modi')");
        $consulta->execute();
        return $consulta;
    }
}
