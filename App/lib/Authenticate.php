<?php 
namespace lib;

class Authenticate {

private static string $Session = "username";    

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

 


}