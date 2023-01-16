<?php

class FrontController {

    static function main() {
        require 'libs/View.php';
        require 'libs/configuration.php';

        if (!empty($_GET['controlador']))
            $controllerName = $_GET['controlador'] . 'Controller';
        else
            $controllerName = 'DefaultController';

        if (!empty($_GET['accion']))
            $actionName = $_GET['accion'];
        else
            $actionName = 'acciondefault';

        $routController = $config->get('controllerFolder') . $controllerName . '.php';
        
        if(is_file($routController))
            require $routController;
        else
            die ('Controller not found - 404 not found');
        
        // if(is_callable(array($controllerName,$actionName))==FALSE){
        //     trigger_error($controllerName.'-> '.$actionName. ' dont exist',E_USER_NOTICE);
        //     return FALSE;
        // }
        
        $controller=new $controllerName();
        $controller->$actionName();
            
    }//Fin main

}//Fin clase