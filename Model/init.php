<?php
// put all new includes/required files here
require_once('../Controller/functions.php');
require_once('../Controller/global.php');
require_once('config.php');
spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/fdc/Model/'.$class.'.php';
});


?>