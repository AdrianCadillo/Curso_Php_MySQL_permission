<?php

use lib\BaseController;

class UsuarioController extends BaseController{

    
    public function index(){
        $this->view_("usuario/Index_View.php");
    }

    public function editar($parametro=null){
     if(isset($parametro)):
        echo "soy de editar información ".$parametro[0];
     
     endif;
    }
}

?>