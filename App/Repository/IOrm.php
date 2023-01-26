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

  # METODO PARA REALIZAR BÚSQUEDAS POR WHEREAND

  public static function WhereAnd(string $Tabla,array $atributes);

  # METODO PARA REALIZAR BÚSQUEDAS POR WHEREOR

  public static function WhereOr(string $Tabla,array $atributes);

  # METODO PARA REALIZAR BÚSQUEDAS POR WHEREANDOR

  public static function WhereAndOr(string $Tabla,array $atributes,string $operador);

  # METODO PARA REALIZAR UNA BÚSQUEDA SIN CONDICIÓN

  public static function get($Tabla);

  # METODO PARA MOSTRAR DATOS POR ID

  public static function getBayId(string $Query,$Id);

  # METODO PARA ELIMINAR DATOS

  public static function delete(string $Tabla,$atributo,$value);

      /**
       * Buscador con varios parametros
       */
   public static function Search_Data($Query, $datos = []);



}

?>