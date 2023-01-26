<?php

use lib\BaseController;
use models\Rol;
use models\Usuario;

class LoginController extends BaseController {

/*===================
VISTA PARA LOGIN
====================*/ 

public $Roles;

private $Username;

private $Password;

private $Rol;

private string $redirectPageAdmin = "/usuario";

public function __construct()
{

    session_start();

    $this->Username = $_POST['email']??'';

    $this->Password = $_POST['password']??'';

    $this->Rol = $_POST['rol']??'';
}

public function index()
{
    # avlidamos la url 
    $this->Guest($this->redirectPageAdmin);

    $this->Roles =Rol::all();
    $this->render("Auth/Login_View");
}

/*===================
REALIZA PROCESO DE LOGIN
====================*/ 

public function login()
{
     # avlidamos la url 
     $this->Guest($this->redirectPageAdmin);
     
     if(count($this->Attemp())>0):
     # ID DEL USUARIO

     $Id_Usuario = $this->Attemp()[0]->id_usuario;

     # proceso de login de la tabla usuario_has_role

     $Login = Rol::WhereAnd("usuario_has_role",[
     "id_usuario"=>$Id_Usuario,
     "id_role"=>$this->Rol,
     "estado"=>'1'
     ]);

     if(count($Login)>0):

        # crear variables de sessión 

        $_SESSION['username'] = $this->getProfile()[0]->username; # obtenemos el nombre usuario

        $_SESSION['id_usuario'] = $this->getProfile()[0]->id_usuario; # obtenemos el id usuario

        $_SESSION['email'] = $this->getProfile()[0]->email; # obtenemos el email usuario

        $_SESSION['perfil'] = $this->getProfile()[0]->name_rol; # obtenemos el rol usuario

        $_SESSION['foto'] = $this->getProfile()[0]->foto; # obtenemos la foto usuario

        # mostramos la vista principal del Admin Dashboard

        $this->Redirect("/usuario");
        
     else:
        echo "CREDENCIALES INCORRECTAS";
     endif;

    else:

        echo "CREDENCIALES INCORRECTAS";
    
     endif;
}

/*===================
REALIZA PROCESO DE LOGIN
====================*/ 

protected function Attemp()
{
 # OBTENER EL ID DEL USUARIO QUE VA ACCEDER AL SISTEMA
 
 $Usuario= Usuario::WhereAnd("usuario",[
 "email"=>$this->Username,
 "pasword"=>md5($this->Password)
 ]);

 return $Usuario;

}

# METODO PARA OBTENER EL PERFIL DEL USUARIO

protected function getProfile()
{
 $Consulta = "call proc_profile(?,?);";

  return Usuario::Search_Data($Consulta,[$this->Username,$this->Rol]);
}



}