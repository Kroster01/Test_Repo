<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<!--
	CRUD CON CODEIGNITER 3 + BOOTSTRAP + MYSQL Parte 3
	https://www.youtube.com/watch?v=SP7kdeLR2vU 

	Login con CodeIgniter y Ajax - Libreria Session
	https://www.youtube.com/watch?v=llG4I9uANVw

	Como Relacionar Tablas en Mysql con phpMyAdmin
	https://www.youtube.com/watch?v=5zBb_flFllc
-->

<html lang="es">
<head>
	<meta charset="utf-8">
	<title>RUCAMANQUE RC</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('public/image/favicon/favicon.png')?>" />

	<script type="text/javascript" src="<?php echo base_url('public/jquery/jquery-3.2.1.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/jquery/jquery-ui-1.12.1/jquery-ui.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/jquery.dataTables.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/dataTables.buttons.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/buttons.flash.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/jszip.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/pdfmake.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/vfs_fonts.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/buttons.html5.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/dataTables.responsive.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/bootstrap-3.3.7/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/bootstrap-3.3.7/js/bootstrap-datepicker.min.js')?>"></script>	
	
	<?php
		$this->load->view("GeneralPage/app");
		$this->load->view("GeneralPage/validaterut");
		$this->load->view("GeneralPage/menunav_js",$header);
	?>

	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/jquery/jquery-ui-1.12.1/jquery-ui.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap-3.3.7/css/bootstrap.min.css')?>">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/app.css')?>">

	<?php
		$data['container_fondo'] = base_url('/public/image/fondos/container_fondo.png'); 
		$data['pricipal_fondo'] = base_url('/public/image/fondos/pricipal_fondo.png'); 
		$this->load->view("GeneralPage/genericStyle_css",$data);
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/menunav.css')?>">


</head>
<body align="">
	<div class="bg"></div>
	<div class="col-md-offset-2 col-md-8 col-md-offset-2 subbg">
		<div class="col-md-12 pl0 pr0 ">
			<header id="header">
				<?php
					$this->load->view($header)
				?>
			</header>
			<div id="container">
				<!-- Aqui va el contenido de las vistas -->
				<div class="col-md-12">
					<div id="menunav">
						<?php
							$this->load->view($menunav)
							?>
					</div>
					<div id="contenido">
						<?php
							$this->load->view($contenido)
							?>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Información</h4>
						</div>
						<div class="modal-body">
							<p>Some text in the modal.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<footer id="footer">
				<?php
					$this->load->view($footer)
				?>
			</footer>
		</div>
	</div>
	<?php
		$this->assets->load_js();

		if (isset($script)) {
			echo "\n";
			foreach ($script as $src) {
				if (!preg_match('/\<script.*/', $src)) {
					echo '<script type="text/javascript" src="'. $src . '"></script>';
					echo "\n";
				} else {
					echo "\n";
					echo $src;
				}
			}
		}


		$jsCache = (isset($limpiaCache) && $limpiaCache == TRUE) ? TRUE : FALSE;
		cargarJS($jsCache);
	?>
</body>
</html>