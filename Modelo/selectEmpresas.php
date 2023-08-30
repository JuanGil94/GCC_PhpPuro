<?php
include_once 'configDB.php';
try{
    $array=array();
    $empresa='CSJ';
    $objeto=new Conexion();
    $conexion= $objeto->Conectar();
    $sentencia = $conexion->prepare("SELECT MaximoPesos,MaximoSalarios,MaximoUvt from Empresas where Empresa=?");
    $resultado = $sentencia->execute([$empresa]);
    $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $date){
        array_push($array,$date);
    }
    print json_encode($array,JSON_UNESCAPED_UNICODE);
}
catch (Exception $e) {
    echo "Ocurrió un error" . $e->getMessage();
}
?>