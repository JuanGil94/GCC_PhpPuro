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
$consulta="SELECT PR.Propiedad AS Propiedad,
M.EmbargoFecha AS 'FEmbargo',
M.EmbargoResolucion AS 'ResEmbargo',
M.Secuestrado AS Secuestrado,
M.SecuestroFecha AS 'FSecuestro',
M.Secuestre AS Secuestre,
M.SecuestreDocumento AS 'NoDocumento',
M.SecuestreDireccion AS 'DirSecuestre',
M.SecuestreTelefono AS 'TelSecuestre',
M.Comision AS Comision,
M.RemateAviso AS 'Aviso Remanente',
M.RemateFecha AS'FRemate',
M.RemateResolucion AS 'ResolRemate',
M.Aprobacion AS Aprobacion,
M.Valor AS 'Valor Rematado',
M.Entrega AS 'DiligEntrega',
M.Observaciones AS Observaciones
from Medidas M
INNER JOIN Procesos P ON P.ProcesoId =M.ProcesoId
INNER JOIN Propiedades PR ON PR.PropiedadId=M.PropiedadId
where P.Numero=?";//consulta de info
//print_r ($consulta);
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numProceso]);
//$resultado->execute();
$correspondencia=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($correspondencia,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia