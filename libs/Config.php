

<?php

class Config {

    //Variables Globales
    private $vars;
    private static $instance;

    //Constructor
    private function __construct() {
        //Vars va ser un array, los array se pueden guardar cualquier cosa
        $this->vars = array();
    }//Fin constructor
    
    //Funcion Set 
    public function set($nombreAtributo, $valor) {
        if (!isset($this->vars[$nombreAtributo])) {
            $this->vars[$nombreAtributo] = $valor;
        }// if
    }//Fin set
    
    //Funcion get
    public function get($nombreAtributo) {
        if (isset($this->vars[$nombreAtributo])) {
            return $this->vars[$nombreAtributo];
        }// if
    }// Fin funcion get
    
    //Patron Diseño
    public static function singleton() {
        if(!isset(self::$instance)){
            $tempClass =__CLASS__;
            self::$instance=new $tempClass;
        }// if
        return self::$instance;
    }//Fin singleton
    
}

//fin clase