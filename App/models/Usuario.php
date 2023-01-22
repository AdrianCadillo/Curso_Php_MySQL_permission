<?php 
namespace models;

class Usuario extends OrmImpl {

private static string $Table = "usuario";

private static array $Fillable= [
"id_usuario",
"username",
"email",
"pasword",
"foto"
];

/*
Recuperar el Id del usuario
*/

public static function getId($valor){
    return self::Search_(self::$Table,"username",$valor);
}

/*
CREAR USUARIOS
*/

public static function Create(array $datos){
    
    if(count(self::Search_(self::$Table,"username",$datos['username']))>0):
     return "existe";
    else:
    return self::Insert_(self::$Table,$datos);
    endif;
}
}

?>