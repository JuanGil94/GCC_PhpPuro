<?php
include_once 'configDB.php';
if (isset($_GET["w1"])&&isset($_GET["w2"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["w1"];
    $phpVar2 = $_GET["w2"];
    // mostrar $phpVar1 y $phpVar2
    //print "<p>Parameters: " . $phpVar1 ."</p>";
}
//$phpVar1=223194;
$seccional=intval($phpVar1);
$tipoCartera=intval($phpVar2);
//$objeto10 = new dataFront;
//$objeto10->obtenerInfo($seccional,$tipoCartera);
//phpinfo ();
$objeto=new Conexion;
$conexion= $objeto->Conectar();
$array=array();
$consulta="SELECT C.ChequeoId as Chequeo,CONVERT(CHAR (20),C.Fecha,105) as 'CreationDate',D.Codigo + ' - ' + D.Despacho AS Despacho,CO.Concepto+'-'+N.Naturaleza AS
'ConceptoNaturaleza',C.Origen AS
'No Radicado de Origen',C.Providencia AS Providencia,C.Ejecutoria AS Ejecutoía, IIF(C.Tipo=1, 'PESOS',IIF(C.Tipo=2,'SALARIOS','UVTs'))
AS Tipo,C.Cantidad AS Cantidad,
C.Obligacion AS Obligación, C.Costas AS Costas,C.PrimeraCopia AS '1aCopia',C.Autentica AS Auténtica,C.PrestaMeritoEjecutivo AS
'Presta Mérito Ejecutivo',C.Clara AS Clara,C.Expresa AS Expresa,C.ActualmenteExigible AS 'Actualmente Exigible',C.CompetenciaDEAJ AS
Competencia,C.FaltaRequisitos AS 'Falta de Requisitos', C.FaltaCompetencia AS 'Falta de Competencia',C.PorPrescripcion AS
'Por Prescripción',C.SeccionalIdDestino AS 'Seccional Destino',C.AprobadoPor AS 'Autorizado por',C.FechaAprobacion AS 'FAutorización',
T.Tramite AS Tramite, A.Abogado AS Abogado, C.Fisico AS 'ExpFísico',C.Digital AS 'ExpDigital',C.Procesado AS Procesado
FROM Chequeos C
LEFT OUTER JOIN Conceptos CO ON C.ConceptoId=CO.ConceptoId
LEFT OUTER JOIN Abogados A ON C.AbogadoId=A.AbogadoId
LEFT OUTER JOIN Despachos D ON D.DespachoId=C.DespachoId
LEFT OUTER JOIN Seccionales S ON S.SeccionalId=C.SeccionalId
LEFT OUTER JOIN CarteraTipos CA ON CA.CarteraTipoId=C.CarteraTipoId
LEFT OUTER JOIN Naturalezas N ON N.NaturalezaId=C.NaturalezaId
LEFT OUTER JOIN Tramites T ON T.TramiteId = C.TramiteId
WHERE CA.CarteraTipoId = ? AND S.SeccionalId =? ORDER BY C.ChequeoId DESC";//consulta de info 
$resultado=$conexion->prepare($consulta);
$resultado->execute([$tipoCartera,$seccional]);
$listaChequeo=$resultado->fetchAll(PDO::FETCH_ASSOC);
$result=json_encode($listaChequeo,JSON_UNESCAPED_UNICODE);
//print json_encode($listaChequeo,JSON_UNESCAPED_UNICODE);
//$array = json_decode($listaChequeo, true);
//print_r($listaChequeo);
foreach ($listaChequeo as $value) {
    if ($value['Procesado']==0){
        $value['button']='<button type="button" id="btn-create" class="btn btn-info" title="Crear Proceso">Crear</button>';
    }
    else{
        $value['button']="";
    }
    if ($value['1aCopia']==1){
        $value['1aCopia']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['1aCopia']="<input type='checkbox'>";
    }
        if ($value['Falta de Requisitos']==1){
        $value['Falta de Requisitos']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Falta de Requisitos']="<input type='checkbox'>";
    }
    if ($value['Por Prescripción']==1){
        $value['Por Prescripción']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Por Prescripción']="<input type='checkbox'>";
    }
    if ($value['Falta de Competencia']==1){
        $value['Falta de Competencia']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Falta de Competencia']="<input type='checkbox'>";
    }
    if ($value['Competencia']==1){
        $value['Competencia']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Competencia']="<input type='checkbox'>";
    } 
    if ($value['Actualmente Exigible']==1){
        $value['Actualmente Exigible']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Actualmente Exigible']="<input type='checkbox'>";
    }
    if ($value['Expresa']==1){
        $value['Expresa']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Expresa']="<input type='checkbox'>";
    }
    if ($value['Clara']==1){
        $value['Clara']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Clara']="<input type='checkbox'>";
    }
    if ($value['Presta Mérito Ejecutivo']==1){
        $value['Presta Mérito Ejecutivo']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Presta Mérito Ejecutivo']="<input type='checkbox'>";
    }
    if ($value['Auténtica']==1){
        $value['Auténtica']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['Auténtica']="<input type='checkbox'>";
    }
    if ($value['ExpFísico']==1){
        $value['ExpFísico']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['ExpFísico']="<input type='checkbox'>";
    }
    if ($value['ExpDigital']==1){
        $value['ExpDigital']="<input type='checkbox' checked='checked'>";
    }
    else{
        $value['ExpDigital']="<input type='checkbox'>";
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
//clase de pruebas
class dataFront{
    public function obtenerInfo ($seccional,$tipoCartera){
        $this->SeccioanlIdFront=$seccional;
        $this->tipoCarteraFront=$tipoCartera;
        //echo ("valores en dataFront".$seccional." ".$tipoCartera);
    }
    public function seleccionarAbogado (){
        //echo "<option value'javascript'>JavaScript</option>";
        $seccionalId=intval($this->SeccioanlIdFront);
        echo ("valoresssss".$seccionalId."triguerrsss".$this->SeccioanlIdFront);
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT AbogadoId,Abogado FROM Abogados WHERE Activo =1 AND SeccionalId=?");
        $resultado = $sentencia->execute([$seccionalId]);
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['AbogadoId']."'>".$date['Abogado']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
}