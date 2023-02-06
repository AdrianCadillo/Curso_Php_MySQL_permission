<?php

use lib\BaseController;
use models\Permission;

class PermissionController extends BaseController
{

private string $NamePermiso;

private string $Descripcion;

private string $Modulo;

public function __construct()
{
    session_start();

    $this->NamePermiso = $_POST['name_permiso'] ??'';

    $this->Descripcion = $_POST['descripcion'] ??'';

    $this->Modulo = $_POST['modulo'] ??'';

}

# METODO PARA GUARDAR LOS PERMISOS

public function save()
{
 $this->Auth($this->getRedirectLogin());

 if(isset($_POST['accion'])):
  if($_POST['accion'] === 'save'):
   echo Permission::create([
    "name_permiso"=>$this->NamePermiso,
    "descripcion"=>$this->Descripcion,
    "id_modulo"=>$this->Modulo
   ]);
  endif;
 endif;
}
}