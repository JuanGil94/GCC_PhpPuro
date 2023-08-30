<?php
try {
    include_once 'configDB.php';
    if (isset($_GET["w1"])) {
        $phpVar1 = $_GET["w1"];
    }
    $fechaSalario=intval($phpVar1);
    //print ("Hola, la fecha tomada para liquidar salarios es:".$fechaSalario);
    $objeto=new Conexion();
    $conexion= $objeto->Conectar();
    $sentencia = $conexion->prepare("SELECT [Uvt]
    FROM [GCC].[dbo].[Uvts]
    where Ano=?");
    $resultado = $sentencia->execute([$fechaSalario]);
    $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $date){
        echo $date['Uvt'];
    }
    $conexion=null; //Se limpia la conexion
    $sentencia=null; // Se limpia la sentencia
}
catch (Exception $e) {
    echo "Ocurrió un error" . $e->getMessage();
}