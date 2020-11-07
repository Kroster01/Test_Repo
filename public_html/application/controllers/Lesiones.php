<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesiones extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('language');
		/* Comunicación con el modelo */
		/* $this->load->model('Model_Jugador'); */
	}

	/**
	* Mostrar vista para Registrar Lesiones
	*
	* @param	Sin Parametros
	* @return	view	lesiones/RegistrarLesion
	*/
	public function RegistrarLesion()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("lesiones/RegistrarLesion",$data);
	}

	/**
	* Mostrar vista para Modificar Lesiones
	*
	* @param	Sin Parametros
	* @return	view	lesiones/ModificarLesion
	*/
	public function ModificarLesion()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("lesiones/ModificarLesion",$data);
	}
}
