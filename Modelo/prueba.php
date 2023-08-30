<?php
class DB {
    private $usuarioId;
    public function prueba1(){
        $usuarioId=10;
        $this->usuarioId=$usuarioId;
    }
    public function prueba2(){
        echo ("el valor ingresado esssssss ".$this->usuarioId);
        return $this->usuarioId;
    }
}
$respuesta=new DB;
$respuesta->prueba1();
$valor=$respuesta->prueba2();
echo ("el valor ingresado es ".$valor);