<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CuotaSocial extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		/* Comunicación con el modelo */
		$this->load->model('Model_Categorias');
		$this->load->model('Model_Cobro_Cuota_Social');
	}

	/**
	* Mostrar vista para Registrar Cuotas Sociales
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function RegistrarCuotas()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("cuotaSocial/RegistrarCuotas",$data);
	}

	/**
	* Mostrar vista para Buscar Cuotas Sociales
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/BuscarCuotas
	*/
	public function BuscarCuotas()
	{
		$data['categorias'] = $this->Model_Categorias->getCategoria();

		$this->load->view("cuotaSocial/BuscarCuotas",$data);
	}

	/**
	* Mostrar vista para Modificar Cuotas Sociales
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/BuscarCuotas
	*/
	public function ModificarCuotas()
	{
		$data['contenido'] = "Contenido de buscar Jugador";
		$data['header'] = "menumenuuuuu";

		$this->load->view("cuotaSocial/ModificarCuotas",$data);
	}

	/**
	* Buscar los gegostros de Cuotas
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/BuscarCuotas
	*/
	public function searchCuotasSociales()
	{
		$searchCuota = json_decode($_POST["searchCuotasSociales"], false);
		$cuotaResponse = $this->Model_Cobro_Cuota_Social->getSearchCuota($searchCuota);
		echo json_encode($cuotaResponse);
	}
}
