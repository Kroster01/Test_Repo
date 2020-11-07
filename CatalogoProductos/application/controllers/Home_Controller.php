<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('Model_Persona');
		$this->load->model('Model_Productos');
		$this->load->library('session');
	}
	
	/**
	* 
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function index()
	{
		$data['error']  = "";
		$this->load->view("home/index", $data);
	}
}