<?php

use lib\Route;

spl_autoload_register(function($clase){
$clase = str_replace("\\","/",$clase);

$File = "App/".$clase.".php";

if(file_exists($File)):
require_once $File;
endif;
});

  Route::getValidateRouting();

?>