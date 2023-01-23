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

/*
CREAR USUARIOS
*/

public static function Modificar(array $datos){
    
    if(count(self::Search_(self::$Table,"username",$datos['username']))>0):
     return self::Update(self::$Table,["id_usuario"=>$datos['id_usuario'],"email"=>$datos['email']]);
    else:
    return self::Update(self::$Table,$datos);
    endif;
}

# ELIMINAR USUARIO

public static function eliminar($id){
 return self::delete(self::$Table,self::$Fillable[0],$id);
}


}

?>