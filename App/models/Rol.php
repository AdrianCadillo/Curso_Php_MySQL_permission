<?php 
namespace models;

class Rol extends OrmImpl {

private static string $Table = "rol";

private static array $Fillable = [
"id_role",
"name_rol"
];
/*========================
mostrar los roles
==========================*/

public static function all()
{
return self::get(self::$Table);
}
}

?>