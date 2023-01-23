<?php

use database\Conexion;
use lib\BaseController;
use models\OrmImpl;
use models\Usuario;
use models\Usuario_has_role;

class UsuarioController extends BaseController{

    public  $roles_;

    private $Foto;

    private string $Destino = "public/fotos/";

    private string $Username;

    private string $Email;

    private string $Pasword;

    public array $Usuarios;

    public $Roles_Asignados;

    public $Roles_No_Asignados;

    public function __construct()
    {

        session_start();

        $this->Foto = $_FILES['foto'] ?? '';

        $this->Username = $_POST['username']??'';

        $this->Email = $_POST['email']??'';

        $this->Pasword = $_POST['pasword']??'';
    }

    public function index()
    {
         $this->Usuarios = Usuario::get("usuario");
        $this->view_("usuario/Index_View.php");
   
    }

    public function create()
    {

        $this->roles_ = OrmImpl::get("rol");

        $this->view_("usuario/create.php");
    }

    /**
     * METODO PARA CREAR USUARIOS
     */

    public function save()
    {
        if ($this->getValidateFoto() > 0) :
            /// proceso de registro 
            $Imagen = $this->Foto['tmp_name'];

            $NameFoto = date("Ymd_His") . rand() . ".jpg";

            $this->Destino .= $NameFoto;

            move_uploaded_file($Imagen, $this->Destino);
            
        endif;

     $this->AssingRoles($NameFoto);
       
     self::Redirect("/usuario");
    }

    /**REGISTRAR UN USUARIO */

    public function SaveUsuario($NameFoto_)
    {
                // registro de usuarios
      $_SESSION['mensajes'] = Usuario::Create([
        "username" => $this->Username,
        "email" => $this->Email,
        "pasword" => md5($this->Pasword),
        "foto" => $this->getValidateFoto() > 0 ? $NameFoto_ : null
    ]);
    }

    /**
     * VALIDAR SI SELECCIONAMOS POR LO MENOS UN ROL
     */

    private function AssingRoles($NameFoto_)
    {
        /// registrar un usuario
        $this->SaveUsuario($NameFoto_);

        if (isset($_POST['rol'])) :

            $IdUsuario = Usuario::getId($this->Username)[0]->id_usuario;

            foreach ($_POST['rol'] as $rol) :
            Usuario::Insert_("usuario_has_role",[
               "id_usuario"=>$IdUsuario,
               "id_role"=>$rol 
            ]);
            endforeach;
        endif;
    }

    /*
     METODO SIRVE PARA VALIDAR LA FOTO
     */

    private function getValidateFoto(): int
    {
        return $this->Foto['size'];
    }

    public function editar($dato)
    {
    
    /// consulta procedimiento almacenado para mostrar los roles asignados del usuario
    $Query_Roles_Asignados = "call proc_roles_asignados(?);";

     /// consulta procedimiento almacenado para mostrar los roles asignados del usuario
    $Query_Roles_No_Asignados = "call proc_roles_no_asignados(?);";

    
    // enviar los datos de edicion

     

    $this->Usuarios = Usuario::Search_("usuario","id_usuario",$dato[0]);

    /// mostrar todos los roles que existen

    $this->roles_ = Usuario::get("rol");

    /// mostrar los roles asignados de un usuario

    $this->Roles_Asignados = Usuario::getBayId($Query_Roles_Asignados,$dato[0]);

    /// mostrar los roles no asignados de un usuario

    $this->Roles_No_Asignados = Usuario::getBayId($Query_Roles_No_Asignados,$dato[0]);
    /// llamamos a la vista editar usuarios

    $this->view_("usuario/EditarUsuarioView.php");
    }
    /// usuario y roles
    public function test(){}
  
  /**MODIFICAR LOS DATOS DEL USUARIO */

   public function modify($data){
   
   /// modificar los datos del usuario
   $_SESSION['mensaje_update'] = Usuario::Modificar([
    "id_usuario"=>$data[0],
    "username"=>$this->Username,
    "email"=>$this->Email
   ]);

   /// Eliminar los roles asignados de un usuario

   Usuario_has_role::delete_($data[0]);

   // Asignarle nuevamente los roles a los usuarios

   if (isset($_POST['rol'])) :

    foreach ($_POST['rol'] as $rol) :
    Usuario::Insert_("usuario_has_role",[
       "id_usuario"=>$data[0],
       "id_role"=>$rol 
    ]);
    endforeach;
  endif;
  
  $this->Redirect("/usuario");
   
   } 

 # METODO PARA ELIMINAR USUARIO
 
 public function delete($data){
  if(isset($_POST['accion'])):
   if($_POST['accion'] === 'delete'):

    /// eliminar los roles del usuario

    /// Eliminar los roles asignados de un usuario

   Usuario_has_role::delete_($data[0]);
   
   echo Usuario::eliminar($data[0]);
   endif;
  endif;
 }
 
}

?>