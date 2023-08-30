<?php
try {
    include_once 'configDB.php';
    //include '../modal.php';
    $objeto=new Conexion();
    $conexion= $objeto->Conectar();
    //variables para insertar lista de chequeo
    $seccionalId=$_POST['seccionalID'];
    $carteraTipoId=$_POST['carteraTipoId'];
    $tramite=$_POST['tramite'];
    $conceptoNaturaleza=$_POST['conceptoNaturaleza'];
    $conceptoNaturaleza=preg_split("/[,]/",$conceptoNaturaleza); //separar concepto de naturaleza
    $Naturaleza=$conceptoNaturaleza[0];
    $Concepto=intval($conceptoNaturaleza[1]);
    $tipoLiquidacion=$_POST['tipoLiquidacion'];
    $cantidad=$_POST['cantidad'];
    $obligacion=$_POST['obligacion'];
    $abogado=intval($_POST['abogado']);
    $despacho=intval($_POST['competencia']);
    $radicado=$_POST['radicado'];
    $providencia=$_POST['providencia'];
    $ejecutoria=$_POST['ejecutoria'];
    $copia=isset($_POST['copia']);
    if($copia==''){ //Validacion del check no seleccionado y lo pasa a 0
        $copia=0;
    }
    $autentica=isset($_POST['autentica']);
    if($autentica==''){
        $autentica=0;
    }
    $prestaMerito=isset($_POST['prestaMerito']);
    if($prestaMerito==''){
        $prestaMerito=0;
    }
    $clara=isset($_POST['clara']);
    if($clara==''){
        $clara=0;
    }
    $expresa=isset($_POST['expresa']);
    if($expresa==''){
        $expresa=0;
    }
    $actExigible=isset($_POST['actExigible']);
    if($actExigible==''){
        $actExigible=0;
    }
    $checkCompetencia=isset($_POST['checkCompetencia']);
    if($checkCompetencia==''){
        $checkCompetencia=0;
    }
    $faltaRequisitos=isset($_POST['faltaRequisitos']);
    if($faltaRequisitos==''){
        $faltaRequisitos=0;
    }
    $faltaCompetencia=isset($_POST['faltaCompetencia']);
    if($faltaCompetencia==''){
        $faltaCompetencia=0;
    }
    $prescripcion=isset($_POST['prescripcion']);
    if($prescripcion==''){
        $prescripcion=0;
    }
    $folios=$_POST['folios'];
    $seccionalIdDestino=$_POST['seccionalIdDestino'];
    $observaciones=$_POST['observaciones'];
    $fechaLiquidacion=$_POST['fechaLiquidacion'];
    $remisorio=$_POST['remisorio'];
    $minJusticia=isset($_POST['minJusticia']);
    if($minJusticia==''){
        $minJusticia=0;
    }
    $fechaPlazo=$_POST['fechaPlazo'];
    $expFisico=isset($_POST['expFisico']);
    if($expFisico==''){
        $expFisico=0;
    }
    $expDigital=isset($_POST['expDigital']);
    if($expDigital==''){
        $expDigital=0;
    }
    /*
    if (isset($tramite)&&isset($tipoLiquidacion)&&isset($cantidad)&&isset($Naturaleza)&&isset($Concepto)&&isset($abogado)&&isset($despacho)&&isset($radicado)&&isset($providencia)&&isset($ejecutoria)&&isset($copia)&&isset($autentica)&&isset($prestaMerito)&&isset($clara)&&isset($expresa)&&isset($actExigible)&&isset($checkCompetencia)&&isset($faltaRequisitos)&&isset($faltaCompetencia)&&isset($prescripcion)){
        echo ("se ingresaron las variables correctamente: ".$tramite.", ".$Naturaleza.", ".$Concepto.", ".$tipoLiquidacion.", ".$cantidad.", ".$abogado.", ".$despacho.", ".$radicado.", ".$providencia.", ".$ejecutoria.", ".$copia.", ".$autentica.", ".$prestaMerito.", ".$clara.", ".$expresa.", ".$actExigible.", ".$checkCompetencia.", ".$faltaRequisitos.", ".$faltaCompetencia.", ".$prescripcion);
        exit();
    }*/
    $consulta="INSERT INTO [dbo].[Chequeos] values (?,?,GETDATE(),?,?,CONVERT (CHAR (20),?,23),CONVERT (CHAR (20),?,23),?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    0,?,?,?,?,0,?,?,?,0,null,null,?,?,null,0,?,?,?)";//consulta de info 
    $resultado=$conexion->prepare($consulta);
    $resultado->execute([$Concepto,$abogado,$despacho,$radicado,$providencia,
    $ejecutoria,$copia,$autentica,$prestaMerito,$clara,$expresa,$actExigible,
    $checkCompetencia,$faltaRequisitos,$faltaCompetencia,$prescripcion,$seccionalId,$folios,
    $seccionalIdDestino,$observaciones,$tipoLiquidacion,$fechaLiquidacion,$cantidad,
    $obligacion,$remisorio,$carteraTipoId,$minJusticia,$fechaPlazo,$Naturaleza,$tramite,
    $expFisico,$expDigital]);
    $conexion=null; //Se limpia la conexion
    $sentencia=null; // Se limpia la sentencia
    echo json_encode(['success'=>true, 'msj'=> 'En hora buena, datos ingresados correctamente']);
    //echo "<script language='javascript'>alert('En hora buena, datos ingresados correctamente');window.location.href='javascript:history.back()'</script>";
}
catch (Exception $e) {
    echo json_encode(['success'=>false, 'msj'=> 'Problema reflejado:'. $e->getMessage()]);
    //echo "Ocurrió un error" . $e->getMessage();
}