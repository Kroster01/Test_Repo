<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

    <!-- /contact form -->
	<!--google map section ends here-->
	<div class="agileits-w3layouts-map wow zoomIn animated"
		data-wow-delay=".5s" id="contact">
		
		<div class="main">
			<div class="w3_agile_main_grids">
				<div class="agileinfo_map">
					<div class="agileits_pos">
						<div class="w3ls_contact_info">
							<h3><?php echo lang('informacionContacto') ?></h3>
							<ul class="w3_contact_list" style="padding-left: 0px;">
								<li><?php echo lang('labelCorreoElectronico') ?> 
									<a href="mailto:<?php echo lang('correoContacto') ?>"><?php echo lang('correoContacto') ?></a>
								</li>
								<li><?php echo lang('celularLabel') ?>
									<?php echo lang('numeroCelular') ?>
								</li>
								<li><?php echo lang('labelNuestraDireccion') ?> 
									<?php echo lang('textDireccion') ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="agile_contact_form">
					<div class="agileits_w3layouts_contact">
						<h2><?php echo lang('envianosUnCorreo') ?></h2>
						<p>
							<br /><br />
						</p>
						<form action="#" method="post">
							<span class="input input--jiro"> <input class="input__field input__field--jiro" type="text" id="input-10" name="Name" placeholder="<?php echo lang('emailNombreCompletoLabel') ?>" required="" />
								<label class="input__label input__label--jiro" for="input-10">
									<span class="input__label-content input__label-content--jiro"><?php echo lang('emailNombreCompleto') ?></span>
								</label>
							</span>
							<span class="input input--jiro"> 
								<input class="input__field input__field--jiro" type="email" id="input-11" name="Email" placeholder="<?php echo lang('emailCorreoElectronicoLable') ?>" required="" />
								<label class="input__label input__label--jiro" for="input-11">
									<span class="input__label-content input__label-content--jiro"><?php echo lang('emailCorreoElectronico') ?></span>
								</label>
							</span> 
							<select id="w3_agileits_select" class="w3layouts_select frm-field required sect">
								<option value="NN"><?php echo lang('MotivoDeContacto') ?></option>
								<option value="<?php echo lang('motivo1') ?>"><?php echo lang('motivo1') ?></option>
								<option value="<?php echo lang('motivo2') ?>"><?php echo lang('motivo2') ?></option>
								<option value="<?php echo lang('motivo3') ?>"><?php echo lang('motivo3') ?></option>
							</select>
							<span class="input input--jiro"> 
								<input class="input__field input__field--jiro" type="text" id="input-12" name="Company" placeholder="<?php echo lang('celular') ?>" required="" onkeypress="solonumeros(event)" maxlength="9" /> 
								<label class="input__label input__label--jiro" for="input-12">
									<span class="input__label-content input__label-content--jiro"><?php echo lang('ingreseCelular') ?></span>
								</label>
							</span>
							<textarea id="textAreaMensaje" name="Message" placeholder="<?php echo lang('mensajeLabel') ?>" required=""></textarea>
							<div class="wthree_submit">
								<input type="submit" data-url="<?php echo site_url('Email_Controller/sendmail') ?>" id="submitMail" value="<?php echo lang('enviar') ?>">
							</div>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		
		<iframe src="<?php //echo lang('direccionGoogleMaps') ?>" allowfullscreen>
		</iframe>
		
    </div>
    
    <!-- //contact form -->