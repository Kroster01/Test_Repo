<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WelcomeRucamanque extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
	}

	/**
	* Mostrar Pagina Principal del Aplicativo
	*
	* @param	Sin Parametros
	* @return	view	lesiones/RegistrarLesion
	*/
	public function index()
	{
		/*$this->assets->add_js([
			[ 'src' => '/assets/sistemas/smd/js/funciones.js' ],
			]);*/
		
		$data['header'] = "GeneralPage/header";
		$data['menunav'] = "GeneralPage/menu_nav";
		$data['contenido'] = "WelcomeRucamanque/index";
		$data['footer'] = "GeneralPage/footer";
		$data['init_page_ruca'] = "GeneralPage/init_page_ruca";

		/* Rescatar User y permisos para guardarlos en */
		/* SESSION */

		/*$this->assets->add_js([
			[ 'src' => 'public/jquery/jquery-3.2.1.min.js' ],
			[ 'src' => 'public/jquery/jquery-ui-1.12.1/jquery-ui.js' ],
			[ 'src' => 'public/js/jquery.dataTables.min.js' ],
			[ 'src' => 'public/js/dataTables.buttons.min.js' ],
			[ 'src' => 'public/js/buttons.flash.min.js' ],
			[ 'src' => 'public/js/jszip.min.js' ],
			[ 'src' => 'public/js/pdfmake.min.js' ],
			[ 'src' => 'public/js/vfs_fonts.js' ],
			[ 'src' => 'public/js/buttons.html5.min.js' ],
			[ 'src' => 'public/js/dataTables.responsive.js' ],
			[ 'src' => 'public/bootstrap-3.3.7/js/bootstrap.min.js' ],
			[ 'src' => 'public/bootstrap-3.3.7/js/bootstrap-datepicker.min.js' ],
		]);*/

		/*$this->assets->add_css([
			[ 'href' => 'public/jquery/jquery-3.2.1.min.js' ],

		]);*/

		$this->load->view("layout/header", $data);
		$this->load->view("WelcomeRucamanque/index", $data);
		$this->load->view("layout/footer", $data);
	}

	/**
	* Re Cargar Pagina Principal del Aplicativo
	*
	* @param	Sin Parametros
	* @return	view	lesiones/RegistrarLesion
	*/
	public function reLoadIndex()
	{
		
		$data['header'] = "GeneralPage/header";
		$data['menunav'] = "GeneralPage/menu_nav";
		$data['contenido'] = "WelcomeRucamanque/index";
		$data['footer'] = "GeneralPage/footer";
		$data['init_page_ruca'] = "GeneralPage/init_page_ruca";

		/* Rescatar User y permisos para guardarlos en*/
		/* SESSION */

		/* $this->load->view("layout/header", $data); */
		$this->load->view("WelcomeRucamanque/index", $data);
		/* $this->load->view("layout/footer", $data); */
	}
}
