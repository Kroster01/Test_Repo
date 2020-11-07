<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GestionBeneficios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		/* Comunicación con el modelo */
		/* $this->load->model('Model_Jugador'); */
	}

	/**
	* Mostrar vista para Buscra Beneficios
	*
	* @param	Sin Parametros
	* @return	view	GestionBeneficios/BuscarBeneficio
	*/
	public function BuscarBeneficio()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("GestionBeneficios/BuscarBeneficio",$data);
	}

	/**
	* Mostrar vista para Modificar Beneficios
	*
	* @param	Sin Parametros
	* @return	view	GestionBeneficios/ModificarBeneficio
	*/
	public function ModificarBeneficio()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("GestionBeneficios/ModificarBeneficio",$data);
	}
}
