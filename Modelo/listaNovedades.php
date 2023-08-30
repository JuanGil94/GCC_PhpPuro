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
$consulta="SELECT
case N.Tipo
when 1 
then 'CAMBIO DE SANCIONADO'
when 2
then 'CAMBIO DE VALOR OBLIGACION INICIAL'
when 3
then 'CAMBIO DE VALOR DE COSTAS'
when 4
then 'CAMBIO DE VALOR DE INTERESES'
when 5
then 'CAMBIO DE FECHA DE EJECUTORIA'
when 6
then 'CAMBIO DE CONCEPTO'
when 7
then 'CAMBIO DE FECHA DE PROVIDENCIA'
when 9
then 'CAMBIO DE FECHA DE NOTIFICACIÓN'
when 10
then 'CAMBIO DE FECHA INCUMPLIMIENTO DE ACUERDO DE PAGO'
when 11
then 'CAMBIO DE VALOR DEL SALDO DE LA OBLIGACION'
when 12
then 'CAMBIO DE FECHA DE PLAZO'
when 13
then 'CAMBIO DE DESPACHO DE ORIGEN'
when 14
then 'CAMBIO DE FECHA DE SUSPENSIÓN'
when 20
then 'CAMBIO DE NATURALEZA'
when 30
then 'CAMBIO DEL VALOR DEL RECAUDO'
when 40
then 'CAMBIO DEL RADICADO DE ORIGEN'
END AS TipoNovedad,
CONVERT(CHAR (20),N.Fecha,103) AS Fecha,N.Anterior AS 'Valor Anterior',
N.Nuevo AS 'Valor Nuevo',UP.UserName AS 'Modificado Por',N.Observaciones AS Observaciones
from Novedades N
INNER JOIN Procesos P ON P.ProcesoId = N.ProcesoId 
INNER JOIN UserProfile UP ON UP.UserId=N.UserId 
where P.Numero=?";//consulta de info
//print_r ($consulta);
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
//$resultado->execute();
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia