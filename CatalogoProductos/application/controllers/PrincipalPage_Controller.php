<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalPage_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Productos');
		$this->load->library('session');
	}
	
	/**
    * Metodo validador de Login
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
	public function catalogoProductoInit()
	{
		
		// Se deben validar la contraseña que ingresa vs la contraseña que esta guardada en el sistema.

		// Se debe obtener el id del usuario desde la sesion
		$nombre = $_POST["nombreUser"];
		$pass = $_POST["passUser"];

		// validar que los campos user y pass esten informados
		$pass = md5($pass);

		$data['dataUser'] = $this->Model_Usuarios->GetUsuarioByUserPass($nombre,$pass);

		if ($data['dataUser'] != false) {
			$data['catalogoList'] = $this->Model_Productos->GetProductos();
			$data['containerCatalog'] = "";

			// Instanciar Session

			if (($data['dataUser'][0]->USU_FOTOGRAFIA_RUTA == null || $data['dataUser'][0]->USU_FOTOGRAFIA_RUTA  == "") ||
			($data['dataUser'][0]->USU_FOTOGRAFIA_NOMBRE == null || $data['dataUser'][0]->USU_FOTOGRAFIA_NOMBRE  == "")
			 ) {
				$data['dataUser'][0]->USU_FOTOGRAFIA_RUTA = "public/image/users/";
				$data['dataUser'][0]->USU_FOTOGRAFIA_NOMBRE = "profile_default.png";
			}

			$sessionData = [
				"idUser" => $data['dataUser'][0]->USU_ID,
				"nameUser" => $data['dataUser'][0]->USU_NOMBRE_COMPLETO,
				"urlFotoUser" => $data['dataUser'][0]->USU_FOTOGRAFIA_RUTA,
				"nameFotoUser" => $data['dataUser'][0]->USU_FOTOGRAFIA_NOMBRE,
				"isLogin" => TRUE,
			];

			$this->session->sess_destroy();
			$this->session->sess_expiration = '14400';// expires in 4 hours
			$this->session->set_userdata($sessionData);

			$data['error'] = "";

			//$this->load->view("layout/header", $data);
			$this->load->view("menuNav");
			$this->load->view("home/index", $data);
			//$this->load->view("layout/footer", $data);
		} else {
			// Retornar Error de user or pass mal ingresadas
			echo "Error";
		}
	}

	/**
    * Eliminar los datos de sesión
    *
    * @param	Sin Parametros
    * @return	sin Salida
    */
	public function salirSession()
	{
		$this->session->sess_destroy();
	}
	/**
    * Carga la pagina principal de Servicio de Productos
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
	public function index()
	{
		$data['catalogoList'] = $this->Model_Productos->GetProductos();
		$data['containerCatalog'] = "";
		$data['error']  = "";
		$this->load->view("layout/header", $data);
		//$this->load->view("home/index", $data);
		$this->load->view("login/login", $data);
		$this->load->view("layout/footer", $data);
	}

}
