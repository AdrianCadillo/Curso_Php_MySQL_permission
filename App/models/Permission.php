<?php 
namespace models;

class Permission extends OrmImpl {
 
private static string $Table = "permission";

private static array $fillable= [
"id_permiso",
"name_permiso",
"descripcion",
"id_modulo"    
];

# mostrar todos los permisos

public static function all(){
return self::get(self::$Table);    
}

/*========================
Registrar los roles
==========================*/
public static function create(array $datos)
{
if(count(self::Search_(self::$Table,self::$fillable[1],$datos['name_permiso']))>0):
return "existe";
else:
return self::Insert_(self::$Table,$datos);
endif;
}
}
?>