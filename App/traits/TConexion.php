<?php 
namespace traits;

use PDO;

trait TConexion {

    public static string $Query;

    private static $conector = null;

    public  static $pps = null;

    public static $Result = null;

   /*
   METODO PARA REALZIAR LA CONEXION
   */ 
  public static function getConection()
  {
   self::$conector = new PDO(DRIVER,USUARIO,PASSWORD);

   self::$conector->exec("set names utf8");

   return self::$conector;
  }

  # CERRAR LA CONEXION
  public static function cerrarBD(){
    if(self::$conector != null){
        self::$conector = null;
    }

    if(self::$pps != null){
        self::$pps = null;
    }

    if(self::$Result != null){
        self::$Result = null;
    }


  }


}
?>