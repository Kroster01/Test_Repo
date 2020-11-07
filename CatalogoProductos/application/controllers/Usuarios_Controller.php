<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('Model_Persona');
		$this->load->model('Model_Usuarios');
		$this->load->library('session');
	}
	
	/**
	* 
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function micuenta()
	{
		// Se debe obtener el id del usuario desde la sesion
		//$idUser = $this->session->userdata('idUser');
		$idUser = is_numeric ((int)$_POST["idUser"]) ? $_POST["idUser"] : "0";
		$data['error']  = "";
		//array('error' => ' ' )
		if ($idUser != null) {
			$data['dataUser'] = $this->Model_Usuarios->GetUsuarioById($idUser);
			if ($data['dataUser'] === false) {
				//$this->load->view("home/index", $data);
				$data['error']  = "Usuario Invalido.";
				$this->load->view("home/index", $data);
			} else {
				//$this->load->view("usuario/miCuenta", $data);
				$this->load->view("usuario/miCuenta", $data);
			}
		} else {
			$this->load->view("home/index");
		}
	}

	/**
	* 
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function updateCuenta()
	{

		$selectedReg = $this->input->post();
		if (isset($selectedReg))
		{

			$strgin = 0;
			$strgfin = 0;
			
			$celular = $_POST["celular"];
			$email = $_POST["email"];
			$foto = $_POST["foto"];
			$pkUser = $_POST["idUser"];

			if ($celular != "" ) {
				if ( !isset($dataUpCuenta) ){
					$dataUpCuenta['USU_CELULAR'] = $celular;
				} else {
					$dataUpCuenta += [ "USU_CELULAR" => $celular ];
				}
			}

			if ($email != "" ) {
				if ( !isset($dataUpCuenta) ){
					$dataUpCuenta['USU_CORREO_ELECTRONICO'] = $email;
				} else {
					$dataUpCuenta += [ "USU_CORREO_ELECTRONICO" => $email ];
				}
			}

			if ($foto != "" ) {
				if ( !isset($dataUpCuenta) ){
					$dataUpCuenta['USU_FOTOGRAFIA_NOMBRE'] = $foto;
				} else {
					$dataUpCuenta += [ "USU_FOTOGRAFIA_NOMBRE" => $foto ];
				}
			}

			if ($passwordOld != $passwordNew) {

				//$passwordOld = md5($passwordOld);
				//$passwordNew = md5($passwordNew);

				if ( !isset($dataUpCuenta) ){
					$dataUpCuenta['USU_CLAVE'] = md5($passwordNew);
				} else {
					$dataUpCuenta += [ "USU_CLAVE" => md5($passwordNew) ];
				}
			}
			
			$valid = (isset($dataUpCuenta)) ? true : false;
			if ($valid){
				$data['updateCuenta'] = $this->Model_Usuarios->UpdateCuenta($pkUser,$dataUpCuenta);

				// Se debe obtener el id del usuario desde la sesion
				$idUser = is_numeric ((int)$_POST["idUser"]) ? $_POST["idUser"] : "0";
				//$idUser = $this->session->userdata('idUser');

				$data['dataUser'] = $this->Model_Usuarios->GetUsuarioById($idUser);
				$this->load->view("usuario/miCuenta", $data);
			}

			echo "Sin Datos para Actualizar.";
		}
	}

	/**
	* 
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function salir()
	{
		$this->session->sess_destroy();
		$this->load->view("login/login");
	}
}