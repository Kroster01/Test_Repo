<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript" >

	$(document).off('click', '#BuscarCuota');
	$(document).on('click', '#BuscarCuota', function () {
		console.log('click BuscarCuota.');
		var url = '<?php echo site_url('CuotaSocial/searchCuotasSociales') ?>';

		var objCuotaSocial =
		{
			"Nombre"          : $("#inputNombres").val().trim(),
			"Apellido"        : $("#inputApellidos").val().trim(),
			"Rut"             : $("#inputRut").val().trim(),
            "Categoria"       : (typeof $("#inputCategoria").attr("date-code-cate") == "undefined" || $("#inputCategoria").attr("date-code-cate") == "") ? "0" : $("#inputCategoria").attr("date-code-cate"),
            "FechaIni"        : (typeof $("#fechainicuota") == "undefined" || $("#fechainicuota").val().trim() == "") ? "" : "01-" + $("#fechainicuota").val().trim(),
            "FechaFin"        : (typeof $("#fechafincuota") == "undefined" || $("#fechafincuota").val().trim() == "") ? "" : "01-" + $("#fechafincuota").val().trim(),
		};

		var searchCuotasSociales = JSON.stringify(objCuotaSocial);

		$.ajax({
			url: url, 
			type: 'POST',
			data:{
				searchCuotasSociales : searchCuotasSociales,
			},
			success: function(response){
				console.log(response);
				var obj = JSON.parse(response);

				destroyDataTable ("tableBuscarCuota");

				var table = $("#tableBuscarCuota").DataTable({
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
							//"extend": 'excel',
							"extend": 'excelHtml5',
							"title": 'Lista Jugadores',
							"text": '&nbsp;&nbsp;&nbsp;Excel',
							"className": 'btn btn-primary btn-xs fa fa-file-excel-o pl15 pr15 pt10 pb10 fontsize18'
						},
						{
							//"extend": 'pdf',
							"extend": 'pdfHtml5',
							"title": 'Lista Jugadores',
							"text": '&nbsp;&nbsp;&nbsp;PDF',
							"className": 'btn btn-primary btn-xs fa fa-file-pdf-o pl15 pr15 pt10 pb10 fontsize18'
						},
					],
					data: JSON.parse(response),
					columns: [
						{ data: "NOMBRE", className: "text-center" },
						{ data: "PER_RUT", className: "text-center" },
						{ data: "CCS_MONTO_PAGO", className: "text-center" },
						{ data: "CCS_PERIODO_PAGO", className: "text-center" },
						{ data: "CAT_DESC_CATEGORIA", className: "text-center" },
						{ data: "APODERADOS", className: "text-center" }
                    ]
				});
 
				table.buttons().container().appendTo( '#tableBuscarCuota_wrapper .col-sm-6:eq(0)' );

			},error: function(response,status,error){
				showModal(response.responseText);
			}
		});

	});

</script>