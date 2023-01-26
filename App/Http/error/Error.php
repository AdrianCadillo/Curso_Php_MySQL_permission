<?php 
namespace Http\error;

use lib\BaseController;

class Error extends BaseController{
   
/*=========================
VISTA PARA ERROR 404
============================*/
public function error404()
{
    $this->render("error/404");
}
}