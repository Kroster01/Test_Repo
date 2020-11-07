
function showModal(errorMessage) {
	$("#myModal").find(".modal-body").html("");
	$("#myModal").find(".modal-body").html(errorMessage);
	$("#myModal").modal();
}

function validateRut(element) {
	var outRut = "";
	var textRut = $(element).val().trim();
	if (textRut != "") {
		outRut =  Rut(textRut);
	}
	return outRut;
}

function formatRut(element) {
	var outRut = "";
	var textRut = $(element).val().trim();
	if (textRut != "") {
		outRut =  rutFormat(textRut);
		if (outRut != "") {
			$(element).val(outRut);
		}
	}
}

function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				element.attr("name",$(this).attr("name"));

				element.change(function(){
					var extentionfile = element.val().split('\\').pop().split('.').pop();
					element.next(element).find('input').val((element.val()).split('\\').pop());
				});

				$(this).find("button.btn-choose").click(function(){
					element.click();
				});

				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});

				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});

				return element;
			}
		}
	);
}

function formatDate(fecha) {
	/* format Ini: MM-YYYY */
	var fechaOut = "";
	if (typeof fecha == "undefined" || fecha.val().trim() == "") {
		return fechaOut; 
	} else {
		
		var arrayfecha = fecha.val().trim().split("-");
		if (arrayfecha.length == 3) {
			/* format Out: YYYY-MM-DD */
			fechaOut = arrayfecha[2] + "-" + arrayfecha[1] + "-" + arrayfecha[0];
		} else if (arrayfecha.length == 2) {
			/* format Out: YYYY-MM */
			fechaOut = arrayfecha[1] + "-" + arrayfecha[0] + "-01";
		}
		else {
			fechaOut = "";
		}
		
		return fechaOut;
	}
}

function validateKCRut(event) {
	var evkC = event.keyCode;
	if ( ( evkC == 75 || evkC == 107)){
		event.returnValue = true;
	} else if ( (evkC < 45 || evkC > 57) ) {
		event.returnValue = false;
	}
}

function clean_ComboBootstrap(container,value,paramDisabled) {
	console.log('function clean_ComboBootstrap.');
	var lengthli = container.find("li").length;
	if (lengthli > 0) {
		container.closest("div").find("button").text(value);
		container.empty();
	}

	if ( paramDisabled ) {
		container.closest("div").find("button").attr('disabled','disabled');
	} else {
		container.closest("div").find("button").removeAttr('disabled');
	}

}

function clean_Select(container,value,paramDisabled) {
	console.log('function clean_Select.');
	var lengthoptions = container.find("option").length;
	/*if (lengthoptions > 1)
	{
		container.empty();
		container.append('<option selected hidden class="wpor90" data-id="NN">' + value + '</option>');
	}*/

	if ( paramDisabled )
	{
		container.empty();
		container.append('<option selected hidden class="wpor90" data-id="NN">' + value + '</option>');
		container.attr('disabled','disabled');
	}
	else
	{
		container.removeAttr('disabled');
	}

}

function clean_InputBootstrap(container,paramDisabled) {
	console.log('function clean_InputBootstrap.');
	var inttext = container.val();
	if (inttext != "" || paramDisabled) {
		container.val("");
	}

	if ( paramDisabled ) {
		container.attr('disabled','disabled');
	} else {
		container.removeAttr('disabled');
	}
}

function soloLetras(e) {
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-'";
	especiales = [8, 37, 39, 46];

	tecla_especial = false
	for(var i in especiales) {
		if(key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}

	if(letras.indexOf(tecla) == -1 && !tecla_especial)
		return false;
}

function soloNumeros(event) {
	var ev = event.keyCode;
	if ( (ev < 45 || ev > 57) ) {
		event.returnValue = false;
	}
}

function validateMail (element) {
	var email = element.val();
	if (email != "" || typeof email == "undefined") {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(email)) {
			console.log("correo invalido");
			return false;
		} else {
			console.log("correo valido");
			return true;
		}
	}
}

function destroyDataTable (tableName) {
	console.log('function destroyDataTable.');
	$("#"+ tableName).DataTable().destroy();
}

function loadDataTable(tableName) {
	console.log('function loadDataTable.');

	var table = $("#"+ tableName).DataTable({
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
		dom: '<lf><tr>ip',
		sPaginationType: "full_numbers",
		responsive: true,					
	});

	table.buttons().container().appendTo( '#' + tableName + '_wrapper .col-sm-6:eq(0)' );
}

function nullOrUndefined(element)
{
	if (element == null || typeof element == "undefined") {
		return true;
	} else {
		return false;
	}
}

function nullOrEmpty(element)
{
	if (element == null || element.empty()) {
		return true;
	} else {
		return false;
	}
}

function nullOrEmptyString(element)
{
	if (element == null || element != "") {
		return true;
	} else {
		return false;
	}
}

/* Funcionalidad de Drop Down */
$(document).ready(function() {

});
