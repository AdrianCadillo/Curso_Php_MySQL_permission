<?php

use database\Conexion;
use lib\BaseController;
use models\OrmImpl;

class UsuarioController extends BaseController{

    
    public function index(){
        $this->view_("usuario/Index_View.php");
    }

    public function editar($parametro=null){
     if(isset($parametro)):
        echo "soy de editar información ".$parametro[0];
     
     endif;
    }
   /// usuario y roles
    public function test()
    {     
    $sql = "INSERT INTO rol(name_rol) values(?)";
    echo OrmImpl::optimizeCud($sql,[
    "Vendedor"    
    ]);
    
    }
}

?>