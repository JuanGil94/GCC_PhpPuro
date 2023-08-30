<?php
try {
    include_once 'configDB.php';
    $sancionadoId='';
    if (isset($_GET["w1"])) {
        $phpVar1 = $_GET["w1"];
    }
    $noChequeo=intval($phpVar1);
    
    //print ("Hola, el numero de Chequeo es".$noChequeo);
    $objeto=new Conexion();
    $conexion= $objeto->Conectar();
    $obtSeccional = $conexion->prepare("SELECT SeccionalId from Chequeos where ChequeoId=?");
    $seccional = $obtSeccional->execute([$noChequeo]);
    $result=$obtSeccional->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            $seccionalF=$date['SeccionalId'];
        }
    $conexion= $objeto->Conectar();
    $sentencia = $conexion->prepare("SELECT *
    FROM [GCC].[dbo].[ChequeosSancionados]
    WHERE ChequeoId=?");
    $resultado = $sentencia->execute([$noChequeo]);
    $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    if ($result){
        //echo("El Chequeo contiene Sancionado");
        $conexion= $objeto->Conectar();
        $sentencia2 = $conexion->prepare("SELECT *
        FROM [GCC].[dbo].[ChequeosSancionados]
        WHERE ChequeoId=?");
        $resultado = $sentencia2->execute([$noChequeo]);
        $result=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            //print_r($date);
            //echo $date['Documento'];
            $documentoSancionadoC=$date['Documento'];
        }
        $conexion= $objeto->Conectar();
        $sentencia2 = $conexion->prepare("SELECT *
        FROM Sancionados    
        WHERE Documento=?");
        $resultado = $sentencia2->execute([$documentoSancionadoC]);
        $result=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            //print_r($date);
            //echo $date['Documento'];
            $sancionadoId=$date['SancionadoId'];
        }
        //
        if ($sancionadoId){
            echo ("El sancionado ya se encuentra registrado");
        }
        else {
            echo ("El sancionado no se encuentra registrado");
            $conexion= $objeto->Conectar();
            $sentencia2 = $conexion->prepare("INSERT INTO Sancionados (Sancionado,TipoDocumentoId,Documento,Email,Celular,Masculino,Observaciones,Fallecimiento,PrivadoLibertad) SELECT Sancionado,TipoDocumentoId,Documento,Email,NULL,Masculino,Observaciones,NULL,0 FROM ChequeosSancionados WHERE ChequeoId=?");
            $resultado = $sentencia2->execute([$noChequeo]);
            $conexion= $objeto->Conectar();
            $sentencia2 = $conexion->prepare("SELECT *
            FROM Sancionados    
            WHERE Documento=?");
            $resultado = $sentencia2->execute([$documentoSancionadoC]);
            $result=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $date){
                //print_r($date);
                //echo $date['Documento'];
                $sancionadoId=$date['SancionadoId'];
            }
        }
        $conexion= $objeto->Conectar();
        $sentencia4 = $conexion->prepare("SELECT MAX(Numero) AS Numero FROM Procesos WHERE SeccionalId=? AND Fecha>'2023-01-01'"); //Se pone la Fecha ya que se observa que anteriormente tenian otro codigo (Cartagena)
        $sentencia5 = $conexion->prepare("SELECT year(getdate())AS Fecha");
        $sentencia6 = $conexion->prepare("SELECT S.Codigo AS Codigo FROM Seccionales S
        INNER JOIN Chequeos C ON C.SeccionalId=S.SeccionalId
        WHERE C.ChequeoId=?");
        $resultado = $sentencia6->execute([$noChequeo]);
        $result=$sentencia6->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            //print_r($date);
            //echo $date['Documento'];
            $seccionalChequeo=$date['Codigo'];
        }
        $resultado = $sentencia5->execute();
        $result=$sentencia5->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            //print_r($date);
            $anoFecha=$date['Fecha'];
            //echo $date['Documento'];
            //$seccionalChequeo=$date['SeccionalId'];
        } 
        $resultado = $sentencia4->execute([$seccionalF]);
        $result=$sentencia4->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            //print_r($date);
            $numProceso=$date['Numero'];
            //echo $date['Documento'];
            //$seccionalChequeo=$date['SeccionalId'];
        } 
        //echo ($seccionalChequeo);
        //echo ($anoFecha);
        //echo ($numProceso);
        $arrayNum=str_split($numProceso);
        foreach($arrayNum as $date){
            //echo("valorrr:".$date);
        }

        for ($i=0;$i<strlen($numProceso);$i++){
            //echo("El valor".$i."es \n".$arrayNum[$i]); 
            if ($i==16){
                $valorNum=$arrayNum[$i];
            }
            if ($i==17){
                $valorNum=$valorNum.$arrayNum[$i];
            }
            if ($i==18){
                $valorNum=$valorNum.$arrayNum[$i];
            }
            if ($i==19){
                $valorNum=$valorNum.$arrayNum[$i];
            }
            if ($i==20){
                $valorNum=$valorNum.$arrayNum[$i];
            }
        }
        $valorNum=$valorNum+1;
        $numberFormat = str_pad($valorNum, 5, "0", STR_PAD_LEFT); //funcion para llenar con 0 a la izquierda si faltan digitos
        $numProcesoFinal=$seccionalChequeo.$anoFecha.$numberFormat."00"; // se concatena para obtener el numero de proceso
        //echo ("El numero de proceso a insertar es: ".$numProcesoFinal);
        $conexion= $objeto->Conectar();
        $sentencia3 = $conexion->prepare("INSERT INTO Procesos (SeccionalId,AbogadoId,Fecha,Numero,DespachoId,SancionadoId,Providencia,Ejecutoria,ConceptoId,EstadoId,EtapaId,Folios,Tipo,Cantidad,Obligacion,Costas,Liquidacion,Dias,Intereses,Recaudo,CalificacionId,Terminacion,MotivoId,Observaciones,Cuotas,Abono,Inicio,VlrCuota,VlrIntereses,Garantia,Radicado,Remisorio,Acuerdo,Incumplimiento,Notificacion,Suspension,Traslado,Error,CarteraTipoId,ConceptoAbogado,Origen,Carpeta,ImportacionId,ActuacionId,ObligacionInicial,CostasInicial,InteresesInicial,MinJusticia,Revocatoria,Mayor,NotificacionValidada,Validado,Seleccionado,CompetenciaId,MinjusticiaId,SeleccionadoPor,Subsanar,NumeroMinjusticia,ProcesoIdOrigen,SeleccionadoFecha,InteresesIniciales,InteresesCalculados,ProcesoIdDestino,RecaudoMinjusticia,RecaudoTerminado,Persuasivo,ObligacionCreacion,InteresesCreacion,CostasCreacion,Plazo,NaturalezaId,TrasladoCartera,CarteraTipoIdOrigen,TrasladoConcepto,ConceptoIdOrigen,AutorizadoPlazo,AutorizadoFecha,AutorizadoPor,Reliquidacion,ChequeoId,VlrCostas,VlrInteresesPlazo) SELECT SeccionalId,AbogadoId,Fecha,?,DespachoId,?,Providencia,Ejecutoria,ConceptoId,2,1,Folios,Tipo,Cantidad,Obligacion,Costas,NULL,0,0,0,1,NULL,NULL,Observaciones,0,0,NULL,0,0,NULL,Origen,Remisorio,NULL,NULL,NULL,NULL,NULL,NULL,CarteraTipoId,NULL,NULL,NULL,NULL,NULL,Obligacion,Costas,0,MinJusticia,NULL,0,0,0,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0,0,NULL,NULL,0,NULL,Obligacion,0,Costas,Plazo,NaturalezaId,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,ChequeoId,0,0 FROM Chequeos WHERE ChequeoId=?");
        $resultado = $sentencia3->execute([$numProcesoFinal,$sancionadoId,$noChequeo]);
        //echo "<script language='javascript'>alert('En hora buena, datos ingresados correctamente');window.location.href='javascript:history.back()'</script>";
        //echo ("el resultado es: ".$resultado);
        //$result=$sentencia3->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado){
            echo("La insercion del proceso es correcta");
            $conexion= $objeto->Conectar();
            $sentencia5 = $conexion->prepare("UPDATE Chequeos SET Procesado=1 WHERE ChequeoId=?");// se realiza update en procesado para que se deshabilite el botton de crear :)
            $resultado = $sentencia5->execute([$noChequeo]);
        }
        else {
            echo("La insercion no se realizo");
        }
        
    }
    else{   
        //echo "<script language='javascript'>alert('Error: Debe ingresar usuario');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
        //echo("El Chequeo Noooooo contiene Sancionado");
        echo("Debe Contener Sancionado el Chequeo");
        //echo ("<script language='javascript'>alert('Error: EL CHEQUEO DEBE TENER SANCIONADO');window.location.href='javascript:history.back()'; </script>");
    }
    //$respuesta->auditoria();
    $conexion=null; //Se limpia la conexion
    $sentencia=null; // Se limpia la sentencia
}
catch (Exception $e) {
    echo "Ocurrió un error" . $e->getMessage();
}