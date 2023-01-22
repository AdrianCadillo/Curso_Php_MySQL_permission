<?php
namespace lib;

use models\OrmImpl;

class BaseController extends View{

/*
METODO PARA REDIRECCIONAR PÁGINAS
*/

public static function Redirect($ruta_)
{
 header("Location:{$ruta_}");
}

/*METODO PARA VERIFICAR LA EXISTENCIA DE UNA SESSION */

public function getSession($Name):bool{
    return isset($_SESSION[$Name]);
}

/*METODO PARA RETORNAR EL VALOR DE LA VARIABLE DE SESSION */

public function getValueSession($Name):string{
    return isset($_SESSION[$Name])?$_SESSION[$Name]:'';
}

public function getRolesUsuario($id_user){


 $Query = "call proc_roles_del_usuario(?);";

 return OrmImpl::getBayId($Query,$id_user);
}
}
?>