<?php
include_once 'configDB.php';
//phpinfo ();
if (isset($_GET["w1"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["w1"];
    // mostrar $phpVar1 y $phpVar2
    //print "<p>Parameters: " . $phpVar1 ."</p>";
}
//$phpVar1=223194;
$numChequeo=intval($phpVar1);
//var_dump($numChequeo);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT CONVERT (CHAR (20), CO.Fecha,103) AS 'FOficio',CO.Radicado AS Radicado,O.Oficio AS Oficio,CO.Observaciones AS Observaciones
FROM ChequeosOficios CO
INNER JOIN Chequeos C ON C.ChequeoId = CO.ChequeoId
INNER JOIN Oficios O ON O.OficioId = CO.OficioId
WHERE C.ChequeoId =?";//consulta de info 
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numChequeo]);
//$resultado->execute();
$sancionados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($sancionados,JSON_UNESCAPED_UNICODE);