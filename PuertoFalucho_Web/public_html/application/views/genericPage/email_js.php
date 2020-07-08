<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">

$(document).off('click', '#submitMail');
$(document).on('click', '#submitMail', function (e)
{
	e.preventDefault();
	var dataUrl = $(this).attr("data-url");
	var nombreVal = "";
	var emailVal = "";
	var selectMotivoVal = "";
	var celularVal = "";
	var textMensajeVal = "";

	/*showModal("En estos Momentos no hemos pordido completar su solicitud.");
	return;*/

	var responseValide = validaMaulContact();// matodo que valide los campos.

	if ( responseValide != "" ) {
		showModal(responseValide);
		//alert(responseValide);
		return;
	}

	var formData = new FormData();
	formData.append("nombre", $("#input-10").val().trim());
	formData.append("correo", $("#input-11").val().trim());
	formData.append("motivoContacto", $("#w3_agileits_select").children(":selected").val().trim());
	formData.append("celular", $("#input-12").val().trim());
	formData.append("mensaje", $("#textAreaMensaje").val().trim());

	// Realizar envio de correo.
	$.ajax({
		url: dataUrl, 
		type: 'POST',
		processData: false,
		contentType: false,
		data: formData,
		success: function(response)
		{
		    var result = null;
		    try {
                result = jQuery.parseJSON( response );
            }
            catch(err) {
                showModal("<?php echo lang('genericErrorJQ') ?>"); 
				console.log(err.message);
				return;
            }

			if (result.Error) {
				showModal(result.ErrorMessage);
				console.log(result.DebuggerLog);
				return;
			}
            
            cleanContactForm();
			showModal(result.Message);

		},error: function(response,status,error){
			console.log(response.responseText);
			showModal("En estos Momentos no hemos pordido completar su solicitud.");
		}
	});

});

function cleanContactForm () {
	$("#input-10").val("");
	$("#input-11").val("");
	//$("#w3_agileits_select").children(":selected").val().trim());
	$("#w3_agileits_select :selected").remove();
	$("#input-12").val("");
	$("#textAreaMensaje").val("");
}

function validaMaulContact()
{
	var mensajeerror = "";
	
	/* Nombre */
	var nombre = $("#input-10");
	if (typeof nombre[0] != 'undefined') {
		if (nombre.val() == "") {
			mensajeerror += "Validar Nombre destinatario." + "<br/>";
		}
	}

	/* Email */
	var email = $("#input-11");
	if (typeof email[0] != 'undefined') {
		if (email.val().trim() != "") {
			if ( !validateMail(email) ) {
				mensajeerror += "Validar Email." + "<br/>";
			}
		} else {
			mensajeerror += "Validar Correo Electr&oacute;nico." + "<br/>";
		}
	}

	/* Motivo */
	var selectMotivo = $("#w3_agileits_select");
	var optionSelected = selectMotivo.children(":selected");
	var codeMotivo = optionSelected.val();
	if (codeMotivo.trim() == "NN") {
		mensajeerror += "Validar Selecci&oacute;n de Motivo." + "<br/>";
	}

	/* Celular */
	var celular = $("#input-12");
	if (typeof celular[0] != 'undefined') {
		if (celular.val() != "") {
			var lengthFono = celular.val().length;
			if ( 0 < lengthFono && lengthFono < 8){
				mensajeerror = mensajeerror + "Validar Numero de Celular." + "<br/>";
			}
		} else {
			mensajeerror += "Validar Numero de Celular." + "<br/>";
		}
	}

	/* Mensaje */
	var textMensaje = $("#textAreaMensaje");
	if (typeof textMensaje[0] != 'undefined') {
		if (textMensaje.val() == "") {
			mensajeerror += "Validar la descripci&oacute;n de la solicitud." + "<br/>";
		}
	}
	
	return mensajeerror;
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

function solonumeros(evento) 
{  
	if(evento.ctrlKey)   
	{ /* alert("Hizo CRTL") */
		evento.returnValue = false;
		evento.preventDefault();
		return false;
	}
	else
	{ // 
		var key;
		if(window.event) {// IE
			key = evento.keyCode;
		} else if(evento.which) { // Netscape/Firefox/Opera
			key = evento.which;
		}

		if ( isNaN(parseFloat(evento.key)) && evento.key != "Backspace" )  {
			evento.returnValue = false;
			evento.preventDefault();
			return false;
		}	
		
		return true;
	}
}

function showModal(errorMessage) {
	$("#myModal").find(".modal-body").html("");
	$("#myModal").find(".modal-body").html(errorMessage);
	$("#myModal").modal();
}

</script>
