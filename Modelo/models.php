<?php
include_once 'configDB.php';
//echo ("usuario ingresadoooo Id: ".$usuarioId);
class DB {
    public function validarSeccionales(){
        //$user=3574;
        //$respuesta=new DB;
        //$usuarioId=$respuesta->getUser();
        $usuarioId=intval($this->usuarioId);
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT U.UserId ,S.SeccionalId AS SeccionalId , S.Seccional AS Seccional
        FROM [GCC].[dbo].[UsuariosSeccionales] U
        INNER JOIN Seccionales S on U.SeccionalID=S.SeccionalId
        WHERE U.UserId=?
        ORDER BY U.UserId desc");
        $resultado = $sentencia->execute([$usuarioId]);
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['SeccionalId']."'>".$date['Seccional']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    public function seleccionar ($user,$pass){
        //Se realiza una nueva conexion a la DB 
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT *
        FROM UserProfile as up
        inner join webpages_Membership as wm on up.UserId=wm.UserId
        where up.UserName=? and Password=?");
        $resultado = $sentencia->execute([$user,$pass]);
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC); //Obetner resultado de SQL en Array Asociativos
        if (isset($result)&&!empty($result) && sizeof($result)>0){ // se usa el ciclo para validar que no llegue vacai la consulta y demas valdiaciones
            //Funcion donde recorreomos el array e imprimimos segun el key
            foreach($result as $date){
                $usuarioId=$date['UserId'];
                $this->usuarioId=$usuarioId;
                $seccionalId=$date['SeccionalId'];
                $this->seccionalId=$seccionalId;
                //$carteraTipoId=$date['CarteraTipoId'];
                //$this->carteraTipoId=$carteraTipoId;
                //$usuarioId=$date['UserId'];
                //$respuesta->getUser($usuarioId);
                //var_dump($usuarioId);
                //$this->usuario=$date["UserName"];
                // $this->usuario;
                //echo "el nombre del usuario es ".$date["UserName"].", su ID es: ".$date["UserId"]." y su contraseña es: ".$date["Password"];
                //echo ("</br>");
            }
            //echo ("usuario ingresadoooo Id: ".$usuarioId);
            return (true);
        }
        else{
            echo "<script language='javascript'>alert('NO HAY RESULTADOS EN LA DB');window.location.href='http://localhost:8081/GCC/Login_FF/login.html'; </script>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia
    }
    function inicio (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT *
        FROM [GCC].[dbo].[Ayudas]");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['AyudaId']."'>".$date['Ayuda']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarSeccionales (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT *
        FROM [GCC].[dbo].[Seccionales] order by Seccional asc");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['SeccionalId']."'>".$date['Seccional']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarTramites (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT * FROM Tramites ORDER BY Tramite ASC");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['TramiteId']."'>".$date['Tramite']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia
    }
    function seleccionarTipoLiquidacion (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT Tipo as tipo,IIF(Tipo=1, 'PESOS',IIF(Tipo=2,'SALARIOS','UVTs'))
        AS 'Tipo Liquidacion' FROM Chequeos 
		where Tipo<>0 GROUP BY Tipo");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['tipo']."'>".$date['Tipo Liquidacion']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarSeccionalDestino (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT SeccionalId AS SeccionalIDDestino, Seccional AS 'Seccional Destino' FROM Seccionales");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['SeccionalIDDestino']."'>".$date['Seccional Destino']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarAbogado (){
        //echo "<option value'javascript'>JavaScript</option>";
        //$seccionalId=intval($this->seccionalId);
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT AbogadoId,Abogado FROM Abogados WHERE Activo =1 ORDER BY Abogado ASC");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['AbogadoId']."'>".$date['Abogado']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarCompetencia (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT DespachoId,Codigo + ' - ' + Despacho AS Competencia FROM Despachos");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['DespachoId']."'>".$date['Competencia']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarConceptoNaturaleza (){
        //echo "<option value'javascript'>JavaScript</option>";
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT C.ConceptoId AS ConceptoId ,N.NaturalezaId AS NaturalezaId ,C.Concepto + ' - ' + N.Naturaleza AS 'Concepto-Naturaleza' FROM Naturalezas N
        LEFT OUTER JOIN Conceptos C ON C.ConceptoId = N.ConceptoId
        ORDER BY 'Concepto-Naturaleza' ASC");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['NaturalezaId'].",".$date['ConceptoId']."'>".$date['Concepto-Naturaleza']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarTipoCartera (){
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT * FROM [GCC].[dbo].[CarteraTipos]");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['CarteraTipoId']."'>".$date['CarteraTipo']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia           
    }
    function seleccionarUsuarios(){
        $obejeto=new Conexion();
        $conexion= $obejeto->Conectar();
        $consulta="select * from UserProfile";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $usuarios=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($usuarios,JSON_UNESCAPED_UNICODE);
    }
    function seleccionarTipoDocumento(){
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT [TipoDocumentoId]
        ,[Codigo]
        ,[TipoDocumento]
        ,[Juridica]
        FROM [GCC].[dbo].[TiposDocumentos]");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['TipoDocumentoId']."'>".$date['TipoDocumento']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia  
    }
    function auditoria(){
        $usuarioId=intval($this->usuarioId);
        $nombre_archivo = "auditoria.txt";
        $DateAndTime = date('m-d-Y h:i:s a', time());  
        echo "The current date and time are $DateAndTime";
        $contenido = "Hola, mundo. Soy el contenido del archivo $DateAndTime Usuario:$usuarioId )". PHP_EOL; #Escribir con salto de línea
        $resultado = file_put_contents(__DIR__ . "/$nombre_archivo", $contenido, FILE_APPEND);
        if ($resultado === FALSE) {
            echo "Error escribiendo contenido";
        } else {
            echo "Correcto. Se han escrito $resultado bytes :)";
        }
    }
    public function nombre(){
        $usuarioId=intval($this->usuarioId);
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT [Nombre] FROM [GCC].[dbo].[UserProfile]
        WHERE UserId=?");
        $resultado = $sentencia->execute([$usuarioId]);
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo $date['Nombre'];
        }
    }
    function seleccionarOficio(){
        $objeto=new Conexion();
        $conexion= $objeto->Conectar();
        $sentencia = $conexion->prepare("SELECT * from Oficios
        where Activo=1
        order by Oficio asc");
        $resultado = $sentencia->execute();
        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $date){
            echo "<option value='".$date['OficioId']."'>".$date['Oficio']."</option>";
        }
        $conexion=null; //Se limpia la conexion
        $sentencia=null; // Se limpia la sentencia  
    }
}
//$respuesta=new DB;
//$respuesta->prueba1();
//$valor=$respuesta->prueba2();
//echo ("el valor ingresado fuera de la clase: ".$valor."/n");
