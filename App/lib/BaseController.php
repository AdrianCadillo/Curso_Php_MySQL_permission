<?php
namespace lib;

use models\Modulo;
use models\OrmImpl;

class BaseController extends View{

/*
METODO PARA REDIRECCIONAR PÁGINAS
*/
private string $redirectLogin = "/login";
 
 
public static function Redirect($ruta_)
{
 header("Location:{$ruta_}");
}


public function getRolesUsuario($id_user){


 $Query = "call proc_roles_del_usuario(?);";

 return OrmImpl::getBayId($Query,$id_user);
}

/// metodo para redireccionar a una página 
public function getRedirectLogin()
{
    return $this->redirectLogin;
}

# METODO PARA MOSTRAR LA FOTO DEL USUARIO QUE ACCEDE AL SISTEMA

public function getFoto():string {
$Foto = "public/libs/images/anonimo.png";

if($this->getSession("foto")):

 if(file_exists("public/fotos/{$this->getValueSession("foto")}")):
  $Foto = "public/fotos/{$this->getValueSession("foto")}";
 endif;
endif;

return $Foto;
}

# METODO QUE REALIZA EL PROCESO DE IMPORTAR EXCEL

public function importExcel($Excel)
{
 $Datos = [];

 $i = 0;
 # recorrer en un bucle

 foreach($Excel as $Dato):
  
  if($i !=0 ):
    $Dato = explode(";",$Dato);

    array_push($Datos,$Dato);
  
  endif;

  $i++;
 endforeach;

 return $Datos;

}

 # ASIGNAR VALOR A UNA VARIABLE DE SESSION

 public function AsignValueSession($Name_Session,$Value_Session):void{
   $_SESSION[$Name_Session] = $Value_Session; 
 }

 # MOSTRAR LOS MODULOS EN EL SIDEBAR

 public function showModules(){
  return Modulo::all();
 }



}
?>