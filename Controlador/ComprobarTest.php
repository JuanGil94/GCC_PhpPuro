<?php
include_once '../Modelo/models.php';
//Se toman las variables ingresadas por el usuario
//$usuario=$_POST['user'];
$usuario='juan';
//$password=$_POST['password'];
class DBTest{
    private $usuario;
    public function __construct($usuario){
        $this->usuario=$usuario;
    }

    public function getUsuario(){
        return $this->usuario;
    }
}

$respuesta= new DBTest ("juan");
$respuestaGet=$respuesta->getUsuario();
var_dump($respuestaGet);
echo ("variable ingresada: ".$respuestaGet);
/*
try{    
    if $usuario(empty($password) && empty($usuario)){
            //echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Document</title><script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script></head><body><script text='text/javascript'> swal('Hello world!');window.location='http://localhost:8081/GCC/Login_FF/index.html';);</script></body></html>";
            echo "<script language='javascript'>alert('Error: Debe ingresar usuario y contraseña');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
        exit();
    }
    else if (empty($usuario)){
        echo "<script language='javascript'>alert('Error: Debe ingresar usuario');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
        exit();
    }
    else if (empty($password)){
        echo "<script language='javascript'>alert('Error: Debe ingresar contraseña');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
        exit();
    }
    else if (preg_match('/^</', $usuario)){
        echo "<script language='javascript'>alert('Error: El nombre de Usuario no debe empezar con caracteres especiales');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
    }
        $respuesta=new DB;
        $s=$respuesta->seleccionar($usuario,$password);
        $ss=$respuesta->validarSeccionales($usuario);
        if ($s){
            require ("../Index.php");    
        }
    }
catch (Exception $e) {
    echo "Ocurrió un error" . $e->getMessage();
}
*/
