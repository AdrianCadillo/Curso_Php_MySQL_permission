<?php 
namespace lib;

class Authenticate {

private static string $Session = "username";    


/*METODO PARA VERIFICAR LA EXISTENCIA DE UNA SESSION */

public function getSession($Name):bool{
    return isset($_SESSION[$Name]);
}

/*METODO PARA RETORNAR EL VALOR DE LA VARIABLE DE SESSION */

public function getValueSession($Name):string{
    return isset($_SESSION[$Name])?$_SESSION[$Name]:'';
}
# METODO AUTH

public static function Auth($redirect)
{
 if(!isset($_SESSION[self::$Session])):
 header("Location:{$redirect}");
 endif;
}

# METODO GUEST

public static function Guest($redirect)
{
 if(isset($_SESSION[self::$Session])):
 header("Location:{$redirect}");
 endif;
}

# METODO ES PARA CERRAR SESSION

public function logout_()
{
if($this->getSession(self::$Session))
session_destroy();
}

 


}