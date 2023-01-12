<?php
namespace models;
use database\Conexion;
use Repository\IOrm;

class OrmImpl extends Conexion implements IOrm {
   
    # METODO SIRVE PARA REALIZAR UN INSERT

    /*
    INSERT INTO Tabla(atributo1,atributo2,atributo3) VALUES(:atributo1,:atributo2)
    */

public static function Insert_(string $Tabla,array $datos){
self::$Query = "INSERT INTO ".$Tabla."(";

foreach($datos as $key=>$data):
self::$Query.=$key.",";
endforeach;

self::$Query = trim(self::$Query,",");

self::$Query.=") VALUES(";

foreach($datos as $key=>$data):
    self::$Query.=":{$key},";
endforeach;

self::$Query = trim(self::$Query,",");

self::$Query.=")";

try {
self::$pps = self::getConection()->prepare(self::$Query);

foreach($datos as $key=>$data):
   self::$pps->bindValue(":{$key}",$data);
endforeach;

return self::$pps->execute();
} catch (\Throwable $th) {
   echo $th->getMessage();
}finally{
    self::cerrarBD();
}

}

# METODO ES PARA ACTUALZIAR 

public static function Update(string $Tabla,array $datos)
{
    self::$Query = "UPDATE ".$Tabla." SET ";

    # obtener los valores que se desea modificar set 
 
    foreach($datos as $key=>$data):
     self::$Query.="{$key}=:{$key},";
    endforeach;
 
    # Quitamos la coma final
 
    self::$Query = trim(self::$Query,",");
 
    self::$Query.=" WHERE ".array_key_first($datos)." =:".array_key_first($datos);
 
    try {
     /// valida si existe el ID  a modificar

     if(count(self::Search_($Tabla,array_key_first($datos),array_values($datos)[0]))>0):
     
     self::$pps = self::getConection()->prepare(self::$Query);
     
     foreach($datos as $key=>$data):
         self::$pps->bindValue(":{$key}",$data);
     endforeach;
 
     return self::$pps->execute();
    else:
    return "Error al modificar, ya que el ID ==> <b>".array_values($datos)[0]."</b> no existe";
    endif;
 
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }finally{
     self::CerrarBD();/// cierra la conexión a la bd
    }
    
}

 # METODO PARA VERIFICAR LA BUSQUEDA DE DATOS POR UN ATTRIBUTO

 public static function Search_(string $Tabla,string $atribute,$Value)
 {

  $Query = "SELECT *FROM ".$Tabla." WHERE {$atribute}=:{$atribute}";

  try {
    self::$pps = self::getConection()->prepare($Query);

    self::$pps->bindValue(":{$atribute}",$Value);

    self::$pps->execute();

    return self::$pps->fetchAll(\PDO::FETCH_OBJ);

    
  } catch (\Throwable $th) {
    echo $th->getMessage();
  }finally{
    self::CerrarBD();
  }
 }
 # METODO QUE REALIZA (INSERT,UPDATE Y DELETE)}
 

 public static function optimizeCud($Query,$datos=[])
 {
  try {
    self::$pps = self::getConection()->prepare($Query);

    for($i=0;$i<count($datos);$i++):
     self::$pps->bindParam(($i+1),$datos[$i]);
    endfor;

    return self::$pps->execute();
 
  } catch (\Throwable $th) {
    echo $th->getMessage();
  }finally{
    self::CerrarBD();
  }
 }
}


?>