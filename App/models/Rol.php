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
/*========================
Registrar los roles
==========================*/
public static function create(array $datos)
{
if(count(self::Search_(self::$Table,self::$Fillable[1],$datos['name_rol']))>0):
return "existe";
else:
return self::Insert_(self::$Table,$datos);
endif;
}

# eliminar los roles

public static function destroy($Id){
 
    # eliminar los permisos de los roles

    Rol_has_permission::destroy($Id);

    # eliminar los roles asignados a los usuarios , hacemos uso de la tabla usuarios_has_role

    self::delete("usuario_has_role","id_role",$Id);

    # eliminar el rol

   return self::delete(self::$Table,"id_role",$Id);
}

# mostrar por Id

public static function filtrarXId($dato){

    return self::Search_(self::$Table,self::$Fillable[0],$dato);
}

# mostrar por nombre del rol

public static function filtrarXNameRol($dato){

    return self::Search_(self::$Table,self::$Fillable[1],$dato);
}

# mostrar los permisos asignados y no asignados de cada rol

public static function showPermissionAsigned_no_Asigned($Id,string $condicion =''){

    self::$Query = "select *from permission 
    where id_permiso {$condicion} in(select id_permiso from rol_has_permission
    where id_role=?);";

    return self::getBayId(self::$Query,$Id);
}

/*========================
MODIFICAR los roles
==========================*/
public static function modify(array $datos)
{
if(count(self::Search_(self::$Table,self::$Fillable[1],$datos['name_rol']))>0):
return "existe";
else:
return self::Update(self::$Table,$datos);
endif;
}

# metodo que realizar la asignación de permisos a roles

public static function AsingPermission(array $datos){
return self::Insert_("rol_has_permission",$datos);
}
}

?>