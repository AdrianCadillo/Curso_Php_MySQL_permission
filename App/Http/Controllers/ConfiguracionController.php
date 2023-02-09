<?php

use lib\BaseController;

class ConfiguracionController extends BaseController
{

private string $NameResplado;

private string $NombreArchivoSql;

private string $NameArchivoZip ;

private $File;

private array $TipoAccept = ['application/octet-stream']; 

public function __construct()
{
    session_start();

    $this->Auth($this->getRedirectLogin());

    $this->NameResplado = $_POST['name_copia'] ?? '';

    $this->File = $_FILES['file_sql'] ??'';
}

# mostramos la vista para realizar el backup y el respaldo de la base de datos

public function basedatos()
{
     
# mostramos la vista 

$this->view_("config/securityView.php");

}

# GENERAL LA COPIA DE SEGURIDAD(RESPLADO DE LA BASE DE DATOS) 
public function generar_Copia()
{
if(isset($_POST['respaldo'])):
 $this->NameResplado = $this->juntarTexto($this->NameResplado);

 $this->NameResplado.="_".date("YmdHis");
    
 $this->NombreArchivoSql = $this->NameResplado.".sql";

 # comando mysqlDump

 $MysqlDump = "mysqldump --routines -h".SERVER." -u".USUARIO." -p".PASSWORD." ".DBNAME." > {$this->NombreArchivoSql}";

 system($MysqlDump,$output);

 if($output == '0'):

    $zip = new ZipArchive();

    $this->NameArchivoZip = $this->NameResplado.".zip";

   /*==================================
    madamos a descarga automática
   ===================================*/

   header("Cache-Control: public");
   header("Content-Description: File Transfer");
   header("Content-Disposition: attachment; filename=".basename($this->NameArchivoZip));
   header("Content-Type: application/zip");
   header("Content-Transfer-Encoding: binary");

/*=============================
si el zip se crea, entonces que agregue
archivos como el backup por ejemplo
===============================*/

if($zip->open($this->NameArchivoZip,ZIPARCHIVE::CREATE) === true):

   $zip->addFile($this->NombreArchivoSql);
 
   $zip->close();

   unlink($this->NombreArchivoSql);

   ob_clean();

   flush(); /// eliminamos el bufffer generado

   readfile(($this->NameArchivoZip));

   # redirigimos a la misma página

   $this->Redirect("/configuracion/basedatos");

   unlink($this->NameArchivoZip);/// eliminamos lo que se crea en la raiz del proyecto

 endif;
 endif;
else:
    $this->Redirect("/configuracion/basedatos");  
endif;

}

# metodo para restaurar el sistema

public function restore()
{
if(isset($_POST['restaurar'])):

$TipoArchivo = $this->File['type'];

$this->File = $this->File['tmp_name'];

if(in_array($TipoArchivo,$this->TipoAccept)):

# crear el comando para la restauración de la base de datos

$Mysql = "mysql -h".SERVER." -u".USUARIO." -p".PASSWORD." ".DBNAME." < {$this->File}";

system($Mysql,$output);  

if($output == '0'):
$this->AsignValueSession("mensaje","success");
else:
    $this->AsignValueSession("mensaje","error");
endif;
else:
$this->AsignValueSession("mensaje","error_archivo");
endif;
endif;

# redirigir 

$this->Redirect("/configuracion/basedatos");
}
}