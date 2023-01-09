<?php 
namespace lib;
class Route {

/// atributos
private static array $Ruta;

/*=======================
OBTENER LA URL EN ARRAY
=========================*/
private static function getUrl() {
   if(isset($_GET['ruta'])):
    self::$Ruta = explode("/",$_GET['ruta']);
   endif;
   return self::$Ruta;
}
/*=======================
OBTENER EL NOMBRE DEL CONTROLADOR 
=========================*/
private static function getNameController():string
{
 return (!empty(self::getUrl()[0])?
        ucwords(self::getUrl()[0])."Controller":'');
}
/*=======================
OBTENER EL NOMBRE DEL MÉTODO
=========================*/
private static function getNameMethod():string
{
 return !empty(self::getUrl()[1])?self::getUrl()[1]:'';
}
/*=======================
VALIDAR EL PROCESO DEL ROUTING
=========================*/

public static function getValidateRouting(){
if(!empty(self::getNameController())):
$controlador = self::getNameController();

$FileController = "App/Http/Controllers/".$controlador.".php";

if(file_exists($FileController)):
/// requerimos el archivo
require_once $FileController;

/// instanciamos un objeto a la clase controlador
$Objeto = new $controlador;

$Methodo = self::getNameMethod();

if(method_exists($Objeto,$Methodo)):
self::getParams($Objeto,$Methodo);
else:
  $Objeto->index();
endif;

/// llamamos al método

 
else:
    echo "controlador no existe";
    /// Home --> inicio
endif;
else:
/// Home index
endif;
}
/*=======================
VALIDAR LOS PARAMETROS DEL MÉTODO DE LA CONTROLLER
=========================*/

private static function getParams($objeto,$methodo):void{
$ParametrosSize = sizeof(self::getUrl());

if($ParametrosSize>2):
$Parametros = [];

for ($i=2; $i <$ParametrosSize ; $i++) { 
   array_push($Parametros,self::getUrl()[$i]);
}
$objeto->{$methodo}($Parametros);
else:
$objeto->{$methodo}();   
endif;
}


}

?>