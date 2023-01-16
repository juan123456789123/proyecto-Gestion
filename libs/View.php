<?php

class View {
    
    //Constructor
    public function __construct() {
        ;
    }//Fin constructor
    
    //Show
    public function show($nombreVista,$vars=array()){
        $config = Config::singleton();
        $path=$config->get('viewFolder').$nombreVista;
        
        if(is_file($path) == FALSE){
            trigger_error('Page '.$path. ' doesnt exist', E_USER_NOTICE);
            return FALSE;
        }// if
        
        if(is_array($vars)){
            foreach ($vars as $key=>$value){
                $key=$value;
            }
        }// if(is_array($vars))
        
        //No se puede usar un return para una vista x lo tanto usamos include
        include $path;
            
    }//Fin show
    
}//Fin clase