$(document).ready(function(){
	$('#bienvenida').modal('toggle');
	//$('#insertCorrespondencia').modal('toggle');
});
var count = 0; //variable para contador para obtener el numChequeo
var count2 = 0; //variable para contador para obtener el numProceso
//funcion para detectar el cambio de tipoLiquidacion - inicio
$("#tipoLiquidacion").change(function() {
	document.getElementById("cantidad").value = "";
	document.getElementById("texto").value = "";
	document.getElementById("obligacionLetras").value = "";
	document.getElementById("obligacion").value = "";
	var tipoliquidacion=$(this).val();
	if (tipoliquidacion==1){
		$("#fechaLiquidacion").hide();
	}
	else {
		$("#fechaLiquidacion").show();
	}
});
//funcion para detectar el cambio de tipoLiquidacion - fin
//funcion para detectar el cambio de fechaLiquidacion - inicio
$("#fechaLiquidacion").change(function() {
	document.getElementById("cantidad").value = "";
	document.getElementById("texto").value = "";
	document.getElementById("obligacionLetras").value = "";
	document.getElementById("obligacion").value = "";
});
//funcion para detectar el cambio de fechaLiquidacion - fin
//funcion para traducir cantidad (Pesos, salarios y Uvts)- inicio
document.getElementById("cantidad").addEventListener("keyup",function(e){ 
	//validacion para mostrar cantidad segun tipoLiquidacion ingresa - inicio
	var cantidad=this.value;
	var tipoliquidacion=document.getElementById("tipoLiquidacion").value;
	var fechaLiquidacion=(document.getElementById("fechaLiquidacion").value).split('-');
	if (tipoliquidacion==2){
		var numSalarios=this.value;
		console.log("Numero Salarios: "+numSalarios);
		console.log("Fecha Liquidacion: "+fechaLiquidacion[0]);
		salario=$.ajax({
			type: "method",
			url: "../Modelo/selectSalarios.php?w1="+fechaLiquidacion[0],
			dataType:'text',
			async:false,
			success: function (response) {
				console.log("enviado valor de select por GET");
			}
		}).responseText;
		console.log("Salario en javascript: "+salario);
		cantidad=salario*numSalarios;
		$("#texto").val(NumeroALetrasSalarios(numSalarios));
		$("#obligacionLetras").val(NumeroALetras(cantidad));
		$("#obligacion").val(cantidad);
		document.getElementById("obligacion").value;
		//$("#obligacionLetras").val(NumeroALetras(obligacion));
	}
	else if (tipoliquidacion==3){
		var numUvts=this.value;
		uvt=$.ajax({
			type: "method",
			url: "../Modelo/selectUvts.php?w1="+fechaLiquidacion[0],
			dataType:'text',
			async:false,
			success: function (response) {
				console.log("enviado valor de select por GET");
			}
		}).responseText;
		cantidad=uvt*numUvts;
		$("#texto").val(NumeroALetrasUvts(numUvts));
		$("#obligacionLetras").val(NumeroALetras(cantidad));
		$("#obligacion").val(cantidad);
		document.getElementById("obligacion").value;
	}
	else{
		$("#texto").val(NumeroALetras(cantidad));
		$("#obligacionLetras").val(NumeroALetras(cantidad));
		$("#obligacion").val(cantidad);
		document.getElementById("obligacion").value;
	}
//validacion para mostrar cantidad segun tipoLiquidacion ingresa - Fin
});
//funcion para traducir cantidad (Pesos, salarios y Uvts)- fin
//funcion para traducir el campo obligacion en en Letras - inicio
document.getElementById("obligacion").addEventListener("keyup",function(e){
	$("#obligacionLetras").val(NumeroALetras(this.value));
});
//funcion para traducir el campo obligacion en en Letras - fin
//funcion patra detectar el cambio del select de ayuda y pintar su descripcion segun seleccion - inicio
$("#ayuda").change(function() {
	$("#cuadroAyuda").show(); //mostrar el cuadro de descripcion ayuda ya que se desactiva cuando se generan las vistas de las tablas
	var valor=$(this).val();
	ayuda=$.ajax({
		type: "method",
		url: "../Modelo/inicio.php?w1="+valor,
		dataType:'text',
		async:false,
		success: function (response) {
			console.log("enviado valor de select por GET");
		}
	}).responseText;
	document.getElementById("cuadroAyuda").innerHTML = ayuda;
});
//funcion patra detectar el cambio del select de ayuda y pintar su descripcion segun seleccion - fin
//funciones para traducir numeros a letras - inicio
function Unidades(num){
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="PESOS";
    data.letrasMonedaSingular="PESO";
  }else{
    data.letrasMonedaPlural="CENTAVOS";
    data.letrasMonedaSingular="CENTAVOS";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}
function NumeroALetrasSalarios(num,centavos){
	var data = {
	  numero: num,
	  enteros: Math.floor(num),
	  centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
	  letrasCentavos: "",
	};
	if(centavos == undefined || centavos==false) {
	  data.letrasMonedaPlural="SALARIOS";
	  data.letrasMonedaSingular="SALARIOS";
	}else{
	  data.letrasMonedaPlural="SALARIOS";
	  data.letrasMonedaSingular="SALARIOS";
	}
   
	if (data.centavos > 0)
	  data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
   
	if(data.enteros == 0)
	  return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
	if (data.enteros == 1)
	  return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
	else
	  return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  }
function NumeroALetrasUvts(num,centavos){
	var data = {
	  numero: num,
	  enteros: Math.floor(num),
	  centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
	  letrasCentavos: "",
	};
	if(centavos == undefined || centavos==false) {
	  data.letrasMonedaPlural="UVTs";
	  data.letrasMonedaSingular="UVTs";
	}else{
	  data.letrasMonedaPlural="UVTs";
	  data.letrasMonedaSingular="UVTs";
	}
   
	if (data.centavos > 0)
	  data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
   
	if(data.enteros == 0)
	  return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
	if (data.enteros == 1)
	  return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
	else
	  return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  }
//funciones para traducir numeros a letras - fin
//funciones para el llenado de las tablas - inicio
function listChequeo(){
	$(document).ready(function(){
		//$("#containerInicio").css("display", "none");
		$("#cuadroAyuda").hide();
		$("#containerInicio").hide();
		$("#tabla").show();
		//$("#containerInicio").css("visibility", "hidden");
		$('#tabla').load('../Vista/selectListaChequeo.php');
		//console.log("sisis");
		setTimeout(dataChequeo,15); //tiempo de espera para esperar que el DOM
		//se ejecute los thead y luego pinte la data
		//setInterval(data, 1000);
		//data();
		//var var1=table.row(this).data();
		//console.log("datosFinal: ");
		//var data = table.row().data();
		//console.log("Ancho de la tabla Primera funcion: "+data.length);
})
}
function listProcesos(){
	$(document).ready(function(){
		$("#cuadroAyuda").hide();
		$("#containerInicio").hide();
		$("#tabla").show();
		$('#tabla').load('../Vista/selectListaProcesos.php');
		//console.log("sisis");
		setTimeout(dataProcesos,15); //tiempo de espera para esperar que el DOM
		//se ejecute lo thead y luego pinte la data
		//setInterval(data, 1000);
		//data();
		//var var1=table.row(this).data();
		//console.log("datosFinal: ");
		//var data = table.row().data();
		//console.log("Ancho de la tabla Primera funcion: "+data.length);
})
}
function data2(){
	//$('#tabla3').dataTable().fnDestroy();
	console.log("ingreso a data2");
	var numChequeo=obtenerChequeo();
	console.log("valor finish-lap: "+numChequeo);
	crearProceso(numChequeo); //llevar el ChequeoId para asociar al proceso
	$("#chequeoId").val(numChequeo);
	$(document).ready(function(){
	$('#tabla3').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		columnDefs: [ //configurar ancho de las columnas
            { width: '2%', targets: 0 },
			{ width: '10%', targets: 1 },
			{ width: '10%', targets: 2 },
			{ width: '10%', targets: 3 },
			{ width: '2%', targets: 4 },
			{ width: '50%', targets: 5 },
        ],
        fixedColumns: true,
		//deferRender: true,
		lengthMenu: [[2, 10, 20, -1], [2, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [			
			{
				text: '<i class="fas" data-toggle="modal" data-target="#insertDeudores" >AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},

			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/ListaSancionados.php?w1="+numChequeo+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">edit delete</i>'
			  },
			  {"data":"TipodeDocumento",},
			  {"data":"NoDocumento",},
			  {"data":"Sancionado",},
			  {"data":"Genero",},
			  {"data":"Observaciones",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla4').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		//deferRender: true,
		columnDefs: [ //configurar ancho de las columnas
            { width: '2%', targets: 0 },
			{ width: '15%', targets: 1 },
			{ width: '15%', targets: 2 },
			{ width: '20%', targets: 3 },
			{ width: '50%', targets: 4 },
        ],
		lengthMenu: [[2, 10, 20, -1], [2, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},

			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaMotivoDevolucion.php?w1="+numChequeo+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">edit delete</i>'
			  },
			  {"data":"FDevolucion",},
			  {"data":"Motivo de Devolucion",},
			  {"data":"FSubsanado",},
			  {"data":"Observaciones",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla5').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		columnDefs: [ //configurar ancho de las columnas
            { width: '2%', targets: 0 },
			{ width: '2%', targets: 1 },
			{ width: '20%', targets: 2 },
			{ width: '20%', targets: 3 },
			{ width: '20%', targets: 4 }
        ],
		lengthMenu: [[2, 10, 20, -1], [2, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaChequeoOficios.php?w1="+numChequeo+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">edit delete</i>'
			  },
			  {"data":"FOficio",},
			  {"data":"Radicado",},
			  {"data":"Oficio",},
			  {"data":"Observaciones",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
})
}
function dataTabsProcesos(){
	//$('#tabla3').dataTable().fnDestroy();
	var numProceso=obtenerNumProceso();
	$("#numeroProceso").val(numProceso);
	console.log("valor finish-lap: "+numProceso);
	$(document).ready(function(){
	$('#tabla3').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		//deferRender: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		columnDefs: [ //configurar ancho de las columnas
            { width: '2%', targets: 0 },
			{ width: '5%', targets: 1 },
			{ width: '10%', targets: 2 },
			{ width: '10%', targets: 3 },
			{ width: '20%', targets: 4 },
			{ width: '20%', targets: 5 },
        ],
		buttons: [			
			{
				text: '<i class="fas" data-toggle="modal" data-target="#insertCorrespondencia" >AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},

			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaCorrespondencia.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "",
				orderable: false,
				data: null,
				defaultContent: '<button type="button" id="btn-create" class="btn btn-info" title="Imprimir Correspondencia">Imprimir</button>'
			  },
			  {"data":"Fecha",},
			  {"data":"Oficio",},
			  {"data":"Resolucion",},
			  {"data":"Radicado",},
			  {"data":"Observaciones",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla4').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		//deferRender: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},

			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaActuaciones.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Actuacion",},
			  {"data":"Fecha",},
			  {"data":"Resolucion",},
			  {"data":"Observaciones",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla5').DataTable({
		deferRender: true,
		processing: true,
		responsive:true,
		//deferRender: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaSolidarios.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">edit delete</i>'
			  },
			  {"data":"Deudor",},
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla6').DataTable({
		deferRender: true,
		processing: true,
		//deferRender: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIRRRR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCELL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaLlamadas.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Fecha",},
			  {"data":"Telefono",},
			  {"data":"Contesto",},
			  {"data":"Mensaje",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla7').DataTable({
		deferRender: true,
		processing: true,
		//deferRender: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaMedidasCautelares.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			{
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">edit delete</i>'
			  },
			  {"data":"Propiedad",},
			  {"data":"FEmbargo",},
			  {"data":"ResEmbargo",},
			  {"data":"Secuestrado",},
			  {"data":"FSecuestro",},
			  {"data":"Secuestre",},
			  {"data":"NoDocumento",},
			  {"data":"DirSecuestre",},
			  {"data":"TelSecuestre",},
			  {"data":"Comision",},
			  {"data":"Aviso Remanente",},
			  {"data":"FRemate",},
			  {"data":"ResolRemate",},
			  {"data":"Aprobacion",},
			  {"data":"Valor Rematado",},
			  {"data":"DiligEntrega",},
			  {"data":"Observaciones",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla8').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaLiquidacion.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"NoCuota",},
			  {"data":"Fecha",},
			  {"data":"Capital",},
			  {"data":"Interes",},
			  {"data":"Costas",},
			  {"data":"Intereses de Plazo",},
			  {"data":"Valor Cuota",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla9').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaAcuerdo.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Cuota",},
			  {"data":"Fecha",},
			  {"data":"Capital",},
			  {"data":"Intereses",},
			  {"data":"Costas",},
			  {"data":"Intereses Plazos",},
			  {"data":"Total",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla10').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaRecaudos.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"NoCuenta",},
			  {"data":"Fecha",},
			  {"data":"Numero",},
			  {"data":"Recaudo",},
			  {"data":"FRegistro",},
			  {"data":"Observaciones",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla11').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaNovedades.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"TipoNovedad",},
			  {"data":"Fecha",},
			  {"data":"Valor Anterior",},
			  {"data":"Valor Nuevo",},
			  {"data":"Modificado Por",},
			  {"data":"Observaciones",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla12').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaIntereses.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Fecha",},
			  {"data":"Intereses",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla13').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaAsignaciones.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Fecha",},
			  {"data":"Abogado",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla14').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaSuspensiones.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Inicio",},
			  {"data":"Finalizacion",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
	$('#tabla15').DataTable({
		deferRender: true,
		processing: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		"dom": '<<lBt>ip>r',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf">AÑADIR</i>',
				titleAttr: 'Añadir',
				className: 'btn btn-dark'
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		],
		select:true,
		select:{
			items:'cell',
		},
		ajax: {
			"url":"../Modelo/listaInterrupciones.php?w1="+numProceso+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {"data":"Inicio",},
			  {"data":"Finalizacion",}
		],
		language:{
			select:{
				rows:{
					_:"Sumerce seleccionó %d registros",
					0: "Haga Click en una fila para seleccionarla,",
					1: "Solo 1 fila seleccionada"
				}
			},
			"lengthMenu":"Mostrar _MENU_ registros",
			"zeroRecords":"No se encontraron resultados",
			"info":"Mostrando registros _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch":"Buscar:",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",
			},
			"sProcessing":"Procesando...",
		}
	});
})
}
function format(d) {
	obtenerChequeo(d.Chequeo);
	console.log ("data chequeo: "+d.Chequeo);
	//window.location.href = window.location.href + "?w1=" +numChequeo;
	return (
		'<div class="tabulador">' +
		'<ul class="nav nav-tabs">' +
		'<li class="nav-item">' +
		'<a data-toggle="tab" class="nav-link active" href="#home">' +
		'<icon class="fa fa-home"></icon> Deudores' +
		'</a>' +
		'</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile"><i class="fa fa-user"></i>Motivos de Devolución</a>' +
        '</li>' +
        '<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile1"><i class="fa fa-user"></i>Oficios</a>' +
        '</li>' +
		'</ul>' +
		'<!-- Tab panes -->' +
		'<div class="tab-content">' +
		'<div class="tab-pane active py-3" id="home">' +
		'<table id="tabla3"  cellspacing="0">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>Tipo de Documento</strong></th>'+
		'<th><strong>No. Documento</strong></th>'+
		'<th><strong>Sancionado</strong></th>   '+
		'<th><strong>Género</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
		'</div>' +
		'<div class="tab-pane fade py-3" id="profile">' +
		'<table id="tabla4" class="table" cellspacing="0" width="50%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>F. Devolución</strong></th>'+
		'<th><strong>Motivo de Devolución</strong></th>'+
		'<th><strong>F. Subsanado</strong></th>   '+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
		'</div>'+
		'<div class="tab-pane fade py-3" id="profile1">' +
		'<table width="70%" id="tabla5" class="table table-striped table-bordered"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>F.Oficio</strong></th>'+
		'<th><strong>Radicado</strong></th>'+
		'<th><strong>Oficio</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
        '</div>' +
        '</div>'+
		'<script type="text/javascript">setTimeout(data2(),10);</script>'
	);
}
function formatProcesos(d) {
	obtenerNumProceso(d.NoProceso);
	console.log ("data Procesos: "+d.NoProceso);
	//window.location.href = window.location.href + "?w1=" +numChequeo;
	return (
		'<div class="tabulador">' +
		'<ul class="nav nav-tabs">' +
		'<li class="nav-item">' +
		'<a data-toggle="tab" class="nav-link active" href="#home">' +
		'<icon class="fa fa-home"></icon> Correspondencia' +
		'</a>' +
		'</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile"><i class="fa fa-user"></i>Actuaciones</a>' +
        '</li>' +
        '<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile1"><i class="fa fa-user"></i>Solidarios</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile2"><i class="fa fa-user"></i>Llamadas</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile3"><i class="fa fa-user"></i>Medidas Cautelares</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile4"><i class="fa fa-user"></i>Liquidación para Acuerdo de Pago</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile5"><i class="fa fa-user"></i>Acuerdo de Pago</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile6"><i class="fa fa-user"></i>Recaudos</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile7"><i class="fa fa-user"></i>Novedades</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile8"><i class="fa fa-user"></i>Intereses</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile9"><i class="fa fa-user"></i>Asignaciones</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile10"><i class="fa fa-user"></i>Suspensiones</a>' +
        '</li>' +
		'<li class="nav-item">' +
        '<a data-toggle="tab" class="nav-link" href="#profile11"><i class="fa fa-user"></i>Interrupciones</a>' +
        '</li>' +
		'</ul>' +
		'<!-- Tab panes -->' +
		'<div class="tab-content">' +
		'<div class="tab-pane active py-3" id="home">' +
		'<table id="tabla3" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Oficio</strong></th>'+
		'<th><strong>Resolución</strong></th>   '+
		'<th><strong>Radicado</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
		'</div>' +
		'<div class="tab-pane fade py-3" id="profile">' +
		'<table id="tabla4" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Actuación</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Resolución</strong></th>'+
		'<th><strong>Observaciones</strong></th>   '+
		'</tr>' +
		'</thead>' +
		'</table>' +
		'</div>'+
		'<div class="tab-pane fade py-3" id="profile1">' +
		'<table id="tabla5" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>Deudor</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile2">' +
		'<table id="tabla6" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Teléfono</strong></th>'+
		'<th><strong>Contestó</strong></th>'+
		'<th><strong>Mensaje</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile3">' +
		'<table id="tabla7" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Buttons</strong></th>'+
		'<th><strong>Propiedad</strong></th>'+
		'<th><strong>F. Embargo</strong></th>'+
		'<th><strong>Res. Embargo</strong></th>'+
		'<th><strong>Secuestrado</strong></th>'+
		'<th><strong>F. Secuestrado</strong></th>'+
		'<th><strong>Secuestre</strong></th>'+
		'<th><strong>No. Documento</strong></th>'+
		'<th><strong>Dir. Secuestre</strong></th>'+
		'<th><strong>Tel. Secuestre</strong></th>'+
		'<th><strong>Comisión</strong></th>'+
		'<th><strong>Aviso Remate</strong></th>'+
		'<th><strong>F. Remate</strong></th>'+
		'<th><strong>Resol. Remate</strong></th>'+
		'<th><strong>Aprobación</strong></th>'+
		'<th><strong>Valor Rematado</strong></th>'+
		'<th><strong>Dilig. Entrega</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile4">' +
		'<table id="tabla8" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>No. Cuota</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Capital</strong></th>'+
		'<th><strong>Intereses</strong></th>'+
		'<th><strong>Costas</strong></th>'+
		'<th><strong>Intereses de Plazo</strong></th>'+
		'<th><strong>Valor Cuota</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile5">' +
		'<table id="tabla9" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Cuota</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Capital</strong></th>'+
		'<th><strong>Intereses</strong></th>'+
		'<th><strong>Costas</strong></th>'+
		'<th><strong>Intereses de Plazo</strong></th>'+
		'<th><strong>Total</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile6">' +
		'<table id="tabla10" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>No. Cuenta</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Número</strong></th>'+
		'<th><strong>Recaudo</strong></th>'+
		'<th><strong>F. Registro</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile7">' +
		'<table id="tabla11" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Tipo Novedad</strong></th>'+
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Valor Anterior</strong></th>'+
		'<th><strong>Valor Nuevo</strong></th>'+
		'<th><strong>Modificado Por</strong></th>'+
		'<th><strong>Observaciones</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile8">' +
		'<table id="tabla12" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Intereses</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile9">' +
		'<table id="tabla13" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Fecha</strong></th>'+
		'<th><strong>Abogado</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile10">' +
		'<table id="tabla14" class="display class="table table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Inicio</strong></th>'+
		'<th><strong>Finalización</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
		'<div class="tab-pane fade py-3" id="profile11">' +
		'<table id="tabla15" class="display class="tabe table-striped table-bordered table.dataTable.dataTable_width_auto"" cellspacing="0" width="100%">' +
		'<thead>' +
		'<tr>' +
		'<th><strong>Inicio</strong></th>'+
		'<th><strong>Finalización</strong></th>'+
		'</tr>' +
		'</thead>' +
		'</table>' +
        '</div>' +
        '</div>' +
        '</div>'+
		'<script type="text/javascript">setTimeout(dataTabsProcesos(),10);</script>'
	);
}
//funciones para el llenado de las tablas - fin
function obtenerChequeo(dd){ // funcion la cual trae el numero de chequeo seleccionado para desplegar la info
	console.log("conteoChequeo: "+count);
	if (count==0){
		count++;
		valor=dd;
		console.log("valor ingresado cuando count vale 0: "+valor);
	}
	else{
		//console.log("valor ingresado en obtener: "+valor);
		count=0;
		//console.log("Contador reiniciado"+count)
		return (valor);
	}
}
function obtenerNumProceso(dd){ // funcion la cual trae el numero de Proceso seleccionado para desplegar la info
	console.log("conteo: "+count);
	if (count==0){
		count++;
		valor=dd;
		console.log("valor ingresado cuando count vale 0: "+valor);
	}
	else{
		//console.log("valor ingresado en obtener: "+valor);
		count=0;
		//console.log("Contador reiniciado"+count)
		return (valor);
	}
}
function go(){
	var seccional=document.getElementById("seccional").value;
	var tipoCartera=document.getElementById("tipoCartera").value;
	$.post("../Modelo/models_insert.php",
        {
                //parametros
                comand: seccional,

            },
            function(data,status){                  

            });
			/*
			$comando = $_POST['comand'];
switch ($comando) {
    case "selectQuery":
        echo select();
        break;
    case "updateQuery":
        echo update();
        break;
    case "deleteQuery":
        echo delete();
        break;
}
function select(){
}
fuction update(){
}
function delete(){
}*/
 }
function obtenerSecCar(){
	var seccional=document.getElementById("seccional").value;
	var tipoCartera=document.getElementById("tipoCartera").value;
	valores[0]=seccional;
	valores[1]=tipoCartera;
	console.log("seccional: "+seccional+", TipoCartera: "+tipoCartera)
	return (valores);
 }
function inicioMenu(){
	//$("#tabla").css("visibility", "hidden");
	//$("#containerInicio").css("visibility", "visible");
	$(document).ready(function(){
		$("#containerInicio").show();
		$("#tabla").hide();
		/*$.ajax({
			type: "POST",
			url: "../index.php",
			dataType:'text',
			async:false,
			success: function (response) {
				console.log("Funcion realizada correctamente");
			}
		})*/
		console.log("ingreso a inicio");
		//$(document).load('../index.php');
		//document.write("<div><button id='b1'></button></div>");
})
}
function crearProceso(dataChequeo){
	console.log("conteoChequeo: "+count2);
	if (count2==0){
		count2++;
		valor=dataChequeo;
		console.log("valor ingresado cuando count vale 0 CrearProceso: "+valor);
	}
	else{
		count2=0;
		console.log("valor del dataChequeo guardado"+valor);
		return (valor);
	}
	console.log("valor de Chequeo"+dataChequeo);
}
function crearProceso2(){
	var tr = $(this).closest("tr");
	var row = table.row(tr);
	console.log("valor de la row"+Object.values(row.data()));
}
//FUNCION PARA INSERTAR CHEQUEO
$('#form1').submit(function(e) {
    e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

    // Obtiene los datos del formulario
    var formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'), //toma la url que se coloca en el action del form
      data: formData,
      success: function(response) {
		response = JSON.parse(response);
		//alert('En hora buena, datos ingresados correctamente');
		//window.location.href='javascript:history.back()';
        // Se ejecuta cuando la solicitud AJAX es exitosa
        console.log(response);
		if (response.success){
			$("#exampleModalCenter").modal('hide');
			alert(response.msj);
			listChequeo();
		}
		else{
			alert('ERROR');
		}
		//$('#respuesta').html(response);
      },
      error: function() {
        // Se ejecuta si hay algún error en la solicitud AJAX
		console.log();
        //$('#respuesta').html('Error al enviar el formulario.');
      }
    });
  });
//FUNCION PARA INSERTAR DEUDOR
$('#form2').submit(function(e) {
e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

// Obtiene los datos del formulario
var formData = $(this).serialize();
$.ajax({
	type: 'POST',
	url: $(this).attr('action'), //toma la url que se coloca en el action del form
	data: formData,
	success: function(response) {
	response = JSON.parse(response);
	//alert('En hora buena, datos ingresados correctamente');
	//window.location.href='javascript:history.back()';
	// Se ejecuta cuando la solicitud AJAX es exitosa
	console.log(response);
	if (response.success){
		$("#insertDeudores").modal('hide');
		alert(response.msj);
		listChequeo();
	}
	else{
		alert('ERROR');
	}
	//$('#respuesta').html(response);
	},
	error: function() {
	// Se ejecuta si hay algún error en la solicitud AJAX
	console.log();
	//$('#respuesta').html('Error al enviar el formulario.');
	}
});
})
$('#form3').submit(function(e) {
	e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
	
	// Obtiene los datos del formulario
	var formData = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: $(this).attr('action'), //toma la url que se coloca en el action del form
		data: formData,
		success: function(response) {
		response = JSON.parse(response);
		//alert('En hora buena, datos ingresados correctamente');
		//window.location.href='javascript:history.back()';
		// Se ejecuta cuando la solicitud AJAX es exitosa
		console.log(response);
		if (response.success){
			$("#insertCorrespondencia").modal('hide');
			alert(response.msj);
			listProcesos();
		}
		else{
			alert('ERROR');
		}
		//$('#respuesta').html(response);
		},
		error: function() {
		// Se ejecuta si hay algún error en la solicitud AJAX
		console.log();
		//$('#respuesta').html('Error al enviar el formulario.');
		}
	});
	})