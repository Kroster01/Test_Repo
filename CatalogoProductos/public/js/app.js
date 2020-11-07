$(document).ready(function() {

});

function showModal(errorMessage) {
	$("#myModal").find(".modal-body").html("");
	$("#myModal").find(".modal-body").html(errorMessage);
	$("#myModal").modal();
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
		dom: '<"mb15"B><lf><tr>ip',
		sPaginationType: "full_numbers",
		responsive: true,					
	});

}

function validateMail (element) {
	var email = element.val();
	if (email != "" || typeof email == "undefined") {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(email)) {
			return false;
		} else {
			return true;
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
					var typeDoc = $(this).closest("div").find("input.form-control").attr("typeDoc");

					var fileName = this.files[0].name;
					var fileSize = this.files[0].size;

					if (typeDoc == "image") {
						if(fileSize > 3000000){
							//console.log('El archivo no debe superar los 3MB');
							this.value = '';
							showModal('El archivo no debe superar los 3MB.');
						}else{
							// recuperamos la extensión del archivo
							var extentionfile = element.val().split('\\').pop().split('.').pop();
	
							if (extentionfile == 'jpg' || extentionfile == 'JPG' || extentionfile == 'png' || extentionfile == 'PNG' || extentionfile == 'jpeg' || extentionfile == 'JPEG' || extentionfile == '') {
								element.next(element).find('input').val((element.val()).split('\\').pop());
							} else {
								this.value = '';
								showModal('El archivo no tiene la extensión adecuada (jpg, jpeg o png).');
							}
						}
					} else if (typeDoc == "doc") {
						var extentionfile = element.val().split('\\').pop().split('.').pop();
	
						if (extentionfile == 'doc' || extentionfile == 'DOC' || extentionfile == 'pdf' || extentionfile == 'PDF' || extentionfile == '') {
							element.next(element).find('input').val((element.val()).split('\\').pop());
						} else {
							this.value = '';
							showModal('El archivo no tiene la extensión adecuada (doc o pdf).');
						}
					} else {
						this.value = '';
							showModal('El archivo seleccionado no es compatible con le campo.');
					}

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

//function monedaChange (cif = 3, dec = 2) {
function monedaChange (element) {
	// tomamos el valor que tiene el input
	let inputNum = document.getElementById('monedaInput').value
	// Lo convertimos en texto
	inputNum = inputNum.toString()
	// separamos en un array los valores antes y después del punto
	inputNum = inputNum.split('.')
	// evaluamos si existen decimales
	if (!inputNum[1]) {
		inputNum[1] = '00'
	}
	
	let separados
	// se calcula la longitud de la cadena
	if (inputNum[0].length > cif) {
		let uno = inputNum[0].length % cif
		if (uno === 0) {
		separados = []
		} else {
		separados = [inputNum[0].substring(0, uno)]
		}
		let posiciones = parseInt(inputNum[0].length / cif)
		for (let i = 0; i < posiciones; i++) {
		let pos = ((i * cif) + uno)
		console.log(uno, pos)
		separados.push(inputNum[0].substring(pos, (pos + 3)))
		}
	} else {
		separados = [inputNum[0]]
	}
	
	document.getElementById('monedaInput').value = '$' + separados.join(',') + '.' + inputNum[1]
}
