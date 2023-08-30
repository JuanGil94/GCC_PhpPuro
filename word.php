<?php 
include_once 'configDB.php';
require_once dirname(__FILE__).'../libs/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();// se debe dejar por fuera de cualquier bloque al uasr la palabra clave use
use PhpOffice\PhpWord\TemplateProcessor;// se debe dejar por fuera de cualquier bloque al uasr la palabra clave use
class Plantillas{
	//use PhpOffice\PhpWord\TemplateProcessor;
	public function persuasivo($numProceso){
		//require_once dirname(__FILE__).'/libs/PHPWord-master/src/PhpWord/Autoloader.php';
		echo $numProceso;
		$obejeto=new Conexion();
		$conexion= $obejeto->Conectar();
		$array=array();
		$consulta="SELECT TOP 1 Sa.Masculino as masculino,P.ChequeoId,'SIGOBIUS' as sigobius,C.Ciudad as CiudadP,CONVERT(varchar, P.Fecha, 106) AS FechaEnLetras,
		Sa.Sancionado,CS.Direccion,CS.Email as emailSancionado,Ce.Ciudad,De.Departamento,P.Numero,Ds.Despacho,CONVERT(varchar, P.Ejecutoria, 106) Ejecutoria,
		TD.TipoDocumento,Sa.Documento,P.Obligacion,S.Email,S.Direccion,S.Telefonos
		FROM [GCC].[dbo].[Procesos] P
		INNER JOIN Seccionales S ON S.SeccionalId=P.SeccionalId
		INNER JOIN Ciudades C ON S.CiudadId=C.CiudadId
		INNER JOIN Sancionados Sa ON P.SancionadoId=Sa.SancionadoId
		INNER JOIN ChequeosSancionados CS ON CS.Sancionado=Sa.Sancionado 
		INNER JOIN Ciudades Ce ON CS.CiudadId=Ce.CiudadId
		INNER JOIN Departamentos De ON Ce.DepartamentoId=De.DepartamentoId
		INNER JOIN Despachos Ds ON Ds.DespachoId=P.DespachoId
		INNER JOIN TiposDocumentos TD ON TD.TipoDocumentoId=Sa.TipoDocumentoId
		where Numero='11001079000020230017100' AND CS.Direccion is not null AND CS.Email is not null
		--where Numero=? AND CS.Direccion is not null AND CS.Email is not null
		order by CS.ChequeoSancionadoId desc";
		$sentencia=$conexion->prepare($consulta);
		$resultado = $sentencia->execute();
		//$resultado->execute();
		$result=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $date){
			$ciudadProceso=$date['CiudadP'];
			$fechaLetras=$date['FechaEnLetras'];
			$sancionado=$date['Sancionado'];
			$masculino=$date['masculino'];
			if ($masculino=0){
				$masculinoF='Señora';
			}
			else{
				$masculinoF='Señor';
			}
			$sancionadoEmail=$date['emailSancionado'];
			$sancionadoCiudad=$date['Ciudad'].' - '.$date['Departamento'];
			$direccion=$date['Direccion'];
		}
		//print json_encode($result,JSON_UNESCAPED_UNICODE);
		$conexion=null; //Se limpia la conexion
		$sentencia=null; // Se limpia la sentencia

		//proceso donde se toma la plantilla y se modifica - inicio
		//\PhpOffice\PhpWord\Autoloader::register();

		//use PhpOffice\PhpWord\TemplateProcessor;

		$templateWord = new TemplateProcessor('../Plantilla_1097.docx');
		$sancionadoCiudadF=ucwords(strtolower($sancionadoCiudad));
		// --- Asignamos valores a la plantilla
		//$ciudadProceso='hola';
		$templateWord->setValue('ciudad',$ciudadProceso);
		$templateWord->setValue('fecha',$fechaLetras);
		$templateWord->setValue('sancionado',$sancionado);
		$templateWord->setValue('direccion',$direccion);
		$templateWord->setValue('senor',$masculinoF);
		$templateWord->setValue('sancionadoCiudad',$sancionadoCiudadF);
		$templateWord->setValue('sancionadoEmail',$sancionadoEmail);
		$templateWord->setValue('direccion',$direccion);
		// --- Guardamos el documento
		$templateWord->saveAs('c:\Users\Usuario\Downloads\Documento.docx');
		header("Content-Disposition: attachment; filename=Documento.docx; charset=iso-8859-1");
		//echo 
		file_get_contents('Documento.docx');
		//echo json_encode(['success'=>true, 'msj'=> 'En hora buena, datos ingresados correctamente']);
	}
}
//c:\Users\Usuario\Downloads\Documento.docx
//$plantilla=new Plantillas();
//$plantilla->persuasivo();

?>