<?php
namespace database;
require 'config.php'; 
class Conexion {
   
    public function __construct()
    {
     echo USUARIO;
    }
}

$conexion = new Conexion();

?>
