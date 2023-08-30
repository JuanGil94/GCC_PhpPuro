<?php
include_once 'configDB.php';
if (isset($_GET["w1"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["w1"];
    $phpVar2 = $_GET["w2"];
    // mostrar $phpVar1 y $phpVar2
    //print "<p>Parameters: " . $phpVar1 ."</p>";
}
//$phpVar1=223194;
$seccional=intval($phpVar1);
$tipoCartera=intval($phpVar2);
//phpinfo ();
//$seccional=1037;
//$seccional=intval($_POST['seccional']);
//echo ("seccional ingresada".$seccional);
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();
$array=array();
$consulta="SELECT C.Concepto as Concepto,P.Numero as NoProceso,SA.Sancionado as Deudor,P.ObligacionInicial as
'ObliInicial',P.CostasInicial as 'CostInicial',P.InteresesInicial as 'inteinicial',P.Recaudo as Recaudo,
P.ObligacionCreacion as ObliSaldo,p.CostasCreacion
as 'CostSaldo',P.InteresesCreacion as 'InteSaldo',p.ObligacionInicial+p.Intereses as
'SaldoTotal',P.MinJusticia AS Minjusticia,P.Fecha as 'FCreación',P.Providencia as 'FProvidencia',P.Ejecutoria as 'FEjecutoria',P.Plazo as 'FPlazo',
P.Notificacion as 'FNotificacion',P.Acuerdo as 'FAcuerdo',P.Incumplimiento as 'FIncumplimiento',
P.Fecha as 'calculaPrescripcion',E.Estado as Estado,ET.Etapa as Etapa,
P.Terminacion as 'FTerminación',MO.Motivo as 'MotivoTerminación',AC.Actuacion as 'UltActuación',P.Radicado as 'No Radicado Origen',
D.Despacho as 'DespachoJuzgado',P.Folios as Folios,MI.MinJusticia as 'MinJusticia1', N.Naturaleza as Naturaleza, A.Abogado as Abogado
from Procesos P
inner join Conceptos C on C.ConceptoId = P.ConceptoId
inner join Sancionados SA on  SA.SancionadoId = P.SancionadoId
left outer join Minjusticia MI on   MI.MinjusticiaId = P.MinjusticiaId
left outer join Naturalezas N on  N.NaturalezaId = P.NaturalezaId
inner join Abogados A on  A.AbogadoId = P.AbogadoId
left outer join Despachos D on  D.DespachoId = P.DespachoId
left outer join Actuaciones AC on  AC.ActuacionId = P.ActuacionId
left outer join Motivos MO on   MO.MotivoId = P.MotivoId
INNER JOIN Etapas ET on   ET.EtapaId = P.EtapaId
INNER JOIN Estados E on   E.EstadoId = P.EstadoId
INNER JOIN CarteraTipos CP ON CP.CarteraTipoId = P.CarteraTipoId
left outer join Seccionales SE ON SE.CiudadId = P.SeccionalId
WHERE P.SeccionalId = ? AND P.CarteraTipoId = ? ORDER BY P.ProcesoId DESC";//consulta de info 
$resultado=$conexion->prepare($consulta);
$resultado->execute([$seccional,$tipoCartera]);
$listaChequeo=$resultado->fetchAll(PDO::FETCH_ASSOC);
$result=json_encode($listaChequeo,JSON_UNESCAPED_UNICODE);
//print json_encode($listaChequeo,JSON_UNESCAPED_UNICODE);
//$array = json_decode($listaChequeo, true);
//print_r($listaChequeo);

foreach ($listaChequeo as $value) {
    if ($value['MinJusticia1']==1){
        $value['MinJusticia1']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['MinJusticia1']="<input type='checkbox'>";
    }
    array_push($array,$value);
    //print_r ($value);
    //print json_encode($value,JSON_UNESCAPED_UNICODE);
 }
$conexion=null; //Se limpia la conexion
$sentencia=null; // Se limpia la sentencia
//print_r($array);
print json_encode($array,JSON_UNESCAPED_UNICODE);
 //print json_encode($value,JSON_UNESCAPED_UNICODE);
//print_r(json_decode($listaChequeo));