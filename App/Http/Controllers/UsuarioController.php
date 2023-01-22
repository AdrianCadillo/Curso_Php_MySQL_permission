<?php

use database\Conexion;
use lib\BaseController;
use models\OrmImpl;
use models\Usuario;

class UsuarioController extends BaseController{

    public  $roles_;

    private $Foto;

    private string $Destino = "public/fotos/";

    private string $Username;

    private string $Email;

    private string $Pasword;

    public array $Usuarios;

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

        // registro de usuarios

        if (Usuario::Create([
            "username" => $this->Username,
            "email" => $this->Email,
            "pasword" => md5($this->Pasword),
            "foto" => $this->getValidateFoto() > 0 ? $NameFoto : null
        ]) === 'existe') :

            $_SESSION['mensaje'] = "existe";

        else :

            $_SESSION['mensaje'] = "1";

            $this->validateRoles();
            
        endif;
     self::Redirect("/usuario/create");
    }

    /**
     * VALIDAR SI SELECCIONAMOS POR LO MENOS UN ROL
     */

    private function validateRoles()
    {
        if (isset($_POST['rol'])) :

            $IdUsuario = Usuario::getId($this->Username)[0]->id_usuario;

            foreach ($_POST['rol'] as $rol) :
            Usuario::Insert_("usuario_has_role",[
               "id_usuario"=>$IdUsuario,
               "id_role"=>$rol 
            ]);
            endforeach;
        else :
           $_SESSION['mensaje'] = "2";
        endif;
    }

    /*
     METODO SIRVE PARA VALIDAR LA FOTO
     */

    private function getValidateFoto(): int
    {
        return $this->Foto['size'];
    }

    public function editar($parametro = null)
    {
        if (isset($parametro)) :
            echo "soy de editar información " . $parametro[0];

        endif;
    }
    /// usuario y roles
    public function test(){}
}

?>