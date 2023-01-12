<?php 
namespace Repository;
interface IOrm{

# METODO SIRVE PARA REALIZAR UN INSERT

public static function Insert_(string $Tabla,array $datos);

# METODO ES PARA ACTUALZIAR 

public static function Update(string $Tabla,array $datos);

 # METODO PARA VERIFICAR LA BUSQUEDA DE DATOS POR UN ATTRIBUTO

 public static function Search_(string $Tabla,string $atribute,$Value);

  # METODO QUE REALIZA (INSERT,UPDATE Y DELETE)}

  public static function optimizeCud($Query,$datos=[]);

}

?>