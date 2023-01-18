<?php

use database\Conexion;
use lib\BaseController;
use models\OrmImpl;

class UsuarioController extends BaseController{

    public  $roles_;

    private $Foto;

    private string $Destino = "public/fotos/";

    public function __construct()
    {
        $this->Foto = $_FILES['foto']??'';
    }
    
    public function index(){

        $this->view_("usuario/Index_View.php");
    }

    public function create(){
     
        $this->roles_ = OrmImpl::get("rol");

        $this->view_("usuario/create.php");
    }

    /**
     * METODO PARA CREAR USUARIOS
     */

     public function save()
     {
      if($this->getValidateFoto()>0):
       /// proceso de registro 
      $Imagen = $this->Foto['tmp_name'];

      $this->Destino.=date("Ymd_His").rand().".jpg";

      if(move_uploaded_file($Imagen,$this->Destino)):
      /// hacer proceso de registro usuario
       $this->validateRoles();
      else:
        echo "ERROR AL CREAR USUARIO";
      endif;

      else:
        echo "Seleccione una foto";
      endif;
     }

     /**
      * VALIDAR SI SELECCIONAMOS POR LO MENOS UN ROL
      */

      private function validateRoles()
      {
        if(isset($_POST['rol'])):
         foreach($_POST['rol'] as $rol):
         /// asigna el rol a los usuarios
         endforeach;
        else:
            echo "Seleccione por lo menos un rol";
        endif;
      }

     /*
     METODO SIRVE PARA VALIDAR LA FOTO
     */

     private function getValidateFoto(): int
     {
        return $this->Foto['size'];
     }

    public function editar($parametro=null){
     if(isset($parametro)):
        echo "soy de editar información ".$parametro[0];
     
     endif;
    }
   /// usuario y roles
    public function test()
    {     
    
    }
}

?>