<?php
class Conexion{
    public static function Conectar(){
        $contraseña = "Prueba2023";
        $usuario = "sa";
        $nombreBaseDeDatos = "GCC";
        $rutaServidor = "DESKTOP-61AJI0E";
        try
        {
            $conexion = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos;TrustServerCertificate=true", $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(Exception $e)
        {   
            die("El error de Conexión es: ".$e->getMessage());
        }
    }
}