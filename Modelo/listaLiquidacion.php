<?php
include_once 'configDB.php';
//phpinfo ();
if (isset($_GET["w1"])) {
    // asignar w1 a la variable php
    $phpVar1 = $_GET["w1"];
}
$numProceso=$phpVar1; // no se cambia a int ya que e sun varchar
//var_dump($numChequeo);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT l.Cuota AS NoCuota,
l.Fecha AS Fecha,
l.Capital AS Capital,
l.Intereses AS Interes,
l.Costas AS Costas,
l.InteresesPlazo AS 'Intereses de Plazo',
('$' + ' ' +CONVERT(VARCHAR, CONVERT(VARCHAR, CAST(L.Total  AS MONEY), 1))) AS 'Valor Cuota'
FROM Liquidaciones L
INNER JOIN Procesos P ON P.ProcesoId=L.ProcesoId
WHERE P.Numero=?";//consulta de info
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia