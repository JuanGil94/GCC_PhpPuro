<?php
include_once 'configDB.php';
//phpinfo ();
if (isset($_GET["w1"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["w1"];
    // mostrar $phpVar1 y $phpVar2
    //print "<p>Parameters: " . $phpVar1 ."</p>";
}
$numProceso=$phpVar1; // no se cambia a int ya que e sun varchar
//var_dump($numChequeo);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT CU.Cuenta AS 'NoCuenta',CONVERT (CHAR (20), PA.Fecha,103) AS Fecha,PA.Numero AS Numero,
('$' + ' ' +CONVERT(VARCHAR, CONVERT(VARCHAR, CAST(PA.Pago  AS MONEY), 1))) AS Recaudo,
CONVERT (CHAR (20),PA.Registro,103) AS 'FRegistro', 
PA.Observaciones AS Observaciones
FROM Pagos1 PA 
INNER JOIN Procesos PR ON PR.ProcesoId = PA.ProcesoId
INNER JOIN Cuentas CU ON CU.CuentaId = PA.CuentaId
WHERE PR.Numero=?";//consulta de info
//print_r ($consulta);
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
//$resultado->execute();
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia