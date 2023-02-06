<?php

use lib\BaseController;
use models\Modulo;

class ModuloController extends BaseController {

private $Excel_Archivo;

public array $modulos;

private string $NombreModulo;

private string $KeyModulo;

public function __construct()
{
  session_start();

  $this->Excel_Archivo = $_FILES['excel_module']??'';

  $this->NombreModulo = $_POST['nm'] ?? '';

  $this->KeyModulo = $_POST['km'] ?? '';
}  

/*======================= 

VISUALIZAR LA VISTA DE IMPORTAR DATOS 
DEL MODULO
========================*/

public function import(){
  # valida la url para no acceder al sistema sin antes de estar logueado
  $this->Auth($this->getRedirectLogin());

  # enviamos la data de modulos
  $this->modulos = Modulo::all();
  # mostramos la vista de importar datos desde excel a la bd

  $this->view_("Module/ImportView.php");
}
/*======================= 

METODO PARA REALZIAR EL PROCESO DE IMPORTAR DATOS DESDE EXCEL
========================*/

public function import_data()
{
  # valida la url para no acceder al sistema sin antes de estar logueado
 $this->Auth($this->getRedirectLogin()); 

 if($this->Excel_Archivo['size']>0):
 $this->Excel_Archivo = file($this->Excel_Archivo['tmp_name']); 
 foreach($this->importExcel($this->Excel_Archivo) as $dato):
 /// proceso para insertar

 $Value = Modulo::create(
  [
   "name_modulo"=> mb_convert_encoding($dato[0],'UTF-8', 'ISO-8859-1'),
   "key_modulo" => mb_convert_encoding(trim($dato[1]),'UTF-8', 'ISO-8859-1') 
  ]
 );
 endforeach;

 $this->AsignValueSession("mensaje",$Value);
 else:
  $this->AsignValueSession("mensaje","vacio");
 endif;

 # redirigimos a otra pagina

 $this->Redirect("/modulo/import");
 
}

# METODO QUE EXPORTA REPORTE A TXT

public function export_txt()
{
    # valida la url para no acceder al sistema sin antes de estar logueado
 $this->Auth($this->getRedirectLogin()); 
  $item = 0;
   # creamos el nombre del archivo

   $Reporte_Name_txt = "Reporte_modulos";

   $Reporte_Name_txt.=date("YmdHis")."_".rand().".txt";

   # creamos el txt

   $File_txt = fopen($Reporte_Name_txt,"w");

   # traer la data desde la base de datos

   $Dato_Modulos = Modulo::all();

  foreach($Dato_Modulos as $dato):

    $item+=1;
  # escribir en el txt

  fwrite($File_txt,"************* REPORTE DEL MODULO {$item} *************\n\n");

  fwrite($File_txt,"NOMBRE MODULO : {$dato->name_modulo}\n");
  fwrite($File_txt,"KEY MODULO : {$dato->key_modulo}\n\n");

  fwrite($File_txt,"************* FIN REPORTE DEL MODULO *************\n\n");
  endforeach;
  
  fclose($File_txt);

  /// leemos el archivo txt generado
  readfile($Reporte_Name_txt);
  /************************ DESCARGA AUTOMÁTICA DEL ARCHIVO TXT ************************ */
  header( "Content-Type: application/octet-stream");
  header( "Content-Disposition: attachment; filename=".$Reporte_Name_txt.""); //archivo de salida 
  /************************* FIN PROCESO DE DESCARGA ARCHIVO TXT *********************** */
  unlink($Reporte_Name_txt);

}

# llamamos al metodo proceso modificar

public function update($data= null)
{
  # valida la url para no acceder al sistema sin antes de estar logueado
  $this->Auth($this->getRedirectLogin()); 
 
  if(isset($_POST['accion'])):
  if($_POST['accion'] === 'update'):
    $this->modify($data[0]);
  endif;
  endif;

}

# proceso para modificar

private function modify($Id)
{
 echo Modulo::modify([
  "id_modulo"=>$Id,
  "name_modulo"=>$this->NombreModulo,
  "key_modulo"=>$this->KeyModulo  
  ]);
}

# eliminar módulos

public function delete($data = null)
{
    # valida la url para no acceder al sistema sin antes de estar logueado
    $this->Auth($this->getRedirectLogin()); 
 
    if(isset($_POST['accion'])):
     if($_POST['accion'] === 'delete'):
      echo Modulo::destroy($data[0]);
     endif;
    endif;

}

}

?>