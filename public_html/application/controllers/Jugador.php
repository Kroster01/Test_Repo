<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jugador extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		/* Comunicación con el modelo */
		$this->load->model('Model_Apoderado');
		$this->load->model('Model_Apoderado_Jugador');
		$this->load->model('Model_Beneficio_Jugador');
		$this->load->model('Model_Beneficios');
		$this->load->model('Model_Categorias');
		$this->load->model('Model_Comuna');
		$this->load->model('Model_Generic');
		$this->load->model('Model_Grupo_Sanguineo');
		$this->load->model('Model_Jugador');
		$this->load->model('Model_Persona');
		$this->load->model('Model_Posision_Cancha');
		$this->load->model('Model_Previsiones');
		$this->load->model('Model_Provincia');
		$this->load->model('Model_Region');
		$this->load->model('Model_Responsabilidad_Apoderado');
		$this->load->model('Model_Lesiones');
		
	}

	/**
	* Mostrar vista principal del Jugador Jugador
	*
	* @param	Sin Parametros
	* @return	view	jugador/index
	*/
	public function index()
	{
		/* enviar datos a la plantilla a la vista index */

		$data['contenido']          = "RegistrarJugador";       /* Identificador para la carga en la vista */
		$data['header']             = "menumenuuuuu";           /* Identificador para la carga en la vista */

		$data['categorias']         = $this->Model_Categorias->getCategoria();
		$data['ubicacionesCancha']  = $this->Model_Posision_Cancha->getUbicacionCancha();
		$data['regiones']           = $this->Model_Region->getRegiones();
		$data['beneficios']         = $this->Model_Beneficios->getBeneficios();
		$data['TipePrevision']      = $this->Model_Previsiones->getTipePrevision();
		$data['gruposanguineos']    = $this->Model_Grupo_Sanguineo->getGrupSangui();

		$this->load->view("jugador/index",$data);
	}

	/**
	* Mostrar vista para Buscar Jugador
	*
	* @param	Sin Parametros
	* @return	view	jugador/BuscarJugador
	*/
	public function BuscarJugador()
	{
		$data['categorias']   = $this->Model_Categorias->getCategoria();
		$data['contenido']    = "Contenido de buscar Jugador";  /* Identificador para la carga en la vista */
		$data['header']       = "menumenuuuuu";                 /* Identificador para la carga en la vista */

		$this->load->view("jugador/BuscarJugador",$data);
	}

	/**
	* Mostrar vista para Modificar Jugador
	*
	* @param	Sin Parametros
	* @return	view	jugador/ModificarJugador
	*/
	public function ModificarJugador()
	{
		$data['contenido'] = "Contenido de buscar Jugador";    /* Identificador para la carga en la vista */
		$data['header'] = "menu";                              /* Identificador para la carga en la vista */

		$this->load->view("jugador/ModificarJugador",$data);
	}

	/**
	* Mostrar vista para Modificar Jugador
	*
	* @param	Sin Parametros
	* @return	view	jugador/AsistenciaJugadores
	*/
	public function AsistenciaJugadores()
	{
		$data['contenido'] = "Contenido de Asistencia para Jugadores";    /* Identificador para la carga en la vista */

		$this->load->view("jugador/AsistenciaJugadores",$data);
	}

	/**
	* Mostrar vista para Eliminar Jugador
	*
	* @param	Sin Parametros
	* @return	view	jugador/EliminarJugador
	*/
	public function EliminarJugador()
	{
		$data['contenido'] = "Contenido de eliminar Jugador";  /* Identificador para la carga en la vista */
		$data['header'] = "menum";                             /* Identificador para la carga en la vista */

		$this->load->view("jugador/EliminarJugador",$data);
	}

	/**
	 * Se encargar de entregar las referencia a la tabla Region.
	 *
	 * @param	Sin Parametros
	 * @return	string	 retorna la lista de referencias al tabla Region.
	 */
	public function getRegiones()
	{
		$regiones = $this->Model_Region->getRegiones();
		echo json_encode($regiones);
	}

	/**
	 * Se encargar de entregar las referencia a la tabla provincia.
	 *
	 * @param	Sin Parametros
	 * @return	string	 retorna la lista de referencias al tabla provincia.
	 */
	public function getProvincias()
	{
		$provincias = $this->Model_Provincia->getProvincias();
		echo json_encode($provincias);
	}

	/**
	 * Se encargar de entregar las provincias relacionadas a la region Ingresada.
	 *
	 * @param	string     $_POST["selectedregin"]	        string que contiene la referentes de la region para buscar las provincias relacionadas.
	 * @return	string	   retorna la lista de provincias relacionadas.
	 */
	public function getProvinciasByRegion()
	{
		$selectedregin = $_POST['selectedregin'];
		$provincias = $this->Model_Provincia->getProvinciasByRegion($selectedregin);
		echo json_encode($provincias);
	}

	/**
	 * Se encargar de entregar las referencia a la tabla comuna.
	 *
	 * @param	Sin Parametros
	 * @return	string	 retorna la lista de referencias al tabla comuna.
	 */
	public function getComunas()
	{
		$comunas = $this->Model_Comuna->getComunas();
		echo json_encode($comunas);
	}

	/**
	 * Se encargar de entregar las referencia a la tabla responsabilidad apoderados.
	 *
	 * @param	Sin Parametros
	 * @return	string	 retorna la lista de referencias al tablas responsabilidad de apoderados.
	 */
	public function getResponsabilidadApoderados()
	{
		$responsabilidades = $this->Model_Responsabilidad_Apoderado->getResponsabilidadApoderados();
		echo json_encode($responsabilidades);
	}

	/**
	 * Se encargar de entregar la comunas relacionadas a una provincia determinada.
	 *
	 * @param	string     $_POST["selectedprovincia"]	        string que contiene la referentes de la provincia para buscar las comunas relacionadas.
	 * @return	string	 retorna la lista de comunas relacionadas.
	 */
	public function getComunasByProvincia()
	{
		$selectedprovincia = $_POST['selectedprovincia'];
		$provincias = $this->Model_Comuna->getComunasByProvincia($selectedprovincia);
		echo json_encode($provincias);
	}

	/**
	 * Se encargar de entregar la lista de provincia seún un tipo determinado.
	 *
	 * @param	string     $_POST["searchJugador"]	        string que contiene los datos referentes a la busqueda del Jugador.
	 * @return	string	 retorna la lista de jugadores con cumplen con los datos de la busqueda.
	 */
	public function getSegmentoCorporal()
	{
		$segCorp = $_POST['segCorp'];
		$segmentosCorporales = $this->Model_Lesiones->getSegmentoCorporal($segCorp);
		echo json_encode($segmentosCorporales);
	}

	/**
	 * Se encargar de entregar la lista de provincia seún un tipo determinado.
	 *
	 * @param	string     $_POST["searchJugador"]	        string que contiene los datos referentes a la busqueda del Jugador.
	 * @return	string	 retorna la lista de jugadores con cumplen con los datos de la busqueda.
	 */
	public function getPrevisonesByTipo()
	{
		$selectedprevision = $_POST['selectedprevision'];
		$previsiones = $this->Model_Previsiones->getPrevisonesByTipo($selectedprevision);
		echo json_encode($previsiones);
	}

	/**
	 * Se encargar de entregar la lista de provincia seún un tipo determinado.
	 *
	 * @param	string     $_POST["searchJugador"]	        string que contiene los datos referentes a la busqueda del Jugador.
	 * @return	string	 retorna la lista de jugadores con cumplen con los datos de la busqueda.
	 */
	public function getLesionesByTipo()
	{
		$selectedTipoLesion = $_POST['selectedTipoLesion'];
		$previsiones = $this->Model_Lesiones->getLesionesByTipo($selectedTipoLesion);
		echo json_encode($previsiones);
	}

	/**
	 * Se encargar de la lista de jugadores que cunplan con losparametros de entrada.
	 *
	 * @param	json     $_POST["searchJugador"]	        objeto que contiene los datos referentes a la busqueda del Jugador.
	 * @return	string	 retorna la lista de jugadores con cumplen con los datos de la busqueda.
	 */
	public function searchJugador()
	{
		$searchJugador = json_decode($_POST["searchJugador"], false);
		$jugadoresResponse = $this->Model_Jugador->getSearchJugador($searchJugador);
		echo json_encode($jugadoresResponse);
	}

	/**
	 * Se encargar de realziar la inserción correspondiente al registro de Jugados.
	 *
	 * @param	json   $_POST["paramJugador"]	        objeto que contiene los datos referentes al Jugador para insrtar.
	 * @param	json   $_POST["paramPersona"]	        objeto que contiene los datos referentes a la Persona para insrtar.
	 * @param	json   $_POST["paramApoderados"]	    objeto que contiene los datos referentes a los apoderados para insrtar.
	 * @param	json   $_POST["paramTipoBeneficio"]	    objeto que contiene los datos referentes a los beneficios para insrtar.
	 * @return	string	 retorna el estado de la inserción correspondinete al registro del jugador en BBDD.
	 */
	public function insertRegistroJugador()
	{
		$selectedReg = $this->input->post();
		if (isset($selectedReg))
		{

		/*try{*/
			$strgin = 0;
			$strgfin = 0;
			
			/* 1 */$jugador = json_decode($_POST["paramJugador"], false);
			/* 2 */$persona = json_decode($_POST["paramPersona"], false);
			/* 3 */$apoderados = json_decode($_POST["paramApoderados"], false);
			/* 4 */$beneficio = json_decode($_POST["paramTipoBeneficio"], false);
			/* 5 */$lesiones = json_decode($_POST["paramLesiones"], false);
			
			$valor = Jugador::GetCountPersonaByRut($persona->Rut);
			if (0 == $valor)
			{
				/* 1. Insertar registro en Jugador */
				$response = Jugador::insertJugador($jugador);
				if ( $response != "OK")
				{
					$response = array
						(
							'Isvalid' => false,
							'ErrorMessage' => 'Excepción metodo insertJugador: '.$response
						);

					echo json_encode($response);
					return;
				}

				/* 1.1. Recuperar PK correspondinte al Jugado*/
				$idJugador = Jugador::checkLastCorrelativeTable("jugador", "JUG_PK");

				/* 2. Insertar registro en Persona */
				$responsePersona = Jugador::insertPersona($persona, (int)$idJugador);
				if ( $responsePersona != "OK")
				{
					$response = array
						(
						'Isvalid' => false,
						'ErrorMessage' => 'Excepción metodo insertPersona: '.$responsePersona
						);

					echo json_encode($response);
					return;
				}

				/*  2.1. Recuperar PK correspondinte al Persona */
				$idPersona = Jugador::checkLastCorrelativeTable("persona", "PER_PK");

				/*  3. Insertar registro(s) de Apoderado(s) */

				if ($apoderados[0]->ResponsabilidadApoderado != "" 
					&& $apoderados[0]->NomApoderado != "" 
					//&& $apoderados[0]->FonoApoderado != "" 
					//&& $apoderados[0]->EmailApoderado != "" 
					)
				{
					$responseApoderado = Jugador::insertApoderado($apoderados,$idJugador);
					//$responseApoderado = "OK";
					if ( $responseApoderado != "OK")
					{
						$response = array
							(
								'Isvalid' => false,
								'ErrorMessage' => 'Excepción metodo insertApoderado: '.$responseApoderado
							);

						return json_encode($response);
					}

				}
				
				/* insertar el listados de los apo¿derados  (Pendiente)*/

				/* 4. Insertar registro en Persona */
				$responsePersona = Jugador::insertBeneficioJugador($beneficio,$idJugador);

				if ($responsePersona != "OK")
				{
					$response = array
						(
							'Isvalid' => false,
							'ErrorMessage' => 'Excepción metodo insertBeneficioJugador: '.$responseApoderado
						);

					echo json_encode($response);
					return;
				}

				/* 1.1. Recuperar PK correspondinte al Jugado*/
				$idLesion = Jugador::checkLastCorrelativeTable("lesiones", "LSN_PK");

				/* 5. Insertar registro(s) de Lesion(s) */
				if ($lesiones[0]->tipoLesion != "" 
					&& $lesiones[0]->areaCorporal != ""
					&& $lesiones[0]->segmentoCorporal != "" 
					&& $lesiones[0]->diagnostico != "" 
					&& $lesiones[0]->fechaLesion != "" )
				{
					$responseLesion= Jugador::insertLesionesJugador($lesiones,$idJugador);
					//$responseLesion = "OK";
					if ( $responseLesion != "OK")
					{
						$response = array
							(
								'Isvalid' => false,
								'ErrorMessage' => 'Excepción metodo insertRegistroTableLesiones: '.$responseApoderado
							);

						return json_encode($response);
					}

				}

				$response = array
					(
						'Isvalid' => true,
						'ErrorMessage' => ''
					);

				echo json_encode($response);
				return;
			} else {
				$response = array
					(
						'Isvalid' => false,
						'ErrorMessage' => 'Registro Duplicado.'
					);
		
				echo json_encode($response);
				return;
			}
		} else {
			$response = array
			(
				'Isvalid' => false,
				'ErrorMessage' => 'No Insertado'
			);
		}

		echo json_encode($response);
		return;
	}

	/**
	 * realiza la inserción de las personas.
	 *
	 * @param	object   $persona	    objeto que contiene los datos referentes al jugador para insrtar.
	 * @param	string   $idJugador	    pk del jugador al que se debe referenciar a la persona.
	 * @return	string	 retorna el estado de la inserción del jugador.
	 */
	public function insertPersona($persona, $idJugador)
	{

		$response = "OK";

		$Nombre          = $persona->Nombre;
		$Apellido        = $persona->Apellido;
		$Rut             = $persona->Rut;
		$FotoPerfil      = $persona->FotoPerfil;
		$FechaNacimiento = $persona->FechaNacimiento;
		$FonoContacto    = $persona->FonoContacto;
		$Email           = $persona->Email;
		$PkComuna        = $persona->PkComuna;
		$Direccion       = $persona->Direccion;
		$CREATED         = date("Y-m-d");
		$CREATED_BY      = "user_test";


		try
		{
			$this->Model_Persona->setInsertPersona($Nombre,$Apellido,$Rut,$FotoPerfil,$FechaNacimiento,$FonoContacto,$Email,$PkComuna,$idJugador,$Direccion,$CREATED,$CREATED_BY);
		} catch (Exception $e) {
			$response = 'Excepción metodo insertPersona: '.$e->getMessage();
			return $response;
		}

		return $response;
	}

	/**
	 * realiza la inserción de los jugadores.
	 *
	 * @param	object   $jugador	    objeto que contiene los datos referentes al jugador para insrtar.
	 * @return	string	 retorna el estado de la inserción del jugador.
	 */
	public function insertJugador($jugador)
	{

		$response = "OK";

		$Fec_ini_club         = $jugador->FechaIngresoJugador;
		$Cont_emergencia      = $jugador->LlamadaEmergencia;
		$Estatura             = (int)$jugador->Estatura;
		$Peso                 = (int)$jugador->Peso;
		$Seuro_accidente      = $jugador->SeguroAccidente;
		$Stado_in_club        = "Activo";
		$Medicamentos         = $jugador->Medicamentos;
		$Eva_nutri            = $jugador->EvaluaNutricional;
		$Alergias             = $jugador->Alergias;
		$Observaciones        = $jugador->Obserbaciones;
		$Pk_previsiom         = (int)$jugador->PkPrevision;
		$Pk_grupo_sanguineo   = (int)$jugador->GrupoSanguineo;
		$Pk_categoria         = (int)$jugador->Categoria;
		$Pk_ubicacioncahncha  = (int)$jugador->UbicacionCancha;
		$CREATED              = date("Y-m-d");
		$CREATED_BY           = "user_test";


		try
		{
			$this->Model_Jugador->setinsertJugador($Fec_ini_club,$Cont_emergencia,$Estatura,$Peso,$Seuro_accidente,$Stado_in_club,$Medicamentos,$Eva_nutri,$Alergias,$Observaciones,$Pk_previsiom,$Pk_grupo_sanguineo,$Pk_categoria,$Pk_ubicacioncahncha,$CREATED,$CREATED_BY);
		} catch (Exception $e) {
			$response = 'Excepción metodo insertJugador: '.$e->getMessage();
			return $response;
		}
		
		return $response;
	}

	/**
	 * realiza la inserción del beneficio.
	 *
	 * @param	object   $beneficio	    objeto que contiene los datos referentes al benefio a insertar.
	 * @param	string   $Pk_Jugador	pk del jugador al que se debe referenciar el beneficio.
	 * @return	string	     retorna el estado de la inserción del beneficio.
	 */
	public function insertBeneficioJugador($beneficio,$Pk_Jugador)
	{

		$response       = "OK";
		$Fecha_Ini      = $beneficio->FechaIniBeneficio;
		$Fecha_Fin      = $beneficio->FechaFinBeneficio;
		$Observacion    = $beneficio->Observacion;
		$Pk_Beneficio   = $beneficio->Tipbeneficio;

		try
		{
			$this->Model_Beneficio_Jugador->setinsertBeneficioJugador($Pk_Beneficio,$Fecha_Ini,$Fecha_Fin,$Observacion,$Pk_Jugador);
		} catch (Exception $e) {
			$response = 'Excepción metodo insertBeneficioJugador: '.$e->getMessage();
			return $response;
		}

		return $response;
	}

	/**
	 * realiza la inserción de los apoderados.
	 *
	 * @param	object   $apoderados	    objeto que contiene los datos referentes a los apoderados para insrtar.
	 * @param	string   $pkJugador	        pk del jugador al que se debe referenciar el beneficio.
	 * @return	string	     retorna el estado de la inserción de los apoderados.
	 */
	public function insertApoderado($apoderados,$pkJugador)
	{
		/* Se debe mejorar la Funcnionalidad (Dividir en dos funcniones distintas) */
		$response = "OK";
		foreach( $apoderados as $apoderado )
		{
			$CREATED                  = date("Y-m-d");
			$CREATED_BY               = "user_test";

			/* insertar el apoderado */
			try
			{
				$this->Model_Apoderado->setinsertApoderado($apoderado,$CREATED,$CREATED_BY);
			} catch (Exception $e) {
				$response = 'Excepción metodo insertApoderado: '.$e->getMessage();
				return $response;
			}
			/* insertar la relación con el Jugador */
			$idApoderado = Jugador::checkLastCorrelativeTable("apoderado","APO_PK");

			/* insertar la relación con el Jugador */
			try
			{
				$this->Model_Apoderado_Jugador->setinsertApoderado_Jugador($idApoderado,$pkJugador,$apoderado->ResponsabilidadApoderado,$CREATED,$CREATED_BY);
			} catch (Exception $e) {
				$response = 'Excepción metodo insertApoderado: '.$e->getMessage();
				return $response;
			}

		}

		return $response;
	}

	/**
	 * realiza la inserción de los apoderados.
	 *
	 * @param	object   $apoderados	    objeto que contiene los datos referentes a los apoderados para insrtar.
	 * @param	string   $pkJugador	        pk del jugador al que se debe referenciar el beneficio.
	 * @return	string	     retorna el estado de la inserción de los apoderados.
	 */
	public function insertLesionesJugador($lesiones,$pkJugador){
		$response = "OK";
		foreach( $lesiones as $lesion )
		{
			$CREATED                  = date("Y-m-d");
			$CREATED_BY               = "user_test";

			/* insertar la relación con el Jugador */
			try
			{
				$this->Model_Lesiones->setLesiones_Jugador($pkJugador,$lesion,$CREATED,$CREATED_BY);
			} catch (Exception $e) {
				$response = 'Excepción metodo insertLesionesJugador: '.$e->getMessage();
				return $response;
			}

		}

		return $response;
	}

	/**
	 * Entrega la camtidad de personas con un rut determinado.
	 *
	 * @param	string   $Rut	nombre de la tabla a consultar.
	 * @return	int	     retorna la cantidad de las concurrencia enontradas.
	 */
	public function GetCountPersonaByRut($Rut)
	{
		$countPersona = $this->Model_Persona->GetCountPersonaByRut($Rut);
		$response = $countPersona[0]->countPerson;
		return (int)$response;
	}

	/**
	 * Agregar una Row  tabla Apoderados Step 4
	 *
	 * @param	Sin Parámentros
	 * @return	view	 retorna a las vista una row con la vista -> jugador/trtableApoderados.
	 */
	public function addRowApoderado()
	{
		$paramIdRow = $_POST['idRow'];
		$data['idRow'] = $paramIdRow;
		$data['responsabiliddaApo'] = $this->Model_Responsabilidad_Apoderado->getResponsabilidadApoderados();

		$this->load->view("jugador/trtableApoderados",$data);
	}

	/**
	 * Agregar una Row  tabla Lesiones Step 5
	 *
	 * @param	Sin Parámentros
	 * @return	view	 retorna a las vista una row con la vista -> jugador/trtableLesiones.
	 */
	public function addRowLesion()
	{
		$paramIdRow = $_POST['idRow'];
		$data['idRow'] = $paramIdRow;
		$data['tipoDeLesiones']  = $this->Model_Lesiones->getTipoDeLesiones();
		$data['areaCoporal']     = $this->Model_Lesiones->getAreaCorporal();

		$this->load->view("jugador/trtableLesiones",$data);
	}

	/**
	 * recupera el segmrnto corporal correspondiente al area corporal currespondiente.
	 *
	 * @param	Sin Parámentros
	 * @return	view	 retorna a las vista una row con la vista -> jugador/trtableLesiones.
	 */
	public function getSegCorporal()
	{
		$segCorp = $this->Model_Responsabilidad_Apoderado->getResponsabilidadApoderados();
		echo json_encode($segCorp);
	}

	/**
	 * chequear última concurrencia en la tabla que s erequiera.
	 *
	 * @param	string	$tableName	nombre de la tabla a consultar.
	 * @param	string	$PKName	Nombre de la PK a la que se debe hacer referencia.
	 * @return	bool	retorna un numero con el id correspondiente a la última inserción.
	 */
	function checkLastCorrelativeTable($tableName,$PKName)
	{
		$idJugadorModelo = $this->Model_Generic->checkidlastrecord($tableName, $PKName);
		$idJugador = $idJugadorModelo[0]->max;

		return $idJugador;
	}

}
