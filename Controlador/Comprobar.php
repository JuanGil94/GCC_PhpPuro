<?php
//echo "<script language='javascript'>location.reload()</script>";
include_once '../Modelo/models.php';
//Se toman las variables ingresadas por el usuario
$usuario=$_POST['user'];
$password=$_POST['password'];
try{    
    if (empty($password) && empty($usuario)){
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
        if ($s){
            session_start(); // se inicia la session
            $_SESSION['usuario']=$usuario;
            //header("Location:../index.php");
            require ("../index.php");    
        }
    }
catch (Exception $e) {
    echo "Ocurrió un error" . $e->getMessage();
}