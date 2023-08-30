<?php
include_once 'configDB.php';
if (isset($_GET["w1"])) {
    $phpVar1 = $_GET["w1"];
}
//$phpVar1 =1;
$ayudaID=intval($phpVar1);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT Respuesta
FROM [GCC].[dbo].[Ayudas]
WHERE AyudaId=?";
$resultado=$conexion->prepare($consulta);
$resultado->execute([$ayudaID]);
$ayuda=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($ayuda as $date){
    //echo $date['Respuesta'];
}
echo $date['Respuesta'];
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia
//$result=json_encode($listaChequeo,JSON_UNESCAPED_UNICODE);
//print json_encode($result,JSON_UNESCAPED_UNICODE);
