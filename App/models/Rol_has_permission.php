<?php
namespace models;

class Rol_has_permission extends OrmImpl {

private static string $Table = "rol_has_permission";

private static array $fillable = [
  "id_permiso",
  "id_role"  
]; 

# metodo asignar permisos a los roles

public static function AsingPermission(array $datos)
{
return self::Insert_(self::$Table,$datos);
}

public static function destroy($Id){
  return self::delete(self::$Table,self::$fillable[1],$Id);
}
}