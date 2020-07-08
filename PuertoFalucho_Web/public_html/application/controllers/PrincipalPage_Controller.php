<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalPage_Controller extends CI_Controller {
	
	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('sections/About');
		$this->load->view('sections/Services');
		$this->load->view('sections/Gallery');
		$this->load->view('sections/ContactForm');
		$this->load->view('layout/footer');
	}
}
