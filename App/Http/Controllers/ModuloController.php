<?php

use lib\BaseController;

class ModuloController extends BaseController {

/*======================= 

VISUALIZAR LA VISTA DE IMPORTAR DATOS 
DEL MODULO
========================*/

public function import(){
  # valida la url para no acceder al sistema sin antes de estar logueado
  $this->Auth($this->getRedirectLogin());
}
}

?>