<?php 
namespace lib;
class View {
  private string $raiz_View = "resources/views/";

  private string $Dashboard;

  private string $Sidebar;

  private string $Vista_;

  private string $Footer;

  private string $Jquery="public/libs/base.php";

  private string $DataTable = "public/libs/DataTable.php";

    public function view_($vista):void{

      $this->Dashboard = $this->raiz_View."components/Dashboard.php"; 
      
      $this->Sidebar = $this->raiz_View."components/menu_vertical.php";

      $this->Vista_ = $this->raiz_View.$vista;

      $this->Footer = $this->raiz_View."layouts/plantilla_footer.php";

      if($this->File_Existe($this->Dashboard,$this->Sidebar,$this->Vista_,
       $this->Footer,$this->Jquery,$this->DataTable)):
      require_once $this->Dashboard;

      require_once $this->Sidebar;


      require_once $this->Jquery;
      
      require_once $this->Vista_;

      require_once $this->Footer;

      require_once $this->DataTable;
   
      else:
        echo "error";
      endif;
    }

    # AVLIDAR LA EXISTENCIA DE LOS ARCHIVOS

    private function File_Existe(string $Dashboard_,string $Sidebar_,
    string $view__,string $footer_,string $jquery_,string $DataTable_):bool{
     return (file_exists($Dashboard_) and file_exists($Sidebar_)
             and file_exists($view__) and file_exists($footer_) 
             and file_exists($jquery_) and file_exists($DataTable_));   
    }
}

?>