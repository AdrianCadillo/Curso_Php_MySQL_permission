<?php 
namespace lib;
class View {

    public function view_($vista):void{
    require_once 'resources/views/'.$vista;
    }
}

?>