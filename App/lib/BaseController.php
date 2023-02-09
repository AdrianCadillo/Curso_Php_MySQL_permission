<?php
namespace lib;

use models\Modulo;
use models\OrmImpl;
use models\Rol;

class BaseController extends View{

/*
METODO PARA REDIRECCIONAR PÁGINAS
*/
private string $redirectLogin = "/login";
 
private array $Permissions = ['index','create','editar','delete'];

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

  /**
   * METODO PARA JUNTAR TEXTO QUE TIENEN ESPACIO
   *  */    
  function juntarTexto($cadena){
    $texto="";
    $longitud=strlen($cadena);/// la longitud de la cadena
    $i=0;
    while($i<$longitud){
    if(substr($cadena,$i,1)==' '){
    $texto.="_";
    }else{
    $texto.=substr($cadena,$i,1);
    }
    $i++;
    }
    return $texto;
    }

# metodo que autoriza los permisos a los usuarios

public function Autorize(string $permiso):bool
{
 return Rol::Autorize($this->getValueSession("id_perfil"),$permiso);
}

# metodo can
public function can($Name_Modulo):bool{
  return ($this->Autorize("{$Name_Modulo}.{$this->Permissions[0]}") or 
  ($this->Autorize("{$Name_Modulo}.{$this->Permissions[0]}") and $this->Autorize("{$Name_Modulo}.{$this->Permissions[1]}")) or 
  ($this->Autorize("{$Name_Modulo}.{$this->Permissions[0]}") and $this->Autorize("{$Name_Modulo}.{$this->Permissions[2]}") ) 
  or ($this->Autorize("{$Name_Modulo}.{$this->Permissions[0]}")  and $this->Autorize("{$Name_Modulo}.{$this->Permissions[3]}") ) );
}

# retornamos los permisos

public function getPermission()
{
return $this->Permissions;
}

}
?>