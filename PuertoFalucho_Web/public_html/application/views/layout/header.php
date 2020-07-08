<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Puerto Falucho | Bienvenido</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('public/images/favicon/favicon_PF.ico')?>" />
	<meta charset="utf-8">
	<meta name="keywords" content="EazyCorp Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> 
		addEventListener("load", function() 
		{ 
			setTimeout(hideURLbar, 0); 
		}, false);

		function hideURLbar() {
			window.scrollTo(0,1);
		} 
	</script>
	<!-- bootstrap-css -->
	<!--<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.css')?>">
	<!--// bootstrap-css -->
	<!-- css -->
	<!-- <link rel="stylesheet" href="public/css/style.css" type="text/css" media="all" />-->
	<!-- <link rel="stylesheet" href="public/css/flexslider.css" type="text/css" media="screen" property="" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/flexslider.css')?>">
	<!-- gallery -->
	<!-- <link rel="stylesheet" href="public/css/lightGallery.css" type="text/css" media="all" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/lightGallery.css')?>">
	<!-- //gallery -->

	<!--// css -->
	<!-- font-awesome icons -->
	<!-- <link rel="stylesheet" href="public/css/font-awesome.min.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/font-awesome.min.css')?>">
	<!-- //font-awesome icons -->

	<!-- font -->
	<!--<link href="//fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Kaushan+Script&amp;subset=latin-ext" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>-->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/fonts.googleapis.com.family.Kaushan.Script&subset.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/fonts.googleapis.com.family.Luckiest.Guy.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/fonts.googleapis.com.family.Roboto.Condensed.css')?>">
	<!-- //font -->
	<!--<script type="text/javascript" src="public/js/jquery-2.1.4.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url('public/js/jquery-2.1.4.min.js')?>"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>

</head>
<body>
	<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<div class="header">
				<div class="container">
					<nav class="navbar navbar-default">
						<div class="navbar-header navbar-left">
							<button type="button" class="navbar-toggle collapsed"
								data-toggle="collapse"
								data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only"></span> <span
									class="icon-bar"></span> <span class="icon-bar"></span> <span
									class="icon-bar"></span>
							</button>
							<h1>
								<a class="navbar-brand" href="/"><?php echo lang('titleApp') ?></a>
							</h1>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-right"
							id="bs-example-navbar-collapse-1">
							<nav>
								<ul class="nav navbar-nav">
									<li class="active"><a href="/"><?php echo lang('menuNavInicio') ?></a></li>
									<li><a href="#about" class="scroll"><?php echo lang('menuNavNuestraEmpresa') ?></a></li>
									<li><a href="#services" class="scroll"><?php echo lang('menuNavServicios') ?></a></li>
									<li><a href="#gallery" class="scroll"><?php echo lang('menuNavProductos') ?></a></li>
									<li><a href="#contact" class="scroll"><?php echo lang('menuNavContactanos') ?></a></li>
								</ul>
								<div class="clearfix"></div>
							</nav>
						</div>
					</nav>


				</div>
			</div>
			<div class="w3layouts-banner">
				<div class="container">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<div class="agileits_w3layouts_banner_info">
										<h3><?php echo lang('textBanner1') ?></h3>
										<!--<p>Standard dummy text ever since the 1500s, when an unknown
											printer took a galley of type and scrambled it to make a type
											specimen book</p>-->
									</div>
								</li>
								<li>
									<div class="agileits_w3layouts_banner_info">
										<h3><?php echo lang('textBanner2') ?></h3>
										<!--<p>Standard dummy text ever since the 1500s, when an unknown
											printer took a galley of type and scrambled it to make a type
											specimen book</p>-->
									</div>
								</li>
								<li>
									<div class="agileits_w3layouts_banner_info">
										<h3><?php echo lang('textBanner3') ?></h3>
										<!--<p>Standard dummy text ever since the 1500s, when an unknown
											printer took a galley of type and scrambled it to make a type
											specimen book</p>-->
									</div>
								</li>
							</ul>
						</div>
					</section>
					<!-- flexSlider -->
					<!--<script defer src="public/js/jquery.flexslider.js"></script>-->
					<script type="text/javascript" src="<?php echo base_url('public/js/jquery.flexslider.js')?>"></script>
					<script type="text/javascript">
						$(window).load(function(){
							$('.flexslider').flexslider({
								animation: "slide",
								start: function(slider){
								$('body').removeClass('loading');
								}
							});
						});
					</script>
					<!-- //flexSlider -->

				</div>
			</div>
		</div>
	</div>
	<!-- //banner -->