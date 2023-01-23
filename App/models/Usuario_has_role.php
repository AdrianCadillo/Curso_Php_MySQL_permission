<?php 
namespace models;

class Usuario_has_role extends OrmImpl{

private static string $Table = "usuario_has_role";

private static $Fillable=[
"id_usuario",
"id_role",
"estado",
"session"    
];

# METODO PARA ELIMINAR ROLES ASIGNADOS A LOS USUARIOS

public static function delete_($Id){
    return self::delete(self::$Table,self::$Fillable[0],$Id);
}

}

?>