<?php

class DefaultController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    } //Constructor

    public function acciondefault()
    {
        //llamar modelo para traer datos 
        // $this->view->show("login/loginView.php", null);

        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("principalView.php", null);
        }
    } //acciondefault

    public function principal()
    {
        //llamar modelo para traer datos 
        session_start();
        $varsession = $_SESSION['session'];
        if ($varsession == 0 || $varsession == '' || $varsession == 'stoped') {
            // echo $varsession;
            $this->view->show("login/loginView.php", null);
        } else if ($varsession == 'started') {
            // echo $varsession;
            $this->view->show("principalView.php", null);
        }
    }
}//Fin Clase