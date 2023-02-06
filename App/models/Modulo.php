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

# método para modificar modulos

public static function modify(array $datos)
{
 if(count(self::Search_(self::$Table,self::$fillable[1],$datos['name_modulo']))>0):
   return self::Update(self::$Table,[
    "id_modulo"=>$datos['id_modulo'],
    "key_modulo"=>$datos['key_modulo']
   ]);
 else:
   if(count(self::Search_(self::$Table,self::$fillable[1],$datos['key_modulo']))>0):
      return self::Update(self::$Table,[
         "id_modulo"=>$datos['id_modulo'],
         "name_modulo"=>$datos['name_modulo']
        ]);
      else:
         return self::Update(self::$Table,$datos);
   endif;
 endif;
}
#eliminar módulos

public static function destroy($Id){
   if(count(self::Search_("permission",self::$fillable[0],$Id))>0):
    return "2";
   else:
      return self::delete(self::$Table,self::$fillable[0],$Id);
   endif;
}

}