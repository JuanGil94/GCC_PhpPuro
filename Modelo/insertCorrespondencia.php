<?php
include_once 'configDB.php';
include_once '../word.php';
try {
    $objeto=new Conexion();
    $objeto2=new Conexion();
    $conexion= $objeto->Conectar();
    //variables para insertar lista de chequeo
    $oficio=$_POST['oficios'];
    $fecha=$_POST['fechaCorrespondencia'];
    $resolucion=$_POST['resolucion'];
    $radicado=$_POST['radicado'];
    $observaciones=$_POST['observaciones'];
    $numProceso=$_POST['numeroProceso'];
    //echo $numProceso;
    session_start();
    $usuario=$_SESSION['usuario'];
    $consulta="SELECT * FROM UserProfile where UserName=?";//consulta de info 
    $resultado=$conexion->prepare($consulta);
    $resultado->execute([$usuario]);
    $result=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $date){
        //print_r($date);
        //echo $date['Documento'];
        $userId=$date['UserId'];
    }
    $conexion2= $objeto->Conectar();
    $sentencia2 = $conexion2->prepare("SELECT * FROM Procesos where Numero=?");
    $sentencia2->execute([$numProceso]);
    $result=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $date){
        //print_r($date);
        //echo $date['Documento'];
        $procesoId=$date['ProcesoId'];
        $abogadoId=$date['AbogadoId'];
    }
    $conexion= $objeto->Conectar();
    $sentencia3 = $conexion->prepare("INSERT INTO Correspondencias values (?,?,?,0,?,?,'',?,?,?)");
    $resultado = $sentencia3->execute([$procesoId,$oficio,$fecha,$observaciones,$resolucion,$radicado,$userId,$abogadoId]);
    //echo $userId;
    $conexion=null; //Se limpia la conexion
    $sentencia=null; // Se limpia la sentencia
    //echo "<script language='javascript'>alert('En hora buena, datos ingresados correctamente');window.location.href='javascript:history.back()'</script>";
    $plantilla=new Plantillas();
    $plantilla->persuasivo($numProceso);
    echo json_encode(['success'=>true, 'msj'=> 'En hora buena, datos ingresados correctamente']);
}
catch (Exception $e) {
    echo json_encode(['success'=>false, 'msj'=> 'Problema reflejado:'. $e->getMessage()]);
    //echo "Ocurrió un error" . $e->getMessage();
}