<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript" >

	$(document).ready(function() {

		$(document).off('change', 'select');
        $(document).on('change', 'select', function () {
            var idbutton = $(this).attr("id");
            var optionSelected = $(this).children(":selected");
            var codeselected = optionSelected.attr("data-id");
            var selText = optionSelected.val().trim()

            if (idbutton == "selectRegion") 
            {
				$(this).attr("date-code-reg",codeselected);
                load_Provincias(optionSelected, codeselected);
            }
            else if (idbutton == "selectProvincia") 
            {
                load_Comunas(optionSelected, codeselected);
            }
            else if (idbutton == "selectComuna") 
            {
				$(this).attr("date-code-comu",codeselected);
                var inputDireccion = $("[data-id=inputDireccion]");
                clean_InputBootstrap(inputDireccion,false);
            }
            else if (idbutton == "inputTipoPrevision") 
            {
				var code = optionSelected.attr("data-code");
				load_Previsiones(code);
            }
			else if (idbutton == "inputPrevision") {
				$(this).attr("date-code-previ",codeselected);
			}
            else if (idbutton == "inputgruposanguineo") 
            {
                $(this).attr("date-code-grsan",codeselected);
            }
            else if (idbutton == "inputCategoria") 
            {
                $(this).attr("date-code-cate",codeselected);
            }
            else if (idbutton == "inputUbCancha") 
            {
            	$(this).attr("date-code-ubcan",codeselected);
            }
            else if (idbutton == "inputTipBeneficio") 
            {
                $(this).attr("date-code-tipben",codeselected);
                $("#inputFechaIni").removeAttr("disabled");
                $("#inputFechaFin").removeAttr("disabled");
            }
            else if (idbutton == "NivelResponsabilidad") 
            {
                $(this).attr("date-code-nvlresp",codeselected);
            }
			else if (idbutton == "inputTipoDeLesiones")
			{
				$(this).attr("date-code-tiples",codeselected);
			}
            else if (idbutton == "inputAreaCorporal")
            {
                $(this).attr("date-code-data-child",codeselected);
				var dataChild = optionSelected.attr("data-code-parent");;
				load_SegCorporal($(this), dataChild);
            }
            else if (idbutton == "inputSegmentoCorporal")
            {
                $(this).attr("date-code-segcorp",codeselected);
            }

            console.log(selText);
        });

		$(document).off('click', '.saveJugador');
		$(document).on('click', '.saveJugador', function () {
			event.preventDefault();
			console.log("Click Button Save");

			var valueStep = $(this).attr("data-id-step");

			var resultError = validateLastStep(valueStep);

			if ( resultError != "" ) {
				showModal(resultError);
				return;
			}

			var paramComina = "";
			if (typeof $("#selectRegion").attr("date-code-reg") == "undefined" || $("#selectRegion").attr("date-code-reg") == "1")
			{
				paramComina = "1";
			}
			else
			{
				paramComina = (typeof $("#selectComuna").attr("date-code-comu") == "undefined" || $("#selectComuna").attr("date-code-comu") == "")
				? "1" 
				: $("#selectComuna").attr("date-code-comu");
			}

			/* ( 1 ) */
			var objper =
			{
				"Nombre"          : $("#inputNombres").val().trim(),
				"Apellido"        : $("#inputApellidos").val().trim(),
				"Rut"             : $("#inputRut").val().trim(),
				"FotoPerfil"      : $("#inputFotoPerfil").val().split('\\').pop(),
				"FechaNacimiento" : formatDate($("#fechanacjugador")),
				"FonoContacto"    : $("#inputFonoContacto").val().trim(),
				"Email"           : $("#inputemail").val().trim(),
				"PkComuna"        : paramComina,
				"Direccion"       : $("#inputDireccion").val().trim()
			};
			
			/* ( 2 ) */
			var objJug =
			{
				"FechaIngresoJugador"  :  formatDate($("#inputingresoClubfecha")),
				"LlamadaEmergencia"    : $("#inputllamara").val().trim() == "" ? "Pendiente" : $("#inputllamara").val().trim(),
				"Estatura"             : $("#inputestatura").val().trim() == "" ? "0" : $("#inputestatura").val().trim(),
				"Peso"                 : $("#inputpeso").val().trim() == "" ? "0" : $("#inputpeso").val().trim(),
				"SeguroAccidente"      : $('[name="seguroaccidente"]:checked').val() == 'Si' ? $("#inputseguroAccidente").val() : "Sin Seguro",
				"EstadoEnClub"         : "Activo",//$('[name="estadoclub"]:checked').val(),
				"Medicamentos"         : $("#inputmedicamentos").val().trim() == "" ? "Sin Medicamentos" : $("#inputmedicamentos").val().trim(),
				"EvaluaNutricional"    : $("#inputevalunutri").val().trim() == "" ? "Pendiente" : $("#inputevalunutri").val().trim(),
				"Alergias"             : $("#inputalergias").val().trim() == "" ? "Sin Alergias" : $("#inputalergias").val().trim(),
				"Obserbaciones"        : $("#inputobserbaciones").val().trim() == "" ? "" : $("#inputobserbaciones").val().trim(),
				"PkPrevision"          : (typeof $("#inputPrevision").attr("date-code-previ") == "undefined" || $("#inputPrevision").attr("date-code-previ") == "") ? "1" : $("#inputPrevision").attr("date-code-previ"),
				"GrupoSanguineo"       : (typeof $("#inputgruposanguineo").attr("date-code-grsan") == "undefined" || $("#inputgruposanguineo").attr("date-code-grsan") == "") ? "1" : $("#inputgruposanguineo").attr("date-code-grsan"),
				"Categoria"            : (typeof $("#inputCategoria").attr("date-code-cate") == "undefined" || $("#inputCategoria").attr("date-code-cate") == "") ? "1" : $("#inputCategoria").attr("date-code-cate"),
				"UbicacionCancha"      : (typeof $("#inputUbCancha").attr("date-code-ubcan") == "undefined" || $("#inputUbCancha").attr("date-code-ubcan") == "") ? "1" : $("#inputUbCancha").attr("date-code-ubcan")
			};

			/* ( 3 ) */
			var objtipben =
			{
				"Tipbeneficio": (typeof $("#inputTipBeneficio").attr("date-code-tipben") == "undefined" || $("#inputTipBeneficio").attr("date-code-tipben") == "") ? 1 : $("#inputTipBeneficio").attr("date-code-tipben"),
				"FechaIniBeneficio"  : formatDate($("#inputFechaIni")),
				"FechaFinBeneficio"  : formatDate($("#inputFechaFin")),
				"Observacion"        : $("#inputObservacion").val(),
			}; 

			/*  ( 4 )
			** Se debe mejorar Código para trabajar con un Lista de apoderados
			** Cuando la aplicación lo Soporte. */
			var apoderados = getApoderados();

			/* ( 5 ) */
			var objlesiones = getLesiones();

			var persona = JSON.stringify(objper);
			var apoderadosList = JSON.stringify(apoderados);
			var tipoBeneficio = JSON.stringify(objtipben);
			var jugador = JSON.stringify(objJug);
			var lesionies = JSON.stringify(objlesiones);
			

			var url = '<?php echo site_url('jugador/insertRegistroJugador') ?>';

			$.ajax({
				url: url, 
				type: 'POST',
				data:{
					paramPersona : persona,
					paramApoderados : apoderadosList,
					paramTipoBeneficio : tipoBeneficio,
					paramJugador : jugador,
					paramLesiones : lesionies,
				},
				success: function(response){
					var jsonresponse = JSON.parse(response);
					console.log(response);
					if (jsonresponse.Isvalid) {
						/* showModal("Registro Insertado Exitosamente."); */
						alert("Registro Insertado Exitosamente.");
						$("#RegistrarJugador").click();
					} else {
						showModal(jsonresponse.ErrorMessage);
					}
					
				},error: function(response,status,error){
					showModal(response.responseText);
				}
			});

		});

		$(document).off('click', '.checkprevision');
		$(document).on('click', '.checkprevision', function () {
			var id = $(this).attr("data-id");
			var name = $(this).attr("data-name");
			var code = $(this).attr("data-code");
			var a_value = $(this).text().trim();
			$(this).closest("div").find("button").text(a_value);

			load_Previsiones(code);
		});

		$(document).off('click', 'input:radio');
		$(document).on('click', 'input:radio', function () {
			var element = $(this);
			var divContain = element.closest("div.divcontain");
			var inputElement = divContain.find("input.form-control");

			if ($(this).val() == 'Si') {
				inputElement.removeAttr('disabled');
				console.log('radio Si');
			} else {
				inputElement.val("");
				inputElement.attr('disabled','disabled');
				console.log('radio No');
			} 
		});

		$(document).off('click', '.checkEstadoClub');
		$(document).on('click', '.checkEstadoClub', function () {
			var option = $(this).closest("label").text().trim();
		});

		$(document).off('click', '.checkEvaNutri');
		$(document).on('click', '.checkEvaNutri', function () {
			var option = $(this).closest("label").text().trim();
		});

		$(document).off('click', '.deleteRowApo');
		$(document).on('click', '.deleteRowApo', function () {
			var element = $(this).closest("tr");
			var tbody = $(element).closest("tbody")
			if (typeof element != "undefined")
			{
				destroyDataTable ("tableApoderados");
				element.remove();
				loadDataTable("tableApoderados");
			}
		});

		$(document).off('click', '.deleteRowLesion');
		$(document).on('click', '.deleteRowLesion', function () {
			var element = $(this).closest("tr");
			var tbody = $(element).closest("tbody")
			if (typeof element != "undefined")
			{
				destroyDataTable ("tablelesiones");
				element.remove();
				loadDataTable("tablelesiones");
			}
		});

		$(document).off('change', '#tipbeneficio');
		$(document).on('change', '#tipbeneficio', function () {

		});

		function validateLastStep(valueStep)
		{
			switch (valueStep) {
				case "1":
					return validateAntecedentesPersonales();
					break;
				case "2":
					return validateAntecedentesJugador();
					break;
				case "3":
					return validateTipoBeneficio();
					break;
				case "4":
					return validateApoderados("");
					break;
				case "5":
					return validateLesiones("");
					break;
				default: 
					return "";
			}
		}
	});

	function load_Provincias(comoboselected, idregion) {
		console.log('function load_Provincias.');
		var selected = false;

		var selectRegion = $("#selectRegion");
		var selectProvincia = $("#selectProvincia");
		var selectComuna = $("#selectComuna");

		var inputDireccion = $("[data-id=inputDireccion]");

		if (idregion == 1)
		{
			selected = true;
			clean_Select(selectProvincia,"<?php echo lang('seleccione_provincia') ?>",selected);
			clean_Select(selectComuna,"<?php echo lang('seleccione_comuna') ?>",selected);
			$("#selectRegion").removeAttr("date-code-reg");
			$("#selectComuna").removeAttr("date-code-comu");

			clean_InputBootstrap(inputDireccion,selected);
			return;
		}

		var url = '<?php echo site_url('jugador/getProvinciasByRegion') ?>';

		$.ajax({
			url: url, 
			type: 'POST',
			data:{selectedregin : idregion},
			success: function(response){
				console.log(response);
				var json = JSON.parse(response);
				
				selectProvincia.empty();
				selectProvincia.append('<option selected hidden class="wpor90" data-id="NN">' + '<?php echo lang('seleccione_provincia') ?>' + '</option>');

				for ( post in json)
				{
					console.log(json[post]);
					selectProvincia.append('<option data-id="' + json[post].PVC_PK + '">' + json[post].PVC_DESC + '</option>');
				}

				clean_Select(selectProvincia,"<?php echo lang('seleccione_provincia') ?>",selected);

				if (selectComuna.text().trim() != "<?php echo lang('seleccione_comuna') ?>")
				{
					clean_Select(selectComuna,"<?php echo lang('seleccione_comuna') ?>", true);
					$("#selectComuna").removeAttr("date-code-comu");
					clean_InputBootstrap(inputDireccion,true);
				}

			},error: function(response,status,error){
				console.log('error de load_Provincias');
			}
		});
	}

	function load_Comunas(comoboselected, idprevicion) {
		console.log('function load_Comunas.');
		var selectRegion = $("#selectRegion");
		var selectProvincia = $("#selectProvincia");
		var selectComuna = $("#selectComuna");
		var inputDireccion = $("[data-id=inputDireccion]");

		if (selectComuna.text().trim() != "<?php echo lang('seleccione_comuna') ?>")
		{
			clean_InputBootstrap(inputDireccion,false);
		}
		else
		{
			clean_InputBootstrap(inputDireccion,true);
		}

		clean_Select(selectComuna,"<?php echo lang('seleccione_comuna') ?>",false);
		$("#selectComuna").removeAttr("date-code-comu");

		var url = '<?php echo site_url('jugador/getComunasByProvincia') ?>';
		$.ajax({
			url: url, 
			type: 'POST',
			data:{selectedprovincia : idprevicion},
			success: function(response){
				console.log(response);
				var json = JSON.parse(response);

				selectComuna.empty();
				selectComuna.append('<option selected hidden class="wpor90" data-id="NN">' + '<?php echo lang('seleccione_comuna') ?>' + '</option>');

				for ( post in json)
				{
					console.log(json[post]);
					selectComuna.append('<option data-id="' + json[post].CMA_PK + '">' + json[post].CMA_DESC + '</option>');
				}

			},error: function(response,status,error){
				console.log('error de load_Comunas');
			}
		});
	}

	function load_Previsiones(selectedprevision) {
		console.log('function load_Previsiones.');
		var selectPrevicion = $("#inputPrevision");

		if (selectedprevision == 0)
		{
			selected = true;
			clean_Select(selectPrevicion,"<?php echo lang('seleccione_prevision') ?>",selected);
			$("#inputPrevision").removeAttr("date-code-previ");
			return;
		}

		clean_Select(selectPrevicion,"<?php echo lang('seleccione_prevision') ?>",false);
		var url = '<?php echo site_url('jugador/getPrevisonesByTipo') ?>';

		$.ajax({
			url: url, 
			type: 'POST',
			data:{selectedprevision : selectedprevision},
			success: function(response){
				console.log(response);
				var json = JSON.parse(response);

				selectPrevicion.empty();
				selectPrevicion.append('<option selected hidden class="wpor90" data-id="NN">' + '<?php echo lang('seleccione_prevision') ?>' + '</option>');

				for ( post in json)
				{
					console.log(json[post]);
					selectPrevicion.append('<option data-id="' + json[post].PVS_PK + '" data-code="' + json[post].PVS_CODE + '" data-name="' + json[post].PVS_NOMBRE + '">' + json[post].PVS_DESC + '</option>');
				}

			},error: function(response,status,error){
				console.log('error de load_Previsiones');
			}
		});
	}

	function load_SegCorporal(element, selectedarCorp) {
		console.log('function load_Previsiones.');
		var rowTr = $(element).closest("tr");
		var selectSegCorp = rowTr.find("#inputSegmentoCorporal");

		clean_Select(selectSegCorp,"<?php echo lang('seleccione_Segmento_Corporal') ?>",false);
		var url = '<?php echo site_url('jugador/getSegmentoCorporal') ?>';

		$.ajax({
			url: url, 
			type: 'POST',
			data:{segCorp : selectedarCorp},
			success: function(response){
				console.log(response);
				var json = JSON.parse(response);
				
				var rowTr = $(element).closest("tr");
				var selectProvinciaInter = rowTr.find("#inputSegmentoCorporal");
				selectProvinciaInter.empty();
				selectProvinciaInter.append('<option selected hidden class="wpor90" data-id="NN">' + '<?php echo lang('seleccione_Segmento_Corporal') ?>' + '</option>');

				for ( post in json)
				{
					console.log(json[post]);
					selectProvinciaInter.append('<option data-id="' + json[post].LSN_PK + '" data-code-les="' + json[post].LSN_CHILD_LESION + '">' + json[post].LSN_DESCRIPCION + '</option>');
				}
				
				var inpDiagnostico = rowTr.find("#inputDiagnostico");
				inpDiagnostico.removeAttr("disabled");

			},error: function(response,status,error){
				console.log('error de load_SegCorporal');
			}
		});
	}

	function load_AddLesiones(comoboselected, idareacorp) {
		console.log('function load_AddLesiones.');
		var selectRegion = $("#selectRegion");
		var selectProvincia = $("#selectProvincia");
		var selectComuna = $("#selectComuna");
		var inputDireccion = $("[data-id=inputDireccion]");

		if (selectComuna.text().trim() != "<?php echo lang('seleccione_comuna') ?>")
		{
			clean_InputBootstrap(inputDireccion,false);
		}
		else
		{
			clean_InputBootstrap(inputDireccion,true);
		}

		clean_Select(selectComuna,"<?php echo lang('seleccione_comuna') ?>",false);
		$("#selectComuna").removeAttr("date-code-comu");

		var url = '<?php echo site_url('jugador/getComunasByProvincia') ?>';
		$.ajax({
			url: url, 
			type: 'POST',
			data:{selectedprovincia : idareacorp},
			success: function(response){
				console.log(response);
				var json = JSON.parse(response);

				selectComuna.empty();
				selectComuna.append('<option selected hidden class="wpor90" data-id="NN">' + '<?php echo lang('seleccione_comuna') ?>' + '</option>');

				for ( post in json)
				{
					console.log(json[post]);
					selectComuna.append('<option data-id="' + json[post].CMA_PK + '">' + json[post].CMA_DESC + '</option>');
				}

			},error: function(response,status,error){
				console.log('error de load_AddLesiones');
			}
		});
	}

	$(document).off('click', '#AsingApo');
	$(document).on('click', '#AsingApo', function () {
		console.log('click AsingApo.');
		/* habilitar button add apoderados */
		$("#contenedorButtonApo").find("#buttonAddApoderado").removeAttr("disabled");

		/* Sin Apoderados */
		$("#AsingApo").addClass("Active");
		$("#PendiAsingApo").removeClass("Active");

		$("[name='NivelResponsabilidad']").removeAttr("disabled");
		$("[name='inputNombreApo']").removeAttr("disabled");
		$("[name='inputemailApo']").removeAttr("disabled");
		$("[name='inputFonoApo']").removeAttr("disabled");
	});

	$(document).off('click', '#PendiAsingApo');
	$(document).on('click', '#PendiAsingApo', function () {
		console.log('click PendiAsingApo.');
		/* des-habilitar button add apoderados */
		$("#contenedorButtonApo").find("#buttonAddApoderado").attr("disabled","disabled");

		/* Sin Apoderados */ 
		$("#PendiAsingApo").addClass("Active");
		$("#AsingApo").removeClass("Active");

		$("[name='NivelResponsabilidad']").attr("disabled","disabled");
		$("[name='inputNombreApo']").attr("disabled","disabled");
		$("[name='inputemailApo']").attr("disabled","disabled");
		$("[name='inputFonoApo']").attr("disabled","disabled");
	});

	$(document).off('click', '#AsingLes');
	$(document).on('click', '#AsingLes', function () {
		console.log('click AsingLes.');
		/* habilitar button add lesiones */
		$("#contenedorButtonLesion").find("#buttonAddLesiones").removeAttr("disabled");

		/* habilitar */
		$("#AsingLes").addClass("Active");
		$("#PendiAsingLes").removeClass("Active");
		
		$("[name='inputAreaCorporal']").removeAttr("disabled");
		$("[name='inputSegmentoCorporal']").removeAttr("disabled");
		$("[name='inputDiagnostico']").removeAttr("disabled");
		$("[name='inputFechaLesion']").removeAttr("disabled");
	});

	$(document).off('click', '#PendiAsingLes');
	$(document).on('click', '#PendiAsingLes', function () {
		console.log('click PendiAsingLes.');
		/* des-habilitar button add lesiones */
		$("#contenedorButtonLesion").find("#buttonAddLesiones").attr("disabled","disabled");

		/* des-habilitar */
		$("#PendiAsingLes").addClass("Active");
		$("#AsingLes").removeClass("Active");
		
		$("[name='inputAreaCorporal']").attr("disabled","disabled");
		$("[name='inputSegmentoCorporal']").attr("disabled","disabled");
		$("[name='inputDiagnostico']").attr("disabled","disabled");
		$("[name='inputFechaLesion']").attr("disabled","disabled");
	});

	$(document).off('click', '#BuscarJugador');
	$(document).on('click', '#BuscarJugador', function () {
		console.log('click BuscarJugador.');
		var url = '<?php echo site_url('jugador/searchJugador') ?>';

		var objJugador =
		{
			"Nombre"          : $("#inputNombres").val().trim(),
			"Apellido"        : $("#inputApellidos").val().trim(),
			"Rut"             : $("#inputRut").val().trim(),
			"Categoria"       : (typeof $("#inputCategoria").attr("date-code-cate") == "undefined" || $("#inputCategoria").attr("date-code-cate") == "") ? "0" : $("#inputCategoria").attr("date-code-cate"),
		};

		var searchJugador = JSON.stringify(objJugador);

		$.ajax({
			url: url, 
			type: 'POST',
			data:{
				searchJugador : searchJugador,
			},
			success: function(response){
				console.log(response);
				var obj = JSON.parse(response);

				destroyDataTable ("tableBuscarJugador");

				var table = $("#tableBuscarJugador").DataTable({
					language: {
						"sProcessing":     "Procesando...",
						"sLengthMenu":     "Mostrar _MENU_ registros",
						"sZeroRecords":    "No se encontraron resultados",
						"sEmptyTable":     "Ningún dato disponible en esta tabla",
						"sInfo":           "Registros del _START_ al _END_, Total de _TOTAL_ Reg.",
						"sInfoEmpty":      "Registros del 0 al 0, Total de 0 Reg.",
						"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":    "",
						"sSearch":         "Buscar:",
						"sUrl":            "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "<<",
							"sLast":     ">>",
							"sNext":     ">",
							"sPrevious": "<"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					},
					dom: '<"mb15"B><lf><tr>ip',
					sPaginationType: "full_numbers",
					responsive: true,
					buttons: [
						{
							"extend": 'excelHtml5',
							"title": 'Lista Jugadores',
							"text": '&nbsp;&nbsp;&nbsp;Excel',
							"className": 'btn btn-primary btn-xs fa fa-file-excel-o pl15 pr15 pt10 pb10 fontsize18'
						},
						{
							"extend": 'pdfHtml5',
							"title": 'Lista Jugadores',
							"text": '&nbsp;&nbsp;&nbsp;PDF',
							"className": 'btn btn-primary btn-xs fa fa-file-pdf-o pl15 pr15 pt10 pb10 fontsize18'
						},
					],
					data: JSON.parse(response),
					exportStyles: { 
						cssStyles: ['red_highlight', 'yellow_highlight'],
						excelStyles: [5, 11]
					},
					columns: [
						{ data: "JUG_PK", className: "text-center", render: function (data, type, full) {
								return  '' + full.JUG_PK ;
							}
						},
						{ data: "PER_NOMBRES", className: "text-center", render: function (data, type, full) {
								return data + " " + full.PER_APELLIDOS;
							}
						},
						{ data: "PER_RUT", className: "text-center" },
						{ data: "JUG_FEC_INI_CLUB", type: "datetime", format: 'MM/DD/YYYY', def: function () { return new Date(); }, className: "text-center" },
						{ data: "CAT_DESC_CATEGORIA", className: "text-center" },
						{ data: "BEF_DESCRIPCION", className: "text-center" },
						{ data: "BEGU_OBSERVACION", className: "text-center" },
						{ data: "JUG_PK", className: "text-center", render: function (data) {
								return '<a class="btn btn-sm btn-primary" data-id-edir-jugador="' + data + '"><span class="glyphicon glyphicon-pencil"></span> </a>';
							}
						}
					]
				});
 
				table.buttons().container().appendTo( '#tableBuscarJugador_wrapper .col-sm-6:eq(0)' );

			},error: function(response,status,error){
				showModal(response.responseText);
			}
		});

	});

	$(document).off('click', '#buttonAddApoderado');
	$(document).on('click', '#buttonAddApoderado', function () {
		/* validar Buton ADD para apoderados */
		var thisbutton = $(this); 
		thisbutton.attr("disabled","disabled");
		console.log('click buttonAddApoderado.');
		var onlyOneRow = false;

		/* Validate mathod input apoderados */
		var valApoderados = validateApoderados("addApo");
		if (valApoderados != "" )
		{
			showModal(valApoderados);
			thisbutton.removeAttr("disabled");
			return;
		}

		var trsApoderados = $("#tableApoderados tbody tr");
		var tdsApoderados = $(trsApoderados).find("td");
		var tdsFirstApoderados = $(trsApoderados).find("td:first-child");
		var tdSelected = 0;
		var tdMax = 0;
		
		if (tdsApoderados.length != 1) {
			tdsFirstApoderados.each(function( index ) {
				console.log( "index: " +  index);
				tdSelected = parseInt($(this).text());
				if (tdSelected > tdMax)
				{
					tdMax = tdSelected;
				}
			});
		} else {
			onlyOneRow = true;
		}
		
		console.log("tdMax: " + tdMax);
		var url = '<?php echo site_url('jugador/addRowApoderado') ?>';

		$.ajax({
			url: url, 
			type: 'POST',
			data:{
				idRow : tdMax + 1,
			},
			success: function(response){
				console.log(response);
				destroyDataTable ("tableApoderados");

				if (onlyOneRow) {
					trsApoderados.remove();
				}

				$("#tableApoderados tbody").append(response);
				loadDataTable("tableApoderados");
				thisbutton.removeAttr("disabled");

			},error: function(response,status,error){
				showModal(response.responseText);
				thisbutton.removeAttr("disabled");
			}
		});
	});

	$(document).off('click', '#buttonAddLesiones');
	$(document).on('click', '#buttonAddLesiones', function () {
		/* validar Buton ADD para apoderados */
		var thisbutton = $(this); 
		thisbutton.attr("disabled","disabled");
		console.log('click buttonAddLesiones.');
		var onlyOneRow = false;

		/* Validate mathod input apoderados */
		var valLesiones = validateLesiones("addLesion");
		if (valLesiones != "" )
		{
			showModal(valLesiones);
			thisbutton.removeAttr("disabled");
			return;
		}

		var tablaLesiones = $("#tablelesiones");
		var trsLesiones = $("#tablelesiones tbody tr");
		var tdsLesiones = $(trsLesiones).find("td");
		var tdsFirstLesion = $(trsLesiones).find("td:first-child");
		var tdSelected = 0;
		var tdMax = 0;
		
		if (tdsLesiones.length != 1) {
			tdsFirstLesion.each(function( index ) {
				console.log( "index: " +  index);
				tdSelected = parseInt($(this).text());
				if (tdSelected > tdMax)
				{
					tdMax = tdSelected;
				}
			});
		} else {
			onlyOneRow = true;
		}
		
		console.log("tdMax: " + tdMax);
		var url = '<?php echo site_url('jugador/addRowLesion') ?>';

		$.ajax({
			url: url, 
			type: 'POST',
			data:{
				idRow : tdMax + 1,
			},
			success: function(response){
				console.log(response);
				destroyDataTable ("tablelesiones");

				if (onlyOneRow) {
					trsLesiones.remove();
				}

				$("#tablelesiones tbody").append(response);

				var fechaLes = false;
				if (tablaLesiones != null && typeof tablaLesiones != "undefined") {
					fechaLes = (tablaLesiones.find("#inputFechaLesion") != null &&  typeof tablaLesiones.find("#inputFechaLesion") != "undefined") ? true : false;
				
				
					if (fechaLes) {
						var options2 =

						{
							container: container,
							todayHighlight: true,
							autoclose: true,
							format: "dd-mm-yyyy",
							language: "es",
							orientation: "auto left",
							clearBtn: true,
						};

						if (tablaLesiones.find("tbody #inputFechaLesion") != null && typeof tablaLesiones.find("tbody #inputFechaLesion") != "undefined") {
							tablaLesiones.find("tbody #inputFechaLesion").datepicker(options2);
						}
					}
				}

				loadDataTable("tablelesiones");
				thisbutton.removeAttr("disabled");

			},error: function(response,status,error){
				showModal(response.responseText);
				thisbutton.removeAttr("disabled");
			}
		});
	});

	function validateAntecedentesPersonales()
	{
		console.log('function validateAntecedentesPersonales.');
		var mensajeerror = "";
		var domPer = $("#idantePersonalesdiv");
		/*******************************************
		** Paso 1: Antecedentes personales
		*******************************************/
		/* field Nombres */
		var nombreJugador = domPer.find("#inputNombres");
		if ( nombreJugador.val().trim() == "" )
		{
			console.log('field Nombres.');
			nombreJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Nombres." + "<br/>";
		}
		else
		{
			nombreJugador.removeClass("error");
		}

		/* field Apellidos */
		var apellidoJugador = domPer.find("#inputApellidos");
		if ( apellidoJugador.val().trim() == "" )
		{
			console.log('field Apellidos.');
			apellidoJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Apellidos." + "<br/>";
		}
		else
		{
			apellidoJugador.removeClass("error");
		}

		/* field Rut */
		var rutJugador = domPer.find("#inputRut");
		var valRut = validateRut(rutJugador);
		if ( rutJugador.val().trim() == "" || valRut != "OK" )
		{
			console.log('field Rut.');
			rutJugador.addClass("error");
			valRut = (typeof valRut == "undefined" || valRut == "") ? "" : "(" + valRut + ")";
			mensajeerror = mensajeerror + "Favor validar el campo Rut. " + valRut + "<br/>";
		}
		else
		{
			rutJugador.removeClass("error");
		}

		/* Imagen */
		var foto_Pefil = domPer.find("#inputFotoPerfil");
		var extentionfile = foto_Pefil.val().split('\\').pop().split('.').pop();
		if (extentionfile == 'jpg' || extentionfile == 'JPG' || extentionfile == 'png' || extentionfile == 'PNG' || extentionfile == '') {
			foto_Pefil.removeClass("error");
		} else {
			foto_Pefil.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Foto Perfil (JPG, PNG)." + "<br/>";
		}

		/* field fecha nacimiento */
		var fechaNacJugador = domPer.find("#fechanacjugador");
		if ( fechaNacJugador.val().trim() == "" )
		{
			console.log('field fecha nacimiento.');
			fechaNacJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Fecha Nacimiento." + "<br/>";
		}
		else if ( false )
		{
			fechaNacJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Fecha Nacimiento (Formato Invalido)." + "<br/>";
		}
		else
		{
			fechaNacJugador.removeClass("error");
		}


		/* Fono contacto */
		var fono_cont = domPer.find("#inputFonoContacto");
		if (fono_cont.val() != "") {
			var lengthFono = fono_cont.val().length;
			if ( 0 < lengthFono && lengthFono < 8){
				fono_cont.addClass("error");
				mensajeerror = mensajeerror + "Favor validar el campo Fono Contacto." + "<br/>";
			} else {
				fono_cont.removeClass("error");
			}
		}

		/* email */
		var email = domPer.find("#inputemail");
		if (email.val() != "") {
			/* validar mail */
			if ( !validateMail(email) )
			{
				console.log("validateMail 1");
				email.addClass("error");
				mensajeerror = mensajeerror + "Favor validar el campo Email." + "<br/>";
			}
			else
			{
				console.log("validateMail 2");
				email.removeClass("error");
			}
		}
		
		/* Direccion */
		var optionSelected = domPer.find("#selectRegion").children(":selected");
        var regioCodeJugador = optionSelected.attr("data-id");

		var direccionComina = domPer.find("#selectComuna");
		var direccionJugador = domPer.find("#inputDireccion");
		if ( typeof regioCodeJugador == "undefined" ) {
			console.log("case 1");
			direccionJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Dirección (Region)." + "<br/>";
		}
		else if ( regioCodeJugador == "1" )
		{
			console.log("case 2");
			direccionJugador.removeClass("error");
		}
		else if ( direccionJugador.val().trim() == "" || direccionComina.text().trim() == "<?php echo lang('seleccione_comuna') ?>")
		{
			console.log("case 3");
			console.log('field Dirección.');
			direccionJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Dirección." + "<br/>";
		}
		else
		{
			console.log("case 4");
			direccionJugador.removeClass("error");
		}

		return mensajeerror;
	}

	function validateApoderados(typeCall) {
		console.log('function validateApoderados.');
		var domApo = $("#idapoderadosdiv");
		/*******************************************
		** Paso 2: Apoderados
		*******************************************/
		var mensajeerror = "";
		var CheckApo = $(domApo).find("#containerCheckApo");
		var trsApoderados = $(domApo).find("#tableApoderados tbody tr").not( ".child");
		var tds = trsApoderados.find("td");
		/* Chack 1: PendiAsingApo */
		/* Chack 2: AsingApo */
		if (trsApoderados.length == 1 || (CheckApo.find("input.Active").attr("id") == "PendiAsingApo")) {
			if (CheckApo.find("input.Active").attr("id") == "PendiAsingApo") {
				/* No validar Apoderados. */
				console.log("no validar Apoderados.");
				$("[name='NivelResponsabilidad']").removeAttr("disabled");
				$("[name='inputNombreApo']").removeAttr("disabled");
				$("[name='inputemailApo']").removeAttr("disabled");
				$("[name='inputFonoApo']").removeAttr("disabled");

				return "";
			} else if (CheckApo.find("input.Active").attr("id") == "AsingApo") {
				if (typeof tds != "undefined" && tds.length > 1)
				{
					/* Validar apoderados */
					console.log("Validar apoderados");
					mensajeerror = mensajeerror + validateRowsApoderados(trsApoderados);
				} else {
					if (typeCall == "addApo") {
						mensajeerror = "";
					} else {
						mensajeerror = mensajeerror + "Debe ingresar un apoderado." + "<br/>";	
					}
				}	
			} else {
				/* Validar rows de la tabla apoderados */
				mensajeerror = mensajeerror + validateRowsApoderados(trsApoderados);
			}
		} else {
			/* Validar rows de la tabla apoderados */
			mensajeerror = mensajeerror + validateRowsApoderados(trsApoderados);
		}
		
		return mensajeerror;
	}

	function validateTipoBeneficio() {
		console.log('function validateTipoBeneficio.');
		var mensajeerror = "";
		var domTipBen = $("#idtipoBeneficiodiv");
		/*******************************************
		** Paso 3: Tipo de Beneficio
		*******************************************/
		/* field Tipo de Beneficio */
		var tipoBeneficio =  $(domTipBen).find("#inputTipBeneficio");
		var optionSelected = tipoBeneficio.children(":selected");
        var codetipben = optionSelected.attr("data-tip-ben");

		if ( tipoBeneficio.val().trim() == "Tipo de Beneficio" )
		{
			console.log('field Dirección.');
			tipoBeneficio.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Tipo de Beneficio." + "<br/>";
		}
		else
		{
			tipoBeneficio.removeClass("error");
		}

		/* field Fecha Inicio  */
		var fechaIniBeneficio =  $(domTipBen).find("#inputFechaIni");
		if (fechaIniBeneficio.val().trim() == "")
		{
			console.log('field DirFecha Inicio Beneficioección.');
			fechaIniBeneficio.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Fecha Inicio Beneficio." + "<br/>";
		}
		else
		{
			fechaIniBeneficio.removeClass("error");
		}

		var observacionBeneficio =  $(domTipBen).find("#inputObservacion");
		var fechaFinBeneficio =  $(domTipBen).find("#inputFechaFin");
		if (mensajeerror == '' && codetipben == 2)
		{
			/* field Fecha Fin Beneficio */
			if (fechaFinBeneficio.val().trim() == "")
			{
				console.log('field DirFecha Inicio Beneficioección.');
				fechaFinBeneficio.addClass("error");
				mensajeerror = mensajeerror + "validar el campo Fecha Fin." + "<br/>";
			}
			else
			{
				fechaFinBeneficio.removeClass("error");
			}

			/* **************************************************
			** Si en este punto no ahi errores validar 
			** que fecha ini sea menor a la fecha fin.
			** ************************************************** */
			if (mensajeerror == '')
			{
				if ( fechaIniBeneficio.val().trim() < fechaFinBeneficio.val().trim())
				{
					/* Quitar error de ambas fechas */
					fechaIniBeneficio.removeClass("error");
					fechaFinBeneficio.removeClass("error");
				}
				else
				{
					/* Agregar error a ambas fechas */
					fechaIniBeneficio.addClass("error");
					fechaFinBeneficio.addClass("error");
					mensajeerror = mensajeerror + "Fecha Inicial Beneficio debe ser menor a Fecha Fin." + "<br/>";
				}
			}

			/* field Obserbaciones Beneficio */
			if (observacionBeneficio.val().trim() == "")
			{
				console.log('field DirFecha Inicio Beneficioección.');
				observacionBeneficio.addClass("error");
				mensajeerror = mensajeerror + "Favor ingresar motivo de la Beca." + "<br/>";
			}
			else
			{
				observacionBeneficio.removeClass("error");
			}
		} else {

			if (fechaFinBeneficio.hasClass("error")) {
				fechaFinBeneficio.removeClass("error");
			}
			
			if (observacionBeneficio.hasClass("error")) {
				observacionBeneficio.removeClass("error");
			}
		}
		
		return mensajeerror;
	}

	function validateAntecedentesJugador()
	{
		console.log('function validateAntecedentesJugador.');
		var mensajeerror = "";
		var domAntJug = $("#idanteJugadordiv");
		/*******************************************
		** Paso 4:  Antecedentes de Jugador
		*******************************************/
		/* field Fecha Ingreso Jugador */
		var fechaIngresoJugador = $(domAntJug).find("#inputingresoClubfecha");
		if ( fechaIngresoJugador.val().trim() == "" )
		{
			console.log('field Fecha Ingreso Jugador.');
			fechaIngresoJugador.addClass("error");
			mensajeerror = mensajeerror + "Favor validar el campo Fecha Ingreso Jugador." + "<br/>";
		}
		else
		{
			fechaIngresoJugador.removeClass("error");
		}

		/* field Número de emergencia */


		/* field Estatura */


		/* field Peso */


		/* field nombre de seguro */


		/* field medicamentos */


		/* field Evaluación Nutricional */


		/* field Alergias */


		/* field Grupo Sanguíneo */


		/* field Tipo Previsión */
		/* field Previsión */
		/*
		si e tipo de prevision es 1 OK
		si es NN malo
		si es mayor a 1   validar el combo dde las previsiones

		si es NN NOK
		si es 1 ok 
		else OK
		*/


		/* field Categoría */
		/* crear validaciòn */
		var selectSelected = domAntJug.find("#inputCategoria");
		var optionSelected = selectSelected.children(":selected");
        var regioCodeCategoria = optionSelected.attr("data-id");

		if ( regioCodeCategoria == "NN" )
		{
			console.log('field categoría Jugador.');
			selectSelected.addClass("error");
			mensajeerror = mensajeerror + "Debe ingresar una Categoría" + "<br/>";
		}
		else
		{
			selectSelected.removeClass("error");
		}

		/* field Posicion en cancha */


		/* field Obserbaciones */

		return mensajeerror;
	}

	function validateLesiones(typeCall)
	{
		console.log('function validateLesiones.');
		var mensajeerror = "";
		var domLes = $("#idlesionesdiv");
		/*******************************************
		** Paso 5: Lesiones
		*******************************************/
		var mensajeerror = "";
		var CheckLesion = $(domLes).find("#containerCheckLesion");
		var trsLesiones = $(domLes).find("#tablelesiones tbody tr").not( ".child");
		var tds = trsLesiones.find("td");
		/* Chack 1: PendiAsingLes */
		/* Chack 2: AsingLes */
		if (trsLesiones.length == 1 || (CheckLesion.find("input.Active").attr("id") == "PendiAsingLes") ) {
			if (CheckLesion.find("input.Active").attr("id") == "PendiAsingLes") {
				/* No validar Lesiones. */
				console.log("no validar Lesiones.");
				$("[name='inputAreaCorporal']").removeAttr("disabled");
				$("[name='inputSegmentoCorporal']").removeAttr("disabled");
				$("[name='inputDiagnostico']").removeAttr("disabled");
				$("[name='inputFechaLesion']").removeAttr("disabled");

				return "";
			} else if (CheckLesion.find("input.Active").attr("id") == "AsingLes") {
				if (typeof tds != "undefined" && tds.length > 1)
				{
					/* Validar Lesiones */
					console.log("Validar Lesiones");
					mensajeerror = mensajeerror + validateRowsLesiones(trsLesiones);
				} else {
					if (typeCall == "addLesion") {
						mensajeerror = "";
					} else {
						mensajeerror = mensajeerror + "Debe ingresar una lesión." + "<br/>";	
					}
				}	
			} else {
				/* Validar rows de la tabla Lesiones */
				mensajeerror = mensajeerror + validateRowsLesiones(trsLesiones);
			}
		} else {
			/* Validar rows de la tabla Lesiones */
			mensajeerror = mensajeerror + validateRowsLesiones(trsLesiones);
		}
		
		return mensajeerror;
	}

	function validateRowsApoderados(trsApoderados) {
		/* recorrer cada uno de las rows de apoderados */
		/* y realziar las validaciónes correspondientes */
		var mensajeerror = "";
		var responsabilidad = 0;
		var nombre = 0;
		var emailtelefono = 0;
		var email = 0;
		var telefono = 0;

		trsApoderados.each(function( index ) {

			/* field Nivel de Responsabilidad */
			var inputNivelResp = $(this).find("td").find("#NivelResponsabilidad");
			console.log('field Nivel de Responsabilidad Apoderados.');
			if ( typeof inputNivelResp != "undefined" )
			{
				if ( inputNivelResp.val().trim() == "<?php echo lang('seleccione_responsabilidad') ?>" )
				{
					inputNivelResp.addClass("error");
					responsabilidad+=1;
				}
				else
				{
					inputNivelResp.removeClass("error");
				}
			}

			/* field nombre Apoderados */
			var inputNombre = $(this).find("td").find("#inputNombreApo");
			console.log('field nombre Apoderados.');
			if ( typeof inputNombre != "undefined" )
			{
				if ( inputNombre.val().trim() == "" )
				{
					inputNombre.addClass("error");
					nombre+=1;
				}
				else
				{
					inputNombre.removeClass("error");
				}
			}

			/* field Email del Apoderado */
			var inputEmail = $(this).find("td").find("#inputemailApo");
			var inputFono = $(this).find("td").find("#inputFonoApo");
			if ( (typeof inputEmail != "undefined" && inputEmail.val().trim() == "") && (typeof inputFono != "undefined" && inputFono.val().trim() == "") ) {
				emailtelefono+=1;
				inputEmail.addClass("error");
				inputFono.addClass("error");
			} else if ( (typeof inputEmail != "undefined" && inputEmail.val().trim() != "") && (typeof inputFono != "undefined" && inputFono.val().trim() != "") ) {
				if ( typeof inputEmail != "undefined" )
					{
						if (typeof inputEmail != "undefined" && inputEmail.val().trim() != "") {
							if ( !validateMail(inputEmail) ) {
								console.log("validateMail 1");
								inputEmail.addClass("error");
								email+=1;
							}
							else {
								console.log("validateMail 2");
								inputEmail.removeClass("error");
							}
						}
					}

					if (typeof inputFono != "undefined" && inputFono.val().trim() != "") {
						var lengthFono = inputFono.val().length;
						if ( 0 < lengthFono && lengthFono < 8){
							inputFono.addClass("error");
							telefono+=1;
						} else {
							inputFono.removeClass("error");
						}
					}

			} else {
				if (typeof inputEmail != "undefined" && inputEmail.val().trim() != "") {
					/* field email Apoderado */
					inputFono.removeClass("error");
					if ( typeof inputEmail != "undefined" )
					{
						if (typeof inputEmail != "undefined" && inputEmail.val().trim() != "") {
							if ( !validateMail(inputEmail) ) {
								console.log("validateMail 1");
								inputEmail.addClass("error");
								email+=1;
							}
							else {
								console.log("validateMail 2");
								inputEmail.removeClass("error");
							}
						}
					}
				}else if (typeof inputFono != "undefined" && inputFono.val().trim() != "") {
					/* field email Apoderado */
					inputEmail.removeClass("error");
					if (typeof inputFono != "undefined" && inputFono.val().trim() != "") {
						var lengthFono = inputFono.val().length;
						if ( 0 < lengthFono && lengthFono < 8){
							inputFono.addClass("error");
							telefono+=1;
						} else {
							inputFono.removeClass("error");
						}
					}
				}
			}

		});
		
		if (responsabilidad > 0) {
			mensajeerror = mensajeerror + "Validar campo de Responsabilidad Apoderado." + "<br/>";
		}

		if (nombre > 0) {
			mensajeerror = mensajeerror + "Favor validar el campo Nombre Apoderado." + "<br/>";
		}

		if (emailtelefono > 0 ) {
			mensajeerror = mensajeerror + "Es obligatorio el <b>E-mail</b> o el <b>teléfono</b>" + "<br/>";
		} else {
			if (telefono > 0) {
				mensajeerror = mensajeerror + "Favor validar el campo Fono Apoderado." + "<br/>";
			}

			if (email > 0) {
				mensajeerror = mensajeerror + "Favor validar el campo Email." + "<br/>";
			}
		}

		return mensajeerror;
	}

	function validateRowsLesiones(trsLesiones) {
		/* recorrer cada uno de las rows de lesiones */
		/* y realziar las validaciónes correspondientes */
		var mensajeerror = "";
		var tipLesion = 0;
		var areaCorporal = 0;
		var segCorporal = 0;
		var diagnostico = 0;
		var fecha = 0;

		trsLesiones.each(function( index ) {

			/* field Tipo de Lesión */
			var inputTipLesion = $(this).find("td").find("#inputTipoDeLesiones");
			console.log('field Área Corporal Lesiones.');
			if ( typeof inputTipLesion != "undefined" )
			{
				if ( inputTipLesion.val().trim() == "<?php echo lang('seleccione_Tipo_Lesión') ?>" )
				{
					inputTipLesion.addClass("error");
					tipLesion+=1;
				} else {
					inputTipLesion.removeClass("error");
				}
			}

			/* field Area Corporal */
			var inputAreaCorp = $(this).find("td").find("#inputAreaCorporal");
			console.log('field Área Corporal Lesiones.');
			if ( typeof inputAreaCorp != "undefined" )
			{
				if ( inputAreaCorp.val().trim() == "<?php echo lang('seleccione_Area_Corporal') ?>" )
				{
					inputAreaCorp.addClass("error");
					areaCorporal+=1;
				} else {
					inputAreaCorp.removeClass("error");
				}
			}

			/* field Segmento Corporal */
			var inputSegCorp = $(this).find("td").find("#inputSegmentoCorporal");
			console.log('field Segmento Corporal Lesiones.');
			if ( typeof inputSegCorp != "undefined" )
			{
				if ( inputSegCorp.val().trim() == "<?php echo lang('seleccione_Segmento_Corporal') ?>" )
				{
					inputSegCorp.addClass("error");
					segCorporal+=1;
				} else {
					inputSegCorp.removeClass("error");
				}
			}

			/* field Diagnostico */
			var diagnosticoLesion = $(this).find("td").find("#inputDiagnostico");
			if ( diagnosticoLesion.val().trim() == "" )
			{
				console.log('field Apellidos.');
				diagnosticoLesion.addClass("error");
				diagnostico+=1;
			} else {
				diagnosticoLesion.removeClass("error");
			}

			/* field Fecha Lesion */
			var fechaLesion = $(this).find("td").find("#inputFechaLesion");
			if ( fechaLesion.val().trim() == "" )
			{
				console.log('field fecha nacimiento.');
				fechaLesion.addClass("error");
				fecha+=1;
			} else {
				fechaLesion.removeClass("error");
			}

		});
		
		if (tipLesion > 0) {
			mensajeerror = mensajeerror + "Validar campo de Tipo de Lesión." + "<br/>";
		}

		if (areaCorporal > 0) {
			mensajeerror = mensajeerror + "Validar campo de Área Corporal." + "<br/>";
		}

		if (segCorporal > 0) {
			mensajeerror = mensajeerror + "Favor validar el campo Segmento Corporal." + "<br/>";
		}

		if (diagnostico > 0) {
			mensajeerror = mensajeerror + "Favor validar el campo Diagnostico." + "<br/>";
		}

		if (fecha > 0) {
			mensajeerror = mensajeerror + "Favor validar el campo Fecha Lesion." + "<br/>";
		}

		return mensajeerror;
	}

	/*******************************************
	**      Button Step Section
	*******************************************/
	$(document).off('click', '#butonPaso1');
	$(document).on('click', '#butonPaso1', function () {
		console.log('click butonPaso1.');
		$(".nav.nav-tabs li a").addClass("disabled");
		$('#tabidantePersonales').removeClass("disabled");
		$('#tabidantePersonales').click();
	});

	$(document).off('click', '#butonPaso2');
	$(document).on('click', '#butonPaso2', function () {
		console.log('click butonPaso2.');
		/* Cerar validaciòn de input para gusrdar registro jugador */
		var errorAntPer = validateAntecedentesPersonales();
		if ( errorAntPer != "" )
		{
			showModal(errorAntPer);
			return;
		}
		
		$(".nav.nav-tabs li a").addClass("disabled");
		/*$('#tabidapoderados').removeClass("disabled");
		$('#tabidapoderados').click();*/
		$('#tabidanteJugador').removeClass("disabled");
		$('#tabidanteJugador').click();
	});

	$(document).off('click', '#butonPaso5');
	$(document).on('click', '#butonPaso5', function () {
		console.log('click butonPaso5.');
		/* validaciòn de input para gusrdar registros de apoderados jugador */
		var errorAntPer = "";

		if ($("#PendiAsingApo").hasClass("Active"))
		{
			/* Pasar al paso 4 sin validar campos */
			$(".nav.nav-tabs li a").addClass("disabled");
			$('#tabidlesiones').removeClass("disabled");
			$('#tabidlesiones').click();
		}
		else if ($("#AsingApo").hasClass("Active"))
		{
			var errorAntPer = validateApoderados("");
			if ( errorAntPer != "" )
			{
				showModal(errorAntPer);
				return;
			}
			$(".nav.nav-tabs li a").addClass("disabled");
			$('#tabidlesiones').removeClass("disabled");
			$('#tabidlesiones').click();
		}
	});

	$(document).off('click', '#butonPaso4');
	$(document).on('click', '#butonPaso4', function () {
		console.log('click butonPaso4.');
		/* Cerar validaciòn de input para gusrdar registro jugador */
		var errorAntPer = validateTipoBeneficio();
		if ( errorAntPer != "" )
		{
			showModal(errorAntPer);
			return;
		}

		$(".nav.nav-tabs li a").addClass("disabled");
		/*$('#tabidanteJugador').removeClass("disabled");
		$('#tabidanteJugador').click();*/
		$('#tabidapoderados').removeClass("disabled");
		$('#tabidapoderados').click();
	});

	$(document).off('click', '#butonPaso3');
	$(document).on('click', '#butonPaso3', function () {
		console.log('click butonPaso3.');
		/* Cerar validaciòn de input para gusrdar registro jugador */
		var errorAntPer = validateAntecedentesJugador();
		if ( errorAntPer != "" )
		{
			showModal(errorAntPer);
			return;
		}

		$(".nav.nav-tabs li a").addClass("disabled");

		/*$('#tabidlesiones').removeClass("disabled");
		$('#tabidlesiones').click();*/
		$('#tabidtipoBeneficio').removeClass("disabled");
		$('#tabidtipoBeneficio').click();
	});

	/*******************************************
	**      Button Tabs Section
	*******************************************/
	$(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
		console.log('click .nav-tabs a[data-toggle=tab].');
		if ($(this).hasClass("disabled"))
		{
			/* $('#tabidapoderados').addClass("disabled"); */
			$('.nav.nav-tabs li a').addClass("disabled");
			e.preventDefault();
			return false;
		}
	});

	$(document).off('click', '#tabidantePersonales');
	$(document).on('click', '#tabidantePersonales', function () {
		console.log('click tabidantePersonales.');
		$('#tabidantePersonales').addClass("activetab");
		/* Cerar validaciòn de input para gusrdar registro jugador */
		/*var errorAntPer = validateAntecedentesPersonales();
		if ( errorAntPer != "" ) {
			$("#myModal").find(".modal-body").html("");
			$("#myModal").find(".modal-body").html(errorAntPer);
			$("#myModal").modal();
			return;
		}

		if ($('#tabidapoderadosdiv').hasClass("activetab")) {

		}

		$('#tabidapoderadosdiv').click();*/
	});

	$(document).off('keypress', 'form');
	$(document).on('keypress', 'form', function (e) {
		console.log('keypress form.');
		if (e.keyCode == 13)
		{               
			e.preventDefault();
			return false;
		}
	});

	function parseDate(value)
	{
		var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
		if (m)
		{
			value = ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2) + '-' + m[5];
		}
		return value;
    }

    function getApoderados() {
		var domApo = $("#idapoderadosdiv");
		/* var trsApoderados = domApo.find("[name=trApo]"); */
		var CheckApo = $(domApo).find("#containerCheckApo");
		/* rescatar la table apoderados 
		 recorrer cada uno de los TR
		 generar objeto Apoderado 
		 guardar objeto apoderado en array Apoderados*/

		var resultApo = new Array();
		var trTableApo = domApo.find('#tableApoderados tbody tr');

		if (trTableApo.length == 1 
			&& trTableApo.find('td').length == 1 
			|| CheckApo.find("input.Active").attr("id") == "PendiAsingApo")
		{
			/* Objeto vacio */
			resultApo.push({
					"ResponsabilidadApoderado"   :"",
					"NomApoderado"               :"",
					"EmailApoderado"             :"",
					"FonoApoderado"              :"",
				});
		}
		else
		{
			/* recorrer los tr buscado cada apoderado. */
			trTableApo.each(function( index ) {
				/* console.log( "index: " +  index); */
				var tdSelected = parseInt($(this).text());
				resultApo.push({
						"ResponsabilidadApoderado"   :$(this).find("#NivelResponsabilidad").attr("date-code-nvlresp").trim(),
						"NomApoderado"               :$(this).find("#inputNombreApo").val().trim(),
						"EmailApoderado"             :$(this).find("#inputemailApo").val().trim(),
						"FonoApoderado"              :$(this).find("#inputFonoApo").val().trim(),
				});
			});

		}

		return resultApo;
	}

	function getLesiones() {
		var domLes = $("#idlesionesdiv");
		var CheckApo = $(domLes).find("#containerCheckLesion");
		/* rescatar la table lesiones 
		recorrer cada uno de los TR
		generar objeto Apoderado 
		guardar objeto apoderado en array Lesiones */

		var resultApo = new Array();
		var trTableLes = domLes.find('#tablelesiones tbody tr');

		if ( trTableLes.length == 1 
			&& trTableLes.find('td').length == 1 
			|| (CheckApo.find("input.Active").attr("id") == "PendiAsingLes") )
		{
			/* Objeto vacio */
			resultApo.push({
					"tipoLesion"       :"",
					"areaCorporal"     :"",
					"segmentoCorporal" :"",
					"diagnostico"      :"",
					"fechaLesion"      :"",
				});
		} else {
			/* recorrer los tr buscado cada apoderado. */
			trTableLes.each(function( index ) {
				/* console.log( "index: " +  index); */
				var tdSelected = parseInt($(this).text());
				resultApo.push({
						"tipoLesion"       :$(this).find("#inputTipoDeLesiones").attr("date-code-tiples").trim(),
						"areaCorporal"     :$(this).find("#inputAreaCorporal").attr("date-code-data-child").trim(),
						"segmentoCorporal" :$(this).find("#inputSegmentoCorporal").attr("date-code-segcorp").trim(),
						"diagnostico"      :$(this).find("#inputDiagnostico").val().trim(),
						"fechaLesion"      :formatDate($(this).find("#inputFechaLesion")),
				});
			});

		}

		return resultApo;
	}

</script>