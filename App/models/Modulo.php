<?php
namespace models;

class Modulo extends OrmImpl {

private static string $Table = "modulo";

private static array $fillable = [
"id_modulo",
"name_modulo",
"key_modulo"
];

# método para crear nuevos modulos

public static function create(array $datos)
{
 if(count(self::Search_(self::$Table,self::$fillable[1],$datos['name_modulo']))>0):
    return "existe";
 else:
  return self::Insert_(self::$Table,$datos);
 endif;
}

# retorna todos los modulos

public static function all()
{
return self::get(self::$Table);
}

}