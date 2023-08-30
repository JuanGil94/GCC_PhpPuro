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
$consulta="SELECT   AC.Actuacion AS Actuacion,C.Fecha AS Fecha,C.Resolucion AS Resolucion,C.Observaciones AS Observaciones 
FROM        Correspondencias C 
INNER JOIN Procesos P ON P.ProcesoId = C.ProcesoId
INNER JOIN Oficios O ON C.OficioId = O.OficioId 
INNER JOIN Actuaciones AC ON O.ActuacionId = AC.ActuacionId
where P.Numero=?";//consulta de info
//print_r ($consulta);
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
//$resultado->execute();
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia
