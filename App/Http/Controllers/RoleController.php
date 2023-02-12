<?php

use lib\BaseController;
use models\Modulo;
use models\Permission;
use models\Rol;
use models\Rol_has_permission;

class RoleController extends BaseController{

public array $Modulos;    

private string $NameRol;

public array $Role;

public array $Permissions;

public array $Permissions_Asigned;

public array $Permissions_No_Asigned;

public function __construct()
{
    session_start();

    $this->Auth($this->getRedirectLogin());  

    $this->NameRol = $_POST['rolname'] ?? '';
    
}  

# METODO PARA MOSTRAR LA VISTA PRINCIPAL

public function index()
{
 # mostrar la vista de index
 if($this->Autorize("Rol.{$this->getPermission()[0]}")):

 $this->view_("Role/IndexView.php");
 
 else:
    $this->view_("error/errorViewnoAutorized.php");
 endif;
}

# mostrar la vista de crear  roles

public function create()
{

    # enviamos todos los módulos

    $this->Modulos = Modulo::all();

    # llamamos a la vista roles

    $this->view_("Role/CreateView.php");
}

# mostrar los datos de los permisos

public function show_permisos()
{ 

  echo json_encode(['permisos'=>Permission::all()]);  
}

# crear nuevos roles

public function store(){

# proceso para crear nuevos roles

$SaveRol = Rol::create([
"name_rol"=>$this->NameRol   
]);

if($SaveRol !== 'existe'):

$this->AsignValueSession("mensaje","1");

$Rol = Rol::Search_("rol","name_rol",$this->NameRol);

# asignar los permisos a los roles
if(isset($_POST['permisos'])):
foreach($_POST['permisos'] as $permission):
Rol_has_permission::AsingPermission([
"id_permiso" =>$permission,
"id_role"=> $Rol[0]->id_role   
]);
endforeach;
endif;
else:
    $this->AsignValueSession("mensaje","existe");  
endif;

# redirigir a una pagina en este caso a role/craete

$this->Redirect("/role/create");
}

# mostrar los roles y sus permisos en formato json

public function showRoles(){
 
$Roles ="";

foreach(Rol::all() as $role):
 $Roles.='{
    "id_role":"'.$role->id_role.'",
    "name_rol":"'.$role->name_rol.'",
    "permissions":[';

    foreach(Rol::Search_("rol_has_permission","id_role",$role->id_role) as $rol_has_permission):
        foreach(Permission::Search_("permission","id_permiso",$rol_has_permission->id_permiso) as $permission):
           $Roles.='"'.$permission->descripcion.'",';
        endforeach;
    endforeach;

    $Roles = trim($Roles,",");

 $Roles.=']},'; 
    
endforeach;


$Roles = trim($Roles,",");

echo $Roles = '{"roles":['.$Roles.']}';

}

# metodo para eliminar los roles
public function delete($data = null){

   echo  Rol::destroy($data[0]);
}

# editar los roles

public function editar($data = null){


# mostrar el rol a editar

if(count($this->Role = Rol::filtrarXId($data[0]))>0 and count($this->Role = Rol::filtrarXNameRol($data[1]))>0):

# mostramos el ro a editar
$this->Role = $this->Role = Rol::filtrarXId($data[0]);

# mostrar los permisos

$this->Permissions = Permission::all();

# mostrar los permisos asignados al rol a editar

$this->Permissions_Asigned = Rol::showPermissionAsigned_no_Asigned($data[0]);

# mostrar los permisos no asignados del rol


$this->Permissions_No_Asigned = Rol::showPermissionAsigned_no_Asigned($data[0],'not');

else:
$this->Redirect("/role");
endif;

# mostrar la vista para editar

$this->view_("Role/EditarView.php");

}

# MODIFICAR LOS ROLES

public function update($data=null){
 
#  modificar a los roles
if($this->getValueSession("perfil") !== $data[1]):
Rol::modify(['id_role'=>$data[0],'name_rol'=>$this->NameRol]);
endif;

# eliminar los permisos asignados al a rol a editar

Rol_has_permission::destroy($data[0]);

# validamos si existe por lo menos un seleccionado

if(isset($_POST['permission'])):
 foreach($_POST['permission'] as $permiso):
 # volvemos a asignar los nuevos permisos del sistema

 Rol::AsingPermission([
  "id_permiso"=>$permiso,
  "id_role"=>$data[0]  
 ]);
 endforeach;
endif;

$this->AsignValueSession("mensaje","1");

# vamos a redirigir 

$this->Redirect("/role");

}
 
}