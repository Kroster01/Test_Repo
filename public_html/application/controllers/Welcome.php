<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	* Mostrar vista Correspondiente a Wlcome message
	*
	* @param	Sin Parametros
	* @return	view	'welcome_message
	*/
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
