<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function sendmail()
	{
		$msjError = null;
		$error = false;
		$mensaje = null;
		$debuggerLog = null;
		$from = null;
		$to = null;
		$cc = null;
		$bcc = null;
		$subject = null;
		$message = null;
		$mensajeCorreo = null;
		$varto = null;

		$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
		$correo = isset($_POST["correo"]) ? $_POST["correo"] : null;
		$motivoContacto = isset($_POST["motivoContacto"]) ? $_POST["motivoContacto"] : null;
		$celular = isset($_POST["celular"]) ? $_POST["celular"] : null;
		$mensaje = isset($_POST["mensaje"]) ? $_POST["mensaje"] : null;
		$varto = lang('correoContacto');

		$data = null;
		$data["nombre"] = $nombre;
		$data["correo"] = $correo;
		$data["motivocontacto"] = $motivoContacto;
		$data["celular"] = $celular;
		$data["mensaje"] = $mensaje;
		$body = $this->load->view('genericPage/email/templateEmailContactamos.php',$data,TRUE);

		$config = Array(
			'smtp_crypto' => "ssl",    
			'protocol' => 'smtp',
			'smtp_host' => "puertofalucho.cl",
			'smtp_port' => 465,
			'smtp_user' => "contacto@puertofalucho.cl",
			'smtp_pass' => "Puertofalucho2020",
			'smtp_timeout' => '4',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);

        $this->load->library('email', $config);
		$this->email->set_newline('\r\n');
		
		$this->email->from('contacto@puertofalucho.cl', 'Puerto Falucho');
		
		$this->email->to($varto);
		$this->email->subject('Contacto desde la Web - '.utf8_decode($motivoContacto).' - '.date("d-m-Y H/i/s"));
    	$this->email->message($body);
    	
        try {
            if ($this->email->send()) {
            	$msjError = "";
            	$error = false;
            	$mensaje = "Correo Electr&oacute;nico enviado exitosamente, gracias por contactarnos responderemos a la brevedad";
            	$debuggerLog = "";
            } else {
            	$msjError = "Error al enviar el Correo Electr&oacute;nico, intente m&aacute;s tarde.";
            	$error = true;
            	$mensaje = "";
            	$debuggerLog = "".$this->email->print_debugger()."";
            }
        } catch (Exception $e) {
            $msjError = "Error al enviar el Correo Electr&oacute;nico, intente m&aacute;s tarde.";
        	$error = true;
        	$mensaje = "";
        	$debuggerLog = $this->email->print_debugger().' - '.$e->getMessage();
        }
		
		$responseErr = array ('Error'=>$error,
			'ErrorMessage'=>$msjError,
			'Message'=>$mensaje,
			'DebuggerLog' => $debuggerLog);

		echo json_encode($responseErr);
	}
	
}
