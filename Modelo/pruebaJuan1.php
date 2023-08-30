<?php
include_once 'configDB.php';
$objeto=new Conexion();
$noChequeo=227348;
$conexion= $objeto->Conectar();
$sentencia4 = $conexion->prepare("SELECT MAX(Numero) AS Numero FROM Procesos WHERE SeccionalId=17");
$sentencia5 = $conexion->prepare("SELECT year(getdate())AS Fecha");
$sentencia6 = $conexion->prepare("SELECT S.Codigo AS Codigo FROM Seccionales S
INNER JOIN Chequeos C ON C.SeccionalId=S.SeccionalId
WHERE C.ChequeoId=?");
$resultado = $sentencia6->execute([$noChequeo]);
$result=$sentencia6->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $date){
    //print_r($date);
    //echo $date['Documento'];
    $seccionalChequeo=$date['Codigo'];
}
$resultado = $sentencia5->execute();
$result=$sentencia5->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $date){
    //print_r($date);
    $anoFecha=$date['Fecha'];
    //echo $date['Documento'];
    //$seccionalChequeo=$date['SeccionalId'];
} 
$resultado = $sentencia4->execute();
$result=$sentencia4->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $date){
    //print_r($date);
    $numProceso=$date['Numero'];
    //echo $date['Documento'];
    //$seccionalChequeo=$date['SeccionalId'];
} 
//echo ($seccionalChequeo);
//echo ($anoFecha);
echo ($numProceso);
$arrayNum=str_split($numProceso);
foreach($arrayNum as $date){
    //echo("valorrr:".$date);
}

for ($i=0;$i<strlen($numProceso);$i++){
    //echo("El valor".$i."es \n".$arrayNum[$i]); 
    if ($i==16){
        $valorNum=$arrayNum[$i];
    }
    if ($i==17){
        $valorNum=$valorNum.$arrayNum[$i];
    }
    if ($i==18){
        $valorNum=$valorNum.$arrayNum[$i];
    }
    if ($i==19){
        $valorNum=$valorNum.$arrayNum[$i];
    }
    if ($i==20){
        $valorNum=$valorNum.$arrayNum[$i];
    }
}
$valorNum=$valorNum+1;
$numberFormat = str_pad($valorNum, 5, "0", STR_PAD_LEFT); //funcion para llenar con 0 a la izquierda si faltan digitos
//echo("el valor a incrementar es: ".$numberFormat);
$numProcesoFinal=$seccionalChequeo.$anoFecha.$numberFormat."00";
echo ("El numero de proceso a insertar es: ".$numProcesoFinal);
