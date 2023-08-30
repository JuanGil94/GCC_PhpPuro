<?php
include_once 'configDB.php';
//phpinfo ();
if (isset($_GET["w1"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["w1"];
    // mostrar $phpVar1 y $phpVar2
    //print "<p>Parameters: " . $phpVar1 ."</p>";
}
$numChequeo=intval($phpVar1); // se convierte en int ya que en la tabla la variable es un INT
//var_dump($numChequeo);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT TOP 10 TD.TipoDocumento AS 'TipodeDocumento',CS.Documento AS 'NoDocumento', CS.Sancionado AS Sancionado,IIF( Masculino = 1, 'Masculino', 'Femenino' ) as Genero, CS.Observaciones AS Observaciones
FROM ChequeosSancionados CS
INNER JOIN TiposDocumentos TD ON TD.TipoDocumentoId = CS.TipoDocumentoId
WHERE CS.ChequeoId=?";//consulta de info 
$sentencia=$conexion->prepare($consulta);
$resultado = $sentencia->execute([$numChequeo]);
//print_r ($resultado);
//$resultado->execute();
$sancionados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
print json_encode($sancionados,JSON_UNESCAPED_UNICODE);
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia
