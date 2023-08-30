function dataChequeo(){
	//console.log("hello moto"+format().obtener());
	$(document).ready(function(){
	var seccional=document.getElementById("seccional").value;
	var tipoCartera=document.getElementById("tipoCartera").value;
	$("#seccionalID").val(seccional);
	$("#carteraTipoId").val(tipoCartera);
	console.log("ingreso data1");
	var table=$('#tabla1').DataTable({
		//bDestroy: true,
		orderCellsTop: true,
		fixedHeader: true,
		deferRender: true,
		processing: true,
		responsive: true,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']], //cambiar el filtro de registros
		//"dom": '<f<lBt>ip>r',
		//"dom": '<"top"i>rt<"bottom"flp<"clear">',
		//"dom": '<f<t>ip></t>',
		buttons: [
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel">EXCEL</i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend: 'pdf',
				text: '<i class="fas fa-file-pdf">PDF</i>',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend: 'print',
				text: '<i class="fa fa-print">PRINT</i>',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		],
		select:true,
		select:{
			items:'row', //para seleccionar celdas
		},
		ajax: {			
			"url":"../Modelo/listaChequeo.php?w1="+seccional+"&w2="+tipoCartera+"",//Url de donde viene la consulta
			"dataSrc": ""//comando necesario para limpiar el Source
		},
		columns:[
			  {
				className: "details-control",
				orderable: false,
				data: null,
				defaultContent: '<i class="material-icons">▼</i>'
			  },
			  {data:"button"},
			  {data:"Chequeo",},
			  {"data":"CreationDate",},
			  {"data":"Despacho",},
			  {"data":"ConceptoNaturaleza",},
			  {"data":"No Radicado de Origen",},
			  {"data":"Providencia",},
			  {"data":"Ejecutoía",},
			  {"data":"Tipo",},
			  {"data":"Cantidad",},
			  {"data":"Obligación",},
			  {"data":"Costas",},
			  {"data":"1aCopia",},
			  {"data":"Auténtica",},
			  {"data":"Presta Mérito Ejecutivo",},
			  {"data":"Clara",},
			  {"data":"Expresa",},
			  {"data":"Actualmente Exigible",},
			  {"data":"Competencia",},
			  {"data":"Falta de Requisitos",},
			  {"data":"Falta de Competencia",},
			  {"data":"Por Prescripción",},
			  {"data":"Seccional Destino",},
			  {"data":"Autorizado por",},
			  {"data":"FAutorización",},
			  {"data":"Tramite",},
			  {"data":"Abogado",},
			  {"data":"ExpFísico",},
			  {"data":"ExpDigital",},
		],
		"language":{
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
		},
	});
	  $('#tabla1 tbody').on('click', 'td.details-control', function() {
		//$('#tabla3').dataTable().fnDestroy();
		//setTimeout(data2(),10);
		var tr = $(this).closest("tr");
		var row = table.row(tr);
		//	console.log("table row: "+row);
		//console.log("valorrr: "+JSON.stringify(row));
		console.log("valor de la row"+Object.values(row.data()));
		if (row.child.isShown()) {
		  row.child.hide(); // esconde fila hija
		  tr.removeClass("shown"); //remueve la clase Mostrar
		  console.log("esconder");
		} else {
		  row.child(format(row.data()), "p-0").show();
		  tr.addClass("shown");
		  console.log("contador"+count);
		  console.log("Mostrar");
		}
	  });
	  /* =========================================================================================== */
	  /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
	  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
	  });

	  $('#tabla1 tbody').on('click', '#btn-create', function() {
		var tr = $(this).closest("tr");
		var row = table.row(tr);
		if (row.data().Tramite=='APERTURA'){
			//alert('El tramite es APERTURA');
			/*
			var topesMaximos=$.ajax({
				type: "method",
				url: "../Modelo/selectEmpresas.php",
				dataType:'text',
				async:false,
				success: function (response) {
					console.log("enviado valor de select por GET");
			}
			}).responseText;
			console.log("valor de topes"+topesMaximos);
			if (row.data().Tipo=1 && row.data().Tipo>topesMaximos.MaximoPesos){
				alert('Error: El valor excede el maximo de pesos que es '+topesMaximos.MaximoPesos);
			}
			*/
			var mensajeCrearProceso=$.ajax({
			type: "method",
			//url: "../Modelo/pruebaJuan1.php",
			url: "../Modelo/insertProcesos.php?w1="+row.data().Chequeo,
			dataType:'text',
			async:false,
			success: function (response) {
				console.log("enviado valor de select por GET");
			}
		}).responseText;
		//alertas generadas desde procesos cuando se crea :)
		console.log ("Variable exintrica: "+mensajeCrearProceso);
		if (mensajeCrearProceso=="Debe Contener Sancionado el Chequeo"){
			alert('Error: EL CHEQUEO DEBE TENER SANCIONADO');
		}
		if (mensajeCrearProceso=="El sancionado ya se encuentra registradoLa insercion del proceso es correcta"){
			alert('En Hora Buena, el Proceso es creado correctamente y el sancionado ya esta registrado');
		}
		if (mensajeCrearProceso=="El sancionado no se encuentra registradoLa insercion del proceso es correcta"){
			alert('En Hora Buena, el Proceso es creado correctamente y se inserta un nuevo Sancionado');
		}
		listChequeo(); // se refrezca el proceso para pintar la grilla :) 
		}
		else{
			alert('El tramite debe estar en APERTURA');
			//window.location.href='javascript:history.back()';
		}
		//console.log("holaaaa bitchh"+JSON.stringify(row.data()));
	  })
	  $('#modal-body').on('click', '#actualizar', function(){
		$('#registroChequeo').modal('toggle');
	  })
	  //$('#tabla1 thead tr').clone(true).appendTo('#tabla1 thead');

	//console.log(JSON.stringify(table.data));
})
}
function dataProcesos(){
	//console.log("hello moto"+format().obtener());
	$(document).ready(function(){
		var seccional=document.getElementById("seccional").value;
		var tipoCartera=document.getElementById("tipoCartera").value;
		console.log("ingreso dataProcesos");
		var table=$('#tabla1').DataTable({
			deferRender: true,
			processing: true,
			//bDestroy: true,
			responsive:true,
			lengthMenu: [[15, 30, 50, 100, -1], [15, 30, 50, 100, 'Todos']], //cambiar el filtro de registros
			//"dom": '<f<lBt>ip>r',
			//"dom": '<"top"i>rt<"bottom"flp<"clear">',
			//"dom": '<f<t>ip></t>',
			buttons: [
				{
					extend: 'excel',
					text: '<i class="fas fa-file-excel">EXCEL</i>',
					titleAttr: 'Exportar a Excel',
					className: 'btn btn-success'
				},
				{
					extend: 'pdf',
					text: '<i class="fas fa-file-pdf">PDF</i>',
					titleAttr: 'Exportar a PDF',
					className: 'btn btn-danger'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print">PRINT</i>',
					titleAttr: 'Imprimir',
					className: 'btn btn-info'
				},
			],
			select:true,
			select:{
				items:'row', //para seleccionar celdas
			},
			ajax: {			
				"url":"../Modelo/listaProcesos.php?w1="+seccional+"&w2="+tipoCartera+"",
				//Url de donde viene la consulta
				"dataSrc": ""//comando necesario para limpiar el Source
			},
			//deferRender: true,
			columns:[
				{
					className: "details-control",
					orderable: false,
					data: null,
					defaultContent: '<i class="material-icons">▼</i>'
				  },
				  {"data":"Concepto",},
				  {"data":"NoProceso",},
				  {"data":"Deudor",},
				  {"data":"ObliInicial",},
				  {"data":"CostInicial",},
				  {"data":"inteinicial",},
				  {"data":"Recaudo",},
				  {"data":"ObliSaldo",},
				  {"data":"CostSaldo",},
				  {"data":"InteSaldo",},
				  {"data":"SaldoTotal",},
				  {"data":"Minjusticia",},
				  {"data":"FCreación",},
				  {"data":"FProvidencia",},
				  {"data":"FEjecutoria",},
				  {"data":"FPlazo",},
				  {"data":"FNotificacion",},
				  {"data":"FAcuerdo",},
				  {"data":"FIncumplimiento",},
				  {"data":"calculaPrescripcion",},
				  {"data":"Estado",},
				  {"data":"Etapa",},
				  {"data":"FTerminación",},
				  {"data":"MotivoTerminación",},
				  {"data":"UltActuación",},
				  {"data":"No Radicado Origen",},
				  {"data":"DespachoJuzgado",},
				  {"data":"Folios",},
				  {"data":"MinJusticia1",},
				  {"data":"Naturaleza",},
				  {"data":"Abogado",},
			],
			"language":{
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
			},
			rowCallback:function(row,data) // funcion para pintar las celdas
			{
				$($(row).find("td")[4]).addClass("colorYellow");
				$($(row).find("td")[5]).addClass("colorYellow");
				$($(row).find("td")[6]).addClass("colorYellow");
				$($(row).find("td")[8]).addClass("colorBlue");
				$($(row).find("td")[9]).addClass("colorBlue");
				$($(row).find("td")[10]).addClass("colorBlue");
				$($(row).find("td")[11]).addClass("colorRed");
			},
		});
		//console.log ("data chequeo222: "+d.Chequeo);
		  $('#tabla1 tbody').on('click', 'td.details-control', function() {
			//$('#tabla3').dataTable().fnDestroy();
			//setTimeout(data2(),10);
			var tr = $(this).closest("tr");
			var row = table.row(tr);
			//	console.log("table row: "+row);
			console.log("valorrr: "+row.data().NoProceso);
			if (row.child.isShown()) {
			  row.child.hide(); // esconde fila hija
			  tr.removeClass("shown"); //remueve la clase Mostrar
			  console.log("esconder");
			} else {
			  row.child(formatProcesos(row.data()), "p-0").show();
			  tr.addClass("shown");
			  console.log("contador"+count);
			  console.log("Mostrar");
			}
		  });
		  /* =========================================================================================== */
		  /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
		  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
		  }); 
		//console.log(JSON.stringify(table.data));
	})
}