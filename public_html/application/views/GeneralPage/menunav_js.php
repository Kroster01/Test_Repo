<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript" >

    $(document).ready(function()
    {
        console.log('Menu Nav PHP..' + '<?php echo $header ?>' +'..');
    });

    function reLoadFunctionPageJugador()
    {
		console.log('function reLoadFunctionPageJugador.');

		var options =
        {
			container: container,
			todayHighlight: true,
			autoclose: true,
			format: "mm-yyyy",
			startView: 1,
			minViewMode: 1,
			language: "es",
			orientation: "auto left",
			clearBtn: true,
		};

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

		$("#fechanacjugador").datepicker(options2);
		$("#fechaingresojugador").datepicker(options);
		$("#inputFechaIni").datepicker(options);
		$("#inputFechaFin").datepicker(options);
		$("#inputingresoClubfecha").datepicker(options);
        $("#inputFechaLesion").datepicker(options2);
        var selectedRegion = $('#selectRegion');
        selectedRegion.select2();
        var seleted2Span = selectedRegion.closest("div").find("span.select2-container");
        seleted2Span.removeAttr("style");
        seleted2Span.addClass("wpor90");
        seleted2Span.addClass("textalignleft");
        seleted2Span.find("span.select2-selection").addClass("height34i");

		bs_input_file();

		destroyDataTable("tableApoderados");
		loadDataTable("tableApoderados");

        destroyDataTable("tablelesiones");
		loadDataTable("tablelesiones");
	}

    function reLoadFunctionPageCuotas()
    {
		console.log('function reLoadFunctionPageCuotas.');

		var options =
        {
			container: container,
			todayHighlight: true,
			autoclose: true,
			format: "mm-yyyy",
			startView: 1,
			minViewMode: 1,
			language: "es",
			orientation: "auto left",
			clearBtn: true,
		};

		$("#fechainicuota").datepicker(options);
		$("#fechafincuota").datepicker(options);

		destroyDataTable("tableBuscarCuota");
        loadDataTable("tableBuscarCuota");
    }
    
    $(document).off('click', '.dropdown-menu.menu-nav li a');
    $(document).on('click', '.dropdown-menu.menu-nav li a', function ()
    {
        console.log('dropdown-menu menu-nav');
        var selText = $(this).text();
        var classTab = $(this).attr("class");
        console.log(classTab);
        var url =  returnUrlNav(classTab);
        
        if (url == "")
        {
            return;
        }

        $.ajax({
            url: url, 
            type: 'POST',
            data:{},
            success: function(response)
            {
                $("#contenido").html(response);
                if (classTab == 'RegistrarJugador')
                {
                    reLoadFunctionPageJugador();
                }
                else if (classTab == 'BuscarJugador')
                {
                    destroyDataTable("tableBuscarJugador");
                    loadDataTable("tableBuscarJugador");
                }
                else if (classTab == 'BuscarCuotas')
                {
                    reLoadFunctionPageCuotas();
                }

            },error: function(response,status,error)
            {
                console.log('error button nav menu');
                showModal(response.responseText);
            }
        });
    });

    /* Manu Home */
    $(document).off('click', '#menuNavHome');
    $(document).on('click', '#menuNavHome', function ()
    {
        console.log('menuNavHome');
        var selText = $(this).text();
        var classTab = $(this).attr("class");
        var NameTab = $(this).attr("name");
        console.log(NameTab);
        var url =  returnUrlNav(NameTab);
        
        if (url == "")
        {
            return;
        }

        $.ajax({
            url: url, 
            type: 'POST',
            data:{},
            success: function(response)
            {
                $("#contenido").html(response);
            },error: function(response,status,error){
                console.log('error button nav menu');
                showModal(response.responseText);
            }
        });
    });

    function returnUrlNav($nemaTab) {
        /* Jugador */
        if ($nemaTab == "RegistrarJugador") {
            return '<?php echo site_url('jugador/index') ?>';
        } 
        else if ($nemaTab == "RegistrarJugador") {
            return '<?php echo site_url('jugador/RegistrarJugador') ?>';
        } 
        else if ($nemaTab == "BuscarJugador") {
            return '<?php echo site_url('jugador/BuscarJugador') ?>';
        }
        else if ($nemaTab == "AsistenciaJugadores") {
            return '<?php echo site_url('jugador/AsistenciaJugadores') ?>';
        }
        else if ($nemaTab == "ModificarJugador") {
            return '<?php echo site_url('jugador/ModificarJugador') ?>';
        }
        else if ($nemaTab == "EliminarJugador") {
            return '<?php echo site_url('jugador/EliminarJugador') ?>';
        }
        /* Beneficios */
        else if ($nemaTab == "ModificarBeneficio") {
            return '<?php echo site_url('GestionBeneficios/ModificarBeneficio') ?>';
        }
        else if ($nemaTab == "BuscarBeneficio") {
            return '<?php echo site_url('GestionBeneficios/BuscarBeneficio') ?>';
        }
        /* Lesion */
        else if ($nemaTab == "RegistrarLesion") {
            return '<?php echo site_url('lesiones/RegistrarLesion') ?>';
        }
        else if ($nemaTab == "ModificarLesion") {
            return '<?php echo site_url('lesiones/ModificarLesion') ?>';
        }
        /* Cuotas Social */
        else if ($nemaTab == "RegistrarCuotas") {
            return '<?php echo site_url('cuotaSocial/RegistrarCuotas') ?>';
        }
        else if ($nemaTab == "BuscarCuotas") {
            return '<?php echo site_url('cuotaSocial/BuscarCuotas') ?>';
        }
        else if ($nemaTab == "ModificarCuotas") {
            return '<?php echo site_url('cuotaSocial/ModificarCuotas') ?>';
        }
         /* RucamanqueHome */
         else if ($nemaTab == "RucamanqueHome") {
            return '<?php echo site_url('WelcomeRucamanque/reLoadIndex') ?>';
        }
         else {
            return '';
        }
    }
</script>