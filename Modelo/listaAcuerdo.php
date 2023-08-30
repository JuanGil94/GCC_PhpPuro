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
$consulta="SELECT A.Cuota AS Cuota, A.Fecha AS Fecha,A.Capital AS Capital,A.Intereses AS Intereses,A.Costas AS Costas,A.InteresesPlazo AS
'Intereses Plazos',('$' + ' ' +CONVERT(VARCHAR, CONVERT(VARCHAR, CAST(A.Total  AS MONEY), 1))) AS Total
FROM Acuerdos A
inner join Procesos P on A.ProcesoId=P.ProcesoId   
where P.Numero=?";//consulta de info
//print_r ($consulta);
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
//$resultado->execute();
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia