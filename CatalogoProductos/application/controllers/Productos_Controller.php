<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('Model_Persona');
		$this->load->model('Model_Productos');
		$this->load->model('Model_Proveedores');
		$this->load->library('session');
	}
	
	/**
	* 
	*
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function catalogo()
	{
		//$data['catalogoList'] = false;
		$data['catalogoList'] = $this->Model_Productos->GetProductos();
		$data['containerCatalog'] = "";
		$data['error']  = "";
		//$this->load->view("productos/catalogo");
		$this->load->view("catalogoProducto/index", $data);
		//echo "salida.";
	}
	
	/**
	* 
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function ingresarproducto()
	{
		$data['proveedores'] = $this->Model_Proveedores->GetProveedores();
		$data['result'] = "OK";
		$data['error']  = "";
		$this->load->view("catalogoProducto/ingresarproducto", $data);
	}

	public function AddProductos()
	{

		//$idProducto = $_POST["idProducto"];
		$nombre = $_POST["nombreProd"];
		$codigo = $_POST["codeProd"];
		$valor = $_POST["valorUnitario"];
		$pkProveedor = $_POST["codeProveedor"];
		$fichaNombre = $_POST["fichaNombre"];
		$fichaRuta = $_POST["fichaRuta"];
		$fotoNombre = $_POST["fotoNombre"];
		$fotoRuta = $_POST["fotoRuta"];

		if ($nombre != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_NOMBRE'] = $nombre;
			} else {
				$dataProducto += [ "PRO_NOMBRE" => $nombre ];
			}
		}

		if ($codigo != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_CODIGO'] = $codigo;
			} else {
				$dataProducto += [ "PRO_CODIGO" => $codigo ];
			}
		}

		if ($valor != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_VALOR_UNITARIO'] = $valor;
			} else {
				$dataProducto += [ "PRO_VALOR_UNITARIO" => $valor ];
			}
		}

		if ($pkProveedor != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PVD_ID'] = $pkProveedor;
			} else {
				$dataProducto += [ "PVD_ID" => $pkProveedor ];
			}
		}

		if ($fichaNombre != "") {
			$fichaRuta = Productos_Controller::cerateFolder($codigo);
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_FICHA_TECNICA_NOMBRE'] = $fichaNombre;
				$dataProducto['PRO_FICHA_TECNICA_RUTA'] = $fichaRuta;
			} else {
				$dataProducto += [ "PRO_FICHA_TECNICA_NOMBRE" => $fichaNombre ];
				$dataProducto += [ "PRO_FICHA_TECNICA_RUTA" => $fichaRuta ];
			}
		}

		if ($fotoNombre != "" ) {
			$fotoRuta = Productos_Controller::cerateFolder($codigo);
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_FOTOGRAFIA_NOMBRE'] = $fotoNombre;
				$dataProducto['PRO_FOTOGRAFIA_RUTA'] = $fotoRuta;
			} else {
				$dataProducto += [ "PRO_FOTOGRAFIA_NOMBRE" => $fotoNombre ];
				$dataProducto += [ "PRO_FOTOGRAFIA_RUTA" => $fotoRuta ];
			}
		}


		$idProducto = "1";
		$data['error']  = "";
		$idProducto = $this->Model_Productos->AddProductos($dataProducto);
		//$idProducto = "1";

		$data['proveedores'] = $this->Model_Proveedores->GetProveedores();
		$data['result'] = "OK";
		$data['id_Producto_Edit'] = $idProducto;
		$data["productoByID"] = $this->Model_Productos->GetProductosByID($idProducto);
		$this->load->view("catalogoProducto/editarProducto", $data);
	}

	/**
	* 
	* @param	Sin Parametros
	* @return	view	cuotaSocial/RegistrarCuotas
	*/
	public function setProducto()
	{
		$idProducto = $_POST["idProducto"];
		$nombre = $_POST["nombreProd"];
		$codigo = $_POST["codeProd"];
		$valor = $_POST["valorUnitario"];
		$pkProveedor = $_POST["codeProveedor"];
		$fichaNombre = $_POST["fichaNombre"];
		$fichaRuta = $_POST["fichaRuta"];
		$fotoNombre = $_POST["fotoNombre"];
		$fotoRuta = $_POST["fotoRuta"];

		if ($nombre != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_NOMBRE'] = $nombre;
			} else {
				$dataProducto += [ "PRO_NOMBRE" => $nombre ];
			}
		}

		if ($codigo != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_CODIGO'] = $codigo;
			} else {
				$dataProducto += [ "PRO_CODIGO" => $codigo ];
			}
		}

		if ($valor != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_VALOR_UNITARIO'] = $valor;
			} else {
				$dataProducto += [ "PRO_VALOR_UNITARIO" => $valor ];
			}
		}

		if ($pkProveedor != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PVD_ID'] = $pkProveedor;
			} else {
				$dataProducto += [ "PVD_ID" => $pkProveedor ];
			}
		}

		if ($fichaNombre != "" && $fichaRuta != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_FICHA_TECNICA_NOMBRE'] = $fichaNombre;
				$dataProducto['PRO_FICHA_TECNICA_RUTA'] = $fichaRuta;
			} else {
				$dataProducto += [ "PRO_FICHA_TECNICA_NOMBRE" => $fichaNombre ];
				$dataProducto += [ "PRO_FICHA_TECNICA_RUTA" => $fichaRuta ];
			}
		}

		if ($fotoNombre != "" && $fotoRuta != "" ) {
			if ( !isset($dataProducto) ){
				$dataProducto['PRO_FOTOGRAFIA_NOMBRE'] = $fotoNombre;
				$dataProducto['PRO_FOTOGRAFIA_RUTA'] = $fotoRuta;
			} else {
				$dataProducto += [ "PRO_FOTOGRAFIA_NOMBRE" => $fotoNombre ];
				$dataProducto += [ "PRO_FOTOGRAFIA_RUTA" => $fotoRuta ];
			}
		}

		$data['proveedores'] = $this->Model_Productos->UpdateProducto($idProducto,$dataProducto);
		$data['error']  = "";
		$data['proveedores'] = $this->Model_Proveedores->GetProveedores();
		$data['result'] = "OK";
		$data['id_Producto_Edit'] = $idProducto;
		$data["productoByID"] = $this->Model_Productos->GetProductosByID($idProducto);
		$this->load->view("catalogoProducto/editarProducto", $data);
	}

	/**
	* 
	*
	* @param	id id_producto
	* @return	
	*/
	public function editProducto()
	{

		$id_producto = $_POST["idProducto"];
		$data['error']  = "";
		$data['proveedores'] = $this->Model_Proveedores->GetProveedores();
		$data['id_Producto_Edit'] = $id_producto;
		$data["productoByID"] = $this->Model_Productos->GetProductosByID($id_producto);
		$this->load->view("catalogoProducto/editarProducto", $data);
	}

	function cerateFolder($floderName) {
		
		$folder = "public/productos/".$floderName."/";
		
		if (!is_dir($folder)) {
			mkdir("./".$folder, 0777, TRUE);
		}
		return $folder;
	}
}