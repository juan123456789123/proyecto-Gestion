<?php

//Configuration
require 'libs/Config.php';

$config = Config::singleton();
$config->set('controllerFolder', 'controller/');
$config->set('modelFolder', 'model/');
$config->set('viewFolder', 'view/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'gcs_rticket_otobo');
$config->set('dbuser', 'root');
$config->set('dbpass', 'gcs.2022');

// $config->set('dbhost', 'sql5.freesqldatabase.com');
// $config->set('dbname', 'sql5529780');
// $config->set('dbuser', 'sql5529780');
// $config->set('dbpass', 'zcd489ecZU');
?>