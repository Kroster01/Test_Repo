<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<form action="" method="POST" id="formId" class="form-horizontal">
	<div class="container col-md-12 pb20">
		<div class="row">
			<div class="col-md-12">
				<!--<h3>Tabs</h3>-->
				<!-- tabs -->
				<div class="tabbable">
					<ul class="nav nav-tabs" style="display: none;">
						<li class="active"><a id="tabidantePersonales" href="#idantePersonalesdiv" data-toggle="tab" class="disabled">Antecedentes personales</a></li>
						<li><a id="tabidanteJugador" href="#idanteJugadordiv" data-toggle="tab" class="disabled">Antecedentes de Jugador</a></li>
						<li><a id="tabidtipoBeneficio" href="#idtipoBeneficiodiv" data-toggle="tab" class="disabled">Tipo de Beneficio</a></li>
						<li><a id="tabidapoderados" href="#idapoderadosdiv" data-toggle="tab" class="disabled">Apoderados</a></li>
						<<li><a id="tabidlesiones" href="#idlesionesdiv" data-toggle="tab" class="disabled">Lesiones</a></li>
					</ul>
					<div class="tab-content">
						<?php
							// Paso 1: Antecedentes personales
							$data['regiones'] = $regiones;
							$this->load->view("jugador/steps/Paso1", $data)
						?>
						
						<?php
							// Paso 2:  Antecedentes de Jugador
							$data3['TipePrevision'] = $TipePrevision;
							$data3['gruposanguineos'] = $gruposanguineos;
							$data3['categorias'] = $categorias;
							$data3['ubicacionesCancha'] = $ubicacionesCancha;
							$this->load->view("jugador/steps/Paso2", $data3)
						?>

						<?php
							// Paso 3: Tipo de Beneficio
							$data2['beneficios'] = $beneficios;
							$this->load->view("jugador/steps/Paso3", $data2)
						?>

						<?php
							// Paso 4: Apoderados
							$this->load->view("jugador/steps/Paso4")
						?>
						<?php
							// Paso 5: Lesiones
							$this->load->view("jugador/steps/Paso5")
						?>
					</div>
				</div>
				<!-- /tabs -->
			</div>
		</div>
	</div><!-- /row -->
</form>

<?php
	$this->load->view("jugador/jugador_js")
    ?>