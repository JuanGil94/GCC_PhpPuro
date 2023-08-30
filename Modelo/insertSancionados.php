<?php
try {
    include_once 'configDB.php';
    $objeto=new Conexion();
    $conexion= $objeto->Conectar();
    //variables para insertar lista de chequeo
    $tipoDocumento=$_POST['tipoDocuemnto'];
    $numDocumento=$_POST['numDocumento'];
    $sancionado=$_POST['deudor'];
    $genero=$_POST['genero'];
    $chequeoId=$_POST['chequeoId'];
    $observaciones=$_POST['observaciones'];
    /*
    if (isset($tramite)&&isset($tipoLiquidacion)&&isset($cantidad)&&isset($Naturaleza)&&isset($Concepto)&&isset($abogado)&&isset($despacho)&&isset($radicado)&&isset($providencia)&&isset($ejecutoria)&&isset($copia)&&isset($autentica)&&isset($prestaMerito)&&isset($clara)&&isset($expresa)&&isset($actExigible)&&isset($checkCompetencia)&&isset($faltaRequisitos)&&isset($faltaCompetencia)&&isset($prescripcion)){
        echo ("se ingresaron las variables correctamente: ".$tramite.", ".$Naturaleza.", ".$Concepto.", ".$tipoLiquidacion.", ".$cantidad.", ".$abogado.", ".$despacho.", ".$radicado.", ".$providencia.", ".$ejecutoria.", ".$copia.", ".$autentica.", ".$prestaMerito.", ".$clara.", ".$expresa.", ".$actExigible.", ".$checkCompetencia.", ".$faltaRequisitos.", ".$faltaCompetencia.", ".$prescripcion);
        exit();
    }*/
    $consulta="INSERT INTO [GCC].[dbo].[ChequeosSancionados] values (?,?,?,?,NULL,NULL,NULL,NULL,NULL,?,?)";//consulta de info 
    $resultado=$conexion->prepare($consulta);
    $resultado->execute([$chequeoId,$sancionado,$tipoDocumento,$numDocumento,$genero,$observaciones]);
    $conexion=null; //Se limpia la conexion
    $sentencia=null; // Se limpia la sentencia
    echo json_encode(['success'=>true, 'msj'=> 'En hora buena, datos ingresados correctamente']);
    //echo "<script language='javascript'>alert('En hora buena, datos ingresados correctamente');window.location.href='javascript:history.back()'</script>";
}
catch (Exception $e) {
    echo json_encode(['success'=>false, 'msj'=> 'Problema reflejado:'. $e->getMessage()]);
    //echo "Ocurrió un error" . $e->getMessage();
}