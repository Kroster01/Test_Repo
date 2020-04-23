package cl.inmotion.movistar;

import java.io.Serializable;
import java.nio.charset.Charset;
import java.text.DecimalFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Iterator;
import java.util.Locale;

import javax.crypto.Cipher;
import javax.crypto.spec.SecretKeySpec;
import javax.xml.registry.infomodel.EmailAddress;

import org.apache.commons.codec.binary.Base64;
import org.apache.log4j.Logger;


import cl.inmotion.movistar.conexion.DBSupport;
import cl.inmotion.util.Utiles;

import com.bowstreet.util.IXml;
import com.bowstreet.webapp.WebAppAccess;

public class PagoAppMobileBussiness implements Serializable{

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private static Logger log = Logger.getLogger(PagoAppMobileBussiness.class);

	public static String decryptBlowBase64(byte[] plaintext, byte[] Key) {
		SecretKeySpec _key = new SecretKeySpec(Key, "Blowfish");
		plaintext=Base64.decodeBase64(plaintext);
		// Complete block 8 bytes
		if (plaintext.length % 8 != 0) { // not a multiple of 8
			// create a new array with a size which is a multiple of 8
			byte[] padded = new byte[plaintext.length + 8
					- (plaintext.length % 8)];

			// copy the old array into it
			System.arraycopy(plaintext, 0, padded, 0, plaintext.length);
			plaintext = padded;
			System.out.println("se va por el if");
		}
		try {
			// Get a Blowfish Cipher object
			Cipher cipher = Cipher.getInstance("Blowfish/ECB/NoPadding"); // Blowfish
																			// encryption
			// Set it into encryption mode
			cipher.init(Cipher.DECRYPT_MODE, _key);
			// Encrypt data
			byte[] cipherText = cipher.doFinal(plaintext);

			// Encode Base64
			//cipherText = Base64.decodeBase64(cipherText);
			String value = new String(cipherText);
			// System.out.println("value: "+value);
			return value;
		} catch (Exception e) {
			e.printStackTrace();
			return null;
		}
	}
		
	/**
	 * Metodo que corrobora si la cadena de caracteres, contiene numero o letras.
	 * @param str
	 * @return false o true
	 */	
	public static boolean isNumeric(String str) {
	        return (str.matches("[+-]?\\d*(\\.\\d+)?") && str.equals("")==false);
	}

	
	public void obtieneParametros(WebAppAccess webAppAccess){


		try{
			log.debug("Obteniendo parametros de la URL");
			
			String param = "";
			
			String parametrosURL = webAppAccess.getRequestInputs().getInputValue("my_poc_param");
			log.debug("Parametros: " + parametrosURL);
			
			//Logica que discrimina si los parametros viajan encriptados o no. 
			if(isNumeric(parametrosURL.substring(1, parametrosURL.length())) == true){
				log.debug("Parametros no encriptados");
				param = parametrosURL;				
			}else{				
				log.debug("Parametros encriptados");
				
				String key = "1q2w3e4r5t6y7u8i";
				String dataURLFormat = parametrosURL.replace("_", "+").replace("~", "/").replace("!", "=");
				log.debug("dataURLFormat: " + dataURLFormat);
				
				param = decryptBlowBase64(dataURLFormat.getBytes(),key.getBytes()).trim();
				log.debug("Parametro decrypt: "+param);								
			}
					

			IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");		
			String numero = "";
			String segmento = "";
			if(param.substring(0, 1).equals("M")){
				segmento = "movil";
				numero = param.substring(1, param.length());
			}
			else{
				segmento = "fijo";
				numero = param.substring(1, param.length());
			}
			detalle.findElement("detallePagoPublico/segmento").setText(segmento);
			detalle.findElement("detallePagoPublico/canal").setText("mobile");
			if(segmento.equals("movil")){
				
				
				detalle.findElement("detallePagoPublico/numeroMovil").setText(numero);
				detalle.findElement("detallePagoPublico/numeroCompleto").setText(numero);
				
				// numero completo sin ceros
			    String numeroSinCeros = numero.replaceFirst ("^0*", "");
			    log.debug("Numeros sin ceros: "+numeroSinCeros);
			    detalle.findElement("detallePagoPublico/numeroCompletoSinCeros").setText(numeroSinCeros);

			}
			else{
				
				//discriminacion de numero Movil portado a Fijo
				String numeroSinCerosPort = numero.replaceFirst ("^0*", "");
				log.debug("Numero portable sin ceros: "+numeroSinCerosPort);

				if(numeroSinCerosPort.substring(0,1).equals("9")){
					String areaPort = "0"+numero.substring(0,2);
					String numeroFijoPort = numeroSinCerosPort.substring(1,numeroSinCerosPort.length());
					
					detalle.findElement("detallePagoPublico/codAreaAPagar").setText(areaPort);			
					detalle.findElement("detallePagoPublico/numeroFijo").setText(numeroFijoPort);
					
					detalle.findElement("detallePagoPublico/numeroCompletoSinCeros").setText(numeroSinCerosPort);
					
					detalle.findElement("detallePagoPublico/numeroCompleto").setText(numeroSinCerosPort);
				} 
				
				else {
					
					String area = param.substring(1,4);
					String numeroFijo = param.substring(4,param.length());				
			
					
					detalle.findElement("detallePagoPublico/codAreaAPagar").setText(area);			
					detalle.findElement("detallePagoPublico/numeroFijo").setText(numeroFijo);	
					
					//discriminacion de numero Movil portado a Fijo				
					String numeroAux = "";
					
					int largoNumero = numero.length();
					log.debug("Largo del numero: "+largoNumero);
					
					//Tomo el largo del numero para discriminar si es de Santiago u otras regiones
					if(largoNumero == 11){
						
						//numero completo sin ceros para mostrar en la pantalla
					    String numeroSinCeros = numero.replaceFirst ("^0*", "");
					    log.debug("Numeros sin ceros: "+numeroSinCeros);
					    detalle.findElement("detallePagoPublico/numeroCompletoSinCeros").setText(numeroSinCeros);
		    
					    //numero completo le agrego un cero para el input del valida acceso
					    numeroAux = "0"+numeroSinCeros;
					    log.debug("Numero Auxiliar: "+numeroAux);
					    
					    detalle.findElement("detallePagoPublico/numeroCompleto").setText(numeroAux);										
					
					} else {
						 
						//numero completo sin ceros para mostrar en la pantalla
					    String numeroSinCeros = numero.replaceFirst ("^0*", "");
					    log.debug("Numeros sin ceros: "+numeroSinCeros);
					    detalle.findElement("detallePagoPublico/numeroCompletoSinCeros").setText(numeroSinCeros);					
					    detalle.findElement("detallePagoPublico/numeroCompleto").setText(numeroSinCeros);	
					}
					
				}				
			}
		}
		catch(Exception e){
			log.error("Error al obtener los parametros de la URL para pago Mobile : " + e);
			webAppAccess.callMethod("AL_errorGenerico");
		}


	}

	/*
	 * Metodo que asigna los valores al input del servicio consultaSaldoFija
	 */
	public void setInputConsultaSaldoFijo(WebAppAccess webAppAccess){
		log.debug("##### Inicio setInputConsultaSaldoFijo #####");

		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String codArea = detalle.findElement("detallePagoPublico/codAreaAPagar").getText();//"009";
		String numero = detalle.findElement("detallePagoPublico/numeroFijo").getText();//"44397639";


		IXml input = webAppAccess.getVariables().getXml("V_inputConsultaDeSaldoFija");
		input.findElement("SALDOFCOOperation/SALDOS/CLIENTE/TELEFONO/AREA").setText(codArea);
		input.findElement("SALDOFCOOperation/SALDOS/CLIENTE/TELEFONO/NRO").setText(numero);
		input.findElement("SALDOFCOOperation/SALDOS/SOLICITUD/ID_AGENTE").setText("1010");
		input.findElement("SALDOFCOOperation/SALDOS/SOLICITUD/ID_AGENCIA").setText("1010");
		input.findElement("SALDOFCOOperation/SALDOS/SOLICITUD/FECHA").setText("");
		input.findElement("SALDOFCOOperation/SALDOS/SOLICITUD/ID_CORRELACION").setText("1");
		log.debug("El input consultaSaldoFija es : "+input);
	}

	/*
	 * Metodo que asigna los valores al input del servicio consultaSaldoMovil
	 */
	public void setInputConsultaSaldoMovil(WebAppAccess webAppAccess){
		log.debug("##### Inicio setInputConsultaSaldoMovil #####");

		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String celular = detalle.findElement("detallePagoPublico/numeroMovil").getText();


		IXml input = webAppAccess.getVariables().getXml("V_inputConsultaSaldoMovil");
		input.findElement("SALDOMCOOperation/SALDOS/CLIENTE/MOVIL").setText("0"+celular);
		input.findElement("SALDOMCOOperation/SALDOS/SOLICITUD/ID_AGENTE").setText("1010");
		input.findElement("SALDOMCOOperation/SALDOS/SOLICITUD/ID_AGENCIA").setText("1010");
		input.findElement("SALDOMCOOperation/SALDOS/SOLICITUD/FECHA").setText(""); // Setear fecha?
		input.findElement("SALDOMCOOperation/SALDOS/SOLICITUD/ID_CORRELACION").setText("1");
		log.debug("El input consultaSaldoMovil es : "+input);
	}


	public void validaRespuestaConsultaSaldo(WebAppAccess webAppAccess){

		log.debug("Validando respuesta consulta saldo");
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String segmento  = detalle.findElement("detallePagoPublico/segmento").getText();
		if(segmento.equals("movil")){
			log.debug("Respuesta cobsulta saldo movil : " + webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoMovil"));
		}
		else{
			log.debug("Respuesta consulta saldo fija : " + webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija"));
		}
	}

	public boolean tieneDeuda(WebAppAccess webAppAccess){

		log.debug("Validando deuda cliente");

		boolean tieneDeuda = true;
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String segmento  = detalle.findElement("detallePagoPublico/segmento").getText();


		if(segmento.trim().equals("movil")){
			IXml resConsultaSaldoMovil = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoMovil");
			log.debug("Respuesta consulta saldo movil : " + resConsultaSaldoMovil);
			String monto = resConsultaSaldoMovil.findElement("SALDOMCOOperationResponse/SALDOS/DOC/MONTO").getText();
			log.debug("Monto a pagar movil : " + monto);
			int montoInt = 0;
			try{
				montoInt = Integer.parseInt(monto);
				if(montoInt == 0){
					log.debug("Numero sin deuda");
					tieneDeuda = false;
				}
			}
			catch(NumberFormatException e){
				log.debug("Error al parsear el monto movil " + e);
				tieneDeuda = false;
			}
		}
		else{
			IXml resCosultaSaldoFija = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija");
			log.debug("Respuesta consulta saldo fijo : " + resCosultaSaldoFija);
			String codError = resCosultaSaldoFija.findElement("SALDOFCOOperationResponse/SALDOS/COD_ERROR").getText();
			log.debug("El codigo error de consulta saldo fijo es : " + codError);
			if(codError.trim().equals("9005")){
				log.debug("Numero sin deuda");
				tieneDeuda = false;
			}
		}
		return tieneDeuda;
	}


	public void setInputValidaAcceso(WebAppAccess webAppAccess){
		log.debug("####### Entrada al metodo setInputValidaAcceso #######");
		
		try{
			/*Datos necesarios*/
			IXml inputValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_input");
			IXml resConsultaSaldo = null;
			//IXml session = webAppAccess.getVariables().getXml("V_VariablesSesion");

			IXml detallePago = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
			log.debug("Detalle pago : " + detallePago);
			String procedencia = "publico";
			String segmento = ""; //:TODO validar el segmento

			if(  detallePago.findElement("detallePagoPublico/segmento").getText().equals("movil") ){
				resConsultaSaldo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoMovil");
			}
			else{
				resConsultaSaldo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija");
			}




			/*Nodo autentificacion*/
			String id_empresa = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_ID_EMPRESA");
			String id_canal = "";
			String password_canal = "";
			String pag_respuesta_gateway = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_PAG_RESP");

			/*Nodo cliente*/
			String id_rut = "";
			String id_nombre = "";
			String num_cliente = "";
			String num_celular = "";
			String tel_fijo = "";
			String email = "";
			if(procedencia.trim().equals("publico")){//Para publico

				String canalMobile = detallePago.findElement("detallePagoPublico/canal").getText();
				log.debug("Canal Mobile: "+canalMobile);

				webAppAccess.getVariables().setString("V_IDCanal", "");
				id_canal = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_ID_CANAL_MOBILE");
				webAppAccess.getVariables().setString("V_IDCanal", id_canal);
				log.debug("DEVETEL_ID_CANAL_MOBILE: "+id_canal);

				password_canal = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_PASSWORD_CANAL_MOBILE");
				detallePago = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
				segmento = detallePago.findElement("detallePagoPublico/segmento").getText();
				// Para publico rellenar estos datos con 000000
				id_rut = "00000000-0"; 			// DATO EN DURO
				id_nombre = "Cliente anonimo"; 	// DATO EN DURO
				num_cliente = "00000000000"; 	// DATO EN DURO
				email = "sinmail@sinmail.com"; 	// DATO EN DURO
			}

			/*Nodo detalle compra*/
			String cant_productos = "01";
			String fecha_venc = null;
			String monto_total = null;
			String numero_orden = null;
			String folio = null;

			/*Nodo producto*/
			String id_tipo_producto = "01";
			String id_monto_unitario = null;

			log.debug("El segmento al setear el input de ValidaAcceso es : " + segmento);
			if(segmento.trim().equals("fijo")){//Para fijo
				// Si la procedencia es publico
				if(procedencia.trim().equals("publico")){
					String aux = detallePago.findElement("detallePagoPublico/numeroCompleto").getText();
					tel_fijo = aux.replace("-", "");				
				}
				// Si está pagando ambas deudas - vencida/por vencer
				if (estaPagandoAmbas(webAppAccess)){
					log.debug("Fijo que paga ambas");
					fecha_venc = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/FECHA_VENCIMIENTO").getText();
					monto_total = ""+(Integer.parseInt(resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/MONTO").getText())/100);
					numero_orden = webAppAccess.getVariables().getString("V_OrdenDeCompra");
					folio = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/NRO").getText();
					id_monto_unitario = monto_total;
				}
				// Si paga solo la vencida
				else{
					log.debug("Fijo que paga solo vencida");
					fecha_venc = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/FECHA_VENCIMIENTO").getText();
					monto_total = ""+(Integer.parseInt(resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC_VENCIDO/MONTO").getText())/100);
					numero_orden = webAppAccess.getVariables().getString("V_OrdenDeCompra");
					folio = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC_VENCIDO/NRO").getText();
					id_monto_unitario = monto_total;
				}
			}
			else{//Para movil			
				num_cliente = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/ID_CLIENTE").getText();
				// Si la procedencia es publico	
				if(procedencia.trim().equals("publico")){
					num_celular = detallePago.findElement("detallePagoPublico/numeroMovil").getText();
				}
				fecha_venc = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/FECHA_VENCIMIENTO").getText();
				monto_total = ""+(Integer.parseInt(resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/MONTO").getText())/1);
				numero_orden = webAppAccess.getVariables().getString("V_OrdenDeCompra");
				folio = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/NRO").getText();
				id_monto_unitario = monto_total;
			}

			// Datos comunes para fijo y para movil
			if(procedencia.trim().equals("publico")){
				//Guardo el monto total a pagar en la variable detallePagoPublico
				detallePago.findElement("detallePagoPublico/montoAPagar").setText(monto_total);
			}
			else{
				//Guardo el monto total a pagar en la variable detallePago
				detallePago.findElement("detallePago/montoAPagar").setText(monto_total);
			}
			log.debug("Asignando valores al input de valida acceso");
			log.debug("ID_CANAL: "+id_canal);
			//Se asignan los valores a la variable del tipo input
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/COD_PORTADOR").setText("");
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/EMPRESA").setText(id_empresa);
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/ID_CANAL").setText(id_canal);
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/PAG_RESP").setText(pag_respuesta_gateway);
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/PASSWORD_CANAL").setText(password_canal);
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/SERVICIO").setText("");
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/OPTIONAL1").setText(folio);
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/OPTIONAL2").setText("");
			inputValidaAcceso.findElement("validaAcceso/AUTENTIFICACION/TIPO_REGISTRO").setText("");

			inputValidaAcceso.findElement("validaAcceso/CLIENTE/ID_RUT").setText(id_rut);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/NOMBRE").setText(id_nombre);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/NUM_CLIENTE").setText(num_cliente);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/DIRECCION").setText("");
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/EMAIL").setText(email);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/ID_NUM_CELULAR").setText(num_celular);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/ID_TEL_FIJO").setText(tel_fijo);
			inputValidaAcceso.findElement("validaAcceso/CLIENTE/REGION").setText("");

			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/CANT_PRODUCTOS").setText(cant_productos);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/FECHA_VENC").setText(fecha_venc);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/MONTO_TOTAL").setText(Utiles.formatoMontoDevetel(monto_total));
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/NUM_ORDEN").setText(numero_orden);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/PARAM_RESP").setText("");
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/TIPO_DOC").setText("");

			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/CANTIDAD_PRODUCTOS").setText(cant_productos);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/FECHA_VENC").setText(fecha_venc);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/ID_PRODUCTO").setText(id_tipo_producto);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/ID_TIPO_PRODUCTO").setText(id_tipo_producto);
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/MONTO_UNITARIO").setText(Utiles.formatoMontoDevetel(id_monto_unitario));
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/GLOSA").setText("");
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/MARCA").setText("");
			inputValidaAcceso.findElement("validaAcceso/DETALLE_COMPRA/productos/TIPO_DOC").setText("");

			log.debug("El input de ValidaAcceso es : " + inputValidaAcceso);
		}
		catch(Exception e){
			log.error("Error en el metodo input valida acceso : " + e);
			webAppAccess.callMethod("AL_errorGenerico");
		}
	}


	public boolean estaPagandoAmbas(WebAppAccess webAppAccess){
		// La variable V_tipoDeuda, es asignada en el AL_APaso2Privado y  AL_APaso3Publico
		// dependiendo de la procedencia
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		log.debug("El tipo deuda a pagar es : " + tipoDeuda);
		if(tipoDeuda.trim().equals("total")){
			return  true;
		}			
		else{
			String deudaVencida = detalle.findElement("detallePagoPublico/montoVencido").getText();
			detalle.findElement("detallePagoPublico/montoAPagar").setText(deudaVencida);
			return  false;
		}			
	}





	/*
	 * Metodo que asigna los valores al esquema solicitud de credito
	 * y luego lo encripta, para posteriormente asignar el value al input hidden
	 * del la pagina "PasoPago" por medio del builder EA_campoOcultoPublico , EA_campoOcultoPrivado
	 */
	public String encriptaSolicitudCredito(WebAppAccess webAppAccess){
		log.debug("Entrada al metodo encriptaSolicitudCredito");
		String campo = "";
		IXml esquemaSolicitudCredito = webAppAccess.getVariables().getXml("V_EsquemaInputSolicitudCredito");
		IXml resValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");
		IXml detallePago;
		String id_medioPago;

		log.debug("La procedencia es publico");
		detallePago = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		id_medioPago = detallePago.findElement("detallePagoPublico/medioDePago").getText();


		log.debug("Asigno valores");
		String id_canal = resValidaAcceso.findElement("return/AUTENTIFICACION/ID_CANAL").getText();
		String id_trx = resValidaAcceso.findElement("return/AUTENTIFICACION/ID_TRX").getText();

		esquemaSolicitudCredito.findElement("solicitarCredito/ID_CANAL").setText(id_canal);
		esquemaSolicitudCredito.findElement("solicitarCredito/ID_MEDIO_PAGO").setText(id_medioPago);
		esquemaSolicitudCredito.findElement("solicitarCredito/ID_TRX").setText(id_trx);
		log.debug("Encriptando : " + campo);
		campo = EncriptadorUtil.encripta(esquemaSolicitudCredito.toString());
		log.debug("Termine de encriptar : " + campo);
		return campo;
	}

	/*
	 * Metodo que genera la orden de compra que estará asociada al pago
	 * el formato es :
	 * año + mes + dia + hora + minuto + segundo + numero a pagar
	 * @return OC retorna la orden de compra.
	 */
	public void generaOrdenDeCompra(WebAppAccess webAppAccess){
		log.debug("########## Entrada al metodo genera orden de compra ###########");
		IXml detallePago = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String segmento = detallePago.findElement("detallePagoPublico/segmento").getText();
		String oc = "";
		String ultimosDigitos = "";
		String numero = "";

		if(segmento.trim().equals("fijo")){
			numero = detallePago.findElement("detallePagoPublico/numeroFijo").getText();
		}
		else{
			numero = detallePago.findElement("detallePagoPublico/numeroMovil").getText();
		}
		try{
			ultimosDigitos = numero.substring(numero.length() - 3);
		}
		catch(Exception e){
			log.error("Error al obtener los ultimos numeros de la linea");
		}
		if(segmento.trim().equals("fijo")){
			oc += "F";
		}
		else{
			oc += "M";
		}		
		oc += System.currentTimeMillis();
		oc += ultimosDigitos;
		log.debug("La orden de compra es : " + oc);
		webAppAccess.getVariables().setString("V_OrdenDeCompra", oc);
		detallePago.findElement("detallePagoPublico/oc").setText(oc);
		log.debug("Variable OC : " + webAppAccess.getVariables().getString("V_OrdenDeCompra"));
	}

	public void setInputConsultaCuentasEU(WebAppAccess webAppAccess){
		IXml inputConsultaCuentasEU = webAppAccess.getVariables().getXml("V_consultaCuentasInput");
		String codCliente = "";
		IXml datosPagoPublico = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String segmento = datosPagoPublico.findElement("detallePagoPublico/segmento").getText();
		IXml outputClienCtaLatamPorFono = webAppAccess.getVariables().getXml("V_outputConsClienCtaLatamPorFono");		
		if(segmento.trim().equals("fijo")){			
			codCliente = outputClienCtaLatamPorFono.findElement("PQFW0042OperationResponse/regfis_salida/capa_fis_o_salida/mso_pqw0042o/mso_cod_cta_ori_sn").getText();
			inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_cod_ori_cta_cd").setText("001");
		}
		else{
			IXml responseConsultaSaldoMovil = webAppAccess.getVariables().getXml("V_responseConsultaSaldo");
			codCliente = responseConsultaSaldoMovil.findElement("SALDOMCOOperationResponse/SALDOS/DOC/ID_CLIENTE").getText();
			inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_cod_ori_cta_cd").setText("002");
		}
		inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_cod_cta_cd").setText(codCliente);		
		inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_indica_cursor").setText("P");
		inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_correlativo").setText("0");
		inputConsultaCuentasEU.findElement("EUWB2100Operation/regsoa_entrada/capa_fis_i_entrada/msi_euw2100i/msi_ind_vigente").setText("V");	
		log.debug("El input de ConsultaCuentasEU es : " + inputConsultaCuentasEU);
	}





	/*
	 * Metodo que genera el paso 2 publico, dependiendo si el numero consultado es fijo o movil
	 * @return html retorna el HTML que será presentado en el paso 2 con el detalle de la deuda del numero asociado.
	 */
	public String generaDetalleDeudaPublico(WebAppAccess webAppAccess){

		StringBuffer sb = new StringBuffer();		
		IXml resConsultaSaldo = null;
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");

		if(detalle.findElement("detallePagoPublico/segmento").getText().equals("movil")){
			resConsultaSaldo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoMovil");
		}
		else{
			resConsultaSaldo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija");
		}


		String segmento = "";
		if(detalle.findElement("detallePagoPublico/segmento").getText().trim().equals("fijo")){
			segmento = "F";
		}else{
			segmento = "M";
		}		
		try{
			if(segmento.trim().equals("F")){ // Para fijo
				// Logica para saber si tiene deuda vencida
				log.debug("#####################Entrando a la logica para ver si tiene deuda vencida###############");
				boolean vencidaPorVencer = false;
				String docVencido = "";
				String montoVencido = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC_VENCIDO/MONTO").getText();
				log.debug("Monto vencido: "+montoVencido);

				if(Integer.parseInt(montoVencido.trim()) > 0){
					docVencido = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC_VENCIDO/NRO").getText();
					log.debug("Documento vencido: "+docVencido);
					vencidaPorVencer = true;
				}			
				String fechaVencimiento = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/FECHA_VENCIMIENTO").getText();
				String numBoleta = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/NRO").getText();
				log.debug("Numero de boleta: "+numBoleta);
				String montoAPagar = resConsultaSaldo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/MONTO").getText();
				log.debug("Monto a pagar: "+montoAPagar);
				//Se formatean los montos 
				String montoAPagarSinCeros = ""+(Integer.parseInt(montoAPagar)/100);
				String montoVencidoSinCeros = ""+(Integer.parseInt(montoVencido)/100);
				int montoTotal = 0;
				String montoPorVencer = ""+((Integer.parseInt(montoAPagar)/100) - (Integer.parseInt(montoVencido)/100));

				// Formateo la fecha
				String fechaAParsear = fechaVencimiento.substring(6,8)+ "-" + fechaVencimiento.substring(4, 6)+"-" + fechaVencimiento.substring(0, 4);
				String fechaVencimientoFormato = fechaAParsear;

				if(vencidaPorVencer){// Si tiene deuda vencida y por vencer
					try{
						montoTotal = Integer.parseInt(montoAPagarSinCeros);
						detalle.findElement("detallePagoPublico/montoAPagar").setText(String.valueOf(montoTotal));
					}catch(NumberFormatException e){
						log.error("Ocurrio un error al tratar de sumar los montos de ambas deudas");
					}						
					sb.append("<div class=\"span8\">");
					sb.append("<div class=\"detalle-boleta\">");
					sb.append("<div class=\"mensaje-boleta\" id=\"mensaje-boleta-"+docVencido+"\" onclick=\"$(this).fadeOut();\" style=\"display: none;\">&#161;Woops! Debes pagar esta cuenta vencida antes que las dem&aacute;s</div>");
					sb.append("<label class=\"boleta activo\">");
					sb.append("<div class=\"span4 valor\"> \r\n" +
							"  			<p class=\"check\"><input id=\"montoVencido\" name=\"montoVencido\" disabled=\"disabled\" type=\"checkbox\" checked=\"checked\" class=\"valor-boleta\" value=\""+montoVencidoSinCeros+"\" ></p>\r\n"+
							"            <p class=\"monto\"><strong>"+ Utiles.separadorMiles(montoVencidoSinCeros)+"</strong></p> \r\n"+
							"			<p class=\"serie\">N&#186; "+docVencido+"</p> \r\n"+
					"	   </div> ");
					sb.append("<div class=\"span4 detalles\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"serie\">N&#186; "+docVencido+"</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"estatus span4\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"etiqueta\">vencida</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"clear\"></div>");
					sb.append("</label> ");
					sb.append("<label class=\"boleta activo\">");
					sb.append("<div class=\"span4 valor\"> \r\n" +
							"  			<p class=\"check\"><input id=\"montoPendiente\" name=\"montoPendiente\" type=\"checkbox\" value=\""+montoPorVencer+"\" class=\"valor-boleta\"></p>\r\n"+
							"           <p class=\"monto\"><strong>"+ Utiles.separadorMiles(montoPorVencer)+"</strong></p> \r\n"+
							"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
					"	   </div> ");
					sb.append("<div class=\"span4 detalles\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"estatus span4\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"etiqueta\">Por vencer</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"clear\"></div>");
					sb.append("</label> ");
					sb.append("</div> ");
					sb.append("</div> ");

				}
				else{ //Solo deuda por vencer
					try{
						montoTotal = Integer.parseInt(montoAPagarSinCeros);
						detalle.findElement("detallePagoPublico/montoAPagar").setText(String.valueOf(montoTotal));
					}catch(NumberFormatException e){
						log.error("Ocurrio un error al tratar de generar el monto de la deuda");
					}
					sb.append("<div class=\"span8\">");
					sb.append("<div class=\"detalle-boleta una-boleta\">");
					sb.append("<label class=\"boleta\">");
					sb.append("<div class=\"span4 valor\"> \r\n" +
							"  			<p class=\"check\"><input id=\"montoPendiente\" type=\"checkbox\" value=\""+montoAPagarSinCeros+"\" class=\"valor-boleta\"></p>\r\n"+
							"            <p class=\"monto\">$<strong>"+separadorMilesSinSigno(montoAPagarSinCeros)+"</strong></p> \r\n"+
							"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
					"	   </div> ");
					sb.append("<div class=\"span4 detalles\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"estatus span4\"> \r\n" +
							"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
							"			<p class=\"etiqueta\">Por vencer</p> \r\n"+
					"	  </div> ");
					sb.append("<div class=\"clear\"></div>");
					sb.append("</label> ");
					sb.append("</div> ");
					sb.append("</div> ");
				}				
			}
			else{// Para Movil
				log.debug("Generando paso para MOVIL.............");
				String fechaVencimiento = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/FECHA_VENCIMIENTO").getText();
				String numBoleta = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/NRO").getText();
				String montoAPagar = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/MONTO").getText();
				String numeroMovil = resConsultaSaldo.findElement("SALDOMCOOperationResponse/SALDOS/DOC/MOVIL").getText();
				//Se le quitan los ceros al monto
				String montoAPagarSinCeros = ""+Integer.parseInt(montoAPagar)/1;
				//Se guarda el monto a pagar 
				detalle.findElement("detallePagoPublico/montoAPagar").setText(montoAPagarSinCeros);
				//Se guarda la linea movil
				detalle.findElement("detallePagoPublico/numeroMovil").setText(numeroMovil);

				// Formateo la fecha
				String fechaAParsear = fechaVencimiento.substring(6,8)+ "-" + fechaVencimiento.substring(4, 6)+"-" + fechaVencimiento.substring(0, 4);
				String fechaVencimientoFormato = fechaAParsear;
				sb.append("<div class=\"span8\">");
				sb.append("<div class=\"detalle-boleta una-boleta\">");
				sb.append("<label class=\"boleta\">");
				sb.append("<div class=\"span4 valor\"> \r\n" +
						"  			<p class=\"check\"><input type=\"checkbox\" checked=\"checked\" value=\""+montoAPagarSinCeros+"\" class=\"valor-boleta\"></p>\r\n"+
						"            <p class=\"monto\">$<strong>"+separadorMilesSinSigno(montoAPagarSinCeros)+"</strong></p> \r\n"+
						"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
				"	   </div> ");
				sb.append("<div class=\"span4 detalles\"> \r\n" +
						"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
						"			<p class=\"serie\">N&#186; "+numBoleta+"</p> \r\n"+
				"	  </div> ");
				sb.append("<div class=\"estatus span4\"> \r\n" +
						"			<p class=\"fecha\">"+fechaVencimientoFormato+"</p> \r\n"+
						"			<p class=\"etiqueta\">Por vencer</p> \r\n"+
				"	  </div> ");
				sb.append("<div class=\"clear\"></div>");
				sb.append("</label> ");
				sb.append("</div> ");
				sb.append("</div> ");

			}
			//sb.append("</div>");
			sb.append("<div class=\"clear\"></div>");
			sb.append("<div class=\"seleccion-pago\">"); 
			sb.append("<p>Selecciona el medio de pago</p>");

			// Pinto los medios de pago
			IXml res_ValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");

			log.debug("Respuesta validaAcceso : " + res_ValidaAcceso);

			Iterator<?> it = res_ValidaAcceso.findElement("return/MEDIOS_PAGO_LIST").getChildren().iterator();
			log.debug("Iterator");
			sb.append("<div id=\"mediodepago\" class=\"opciones-pago\">"); 

			
			while (it.hasNext())	
			{
				// genera medios de pago iterando las listas
				IXml medio_pago = (IXml)it.next();
				log.debug("Hijo");
				String nombreMedioPago = medio_pago.findElement("MEDIO_PAGO/NOMBRE_MEDIO_PAGO").getText();
				String urlMedioPago = medio_pago.findElement("MEDIO_PAGO/URL_MEDIO_PAGO").getText();
				String imagenMedioPago = medio_pago.findElement("MEDIO_PAGO/IMG_MEDIO_PAGO").getText();
				String idMedioPago = medio_pago.findElement("MEDIO_PAGO/ID_MEDIO_PAGO").getText();

				log.debug("Valores");
				String labelMedioPago = nombreMedioPago;
				String descripcionMedioPago = ": Tarjeta de Cr&eacute;dito o Redcompra";

				//String IDcanal = webAppAccess.getVariables().getString("V_IDCanal").trim();
				//log.debug("V_IDCanal: "+IDcanal);
				log.debug("Generando medio");
				
				//Aqui comienza logica para visibilidad del medio por prefereces
				
				String prefVisibilidad = (String) webAppAccess.callMethod("M_getPreference", "V_VisibilidadMediosDePago");
				log.debug("La variable de visibilidad es : " + prefVisibilidad);
				
				String [] mediosVis = prefVisibilidad.split(";");
				log.debug("Hay " + mediosVis.length + " medios en las preferences");
				

				boolean visible = true;
				
				for(int i = 0 ; i < mediosVis.length ; i++){
					
					String [] regVis = mediosVis[i].split("=");
					
					String nombre = regVis[0];
					String vis = regVis[1];
					
					if (nombreMedioPago.equals(nombre)){
						
						log.debug("El medio de pago " + nombre + " es visible ? : " + vis);
						visible = (vis.equals("true")) ? true :false ;
						break;
					}
					
				}
				if (visible){
					sb.append("<label class=\"radio checked\">\r\n"+
							
							" 	 <input  type=\"radio\" value=\""+ idMedioPago + "\"name=\"medios\" checked=\"checked\">\r\n" +   
							" 	 <span><div class=\"logo-pago\"><img id=\""+nombreMedioPago+"\" src=\""+imagenMedioPago+"\" width=\"\" height=\"\" alt=\""+ nombreMedioPago +"\"></div><p><strong>"+labelMedioPago+" </strong>"+descripcionMedioPago+"</p></span>\r\n" + 						  
					"	   </label>");
				}
				
				
				

			}
			
			log.debug("Generando boton");
			sb.append("</div>");
			sb.append("<button id=\"btn-recargar\" class=\"btn-block\" type=\"submit\">Pagar $<span class=\"montoPago\">"+separadorMilesSinSigno(detalle.findElement("detallePagoPublico/montoAPagar").getText())+"</span> con <span class=\"medioDePago\">WebPay"+"</span> </button>");
			sb.append("</div>");
			sb.append("<input type=\"hidden\" id=\"tipoDeuda\" name=\"tipoDeuda\" value=\"total\">");
			//sb.append("<input type=\"hidden\" id=\"montoPagarBoton\" name=\"montoPagarBoton\" value=\"total\">");
		}

		
		catch(Exception e){
			e.printStackTrace();
			log.error("Error al generar el detalle de la deuda");
		}		
		log.debug("HTML : " + sb.toString());
		return sb.toString();
	}


	public String generaComprobanteEnLinea(WebAppAccess webAppAccess){
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		IXml resValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");		


		SimpleDateFormat formato = new SimpleDateFormat("dd/MMMM/yyyy", new Locale("ES"));
		String fechaActual = formato.format(new Date());

		String dia = detalle.findElement("detallePagoPublico/diaActual").getText();
		String mes = detalle.findElement("detallePagoPublico/mesActual").getText();  
		String anio = detalle.findElement("detallePagoPublico/anioActual").getText();
		String hora = detalle.findElement("detallePagoPublico/horaActual").getText();


		String fechaPago = fechaActual;
		String numeroPagado = detalle.findElement("detallePagoPublico/numeroCompleto").getText();
		String montoPagado = detalle.findElement("detallePagoPublico/montoAPagar").getText();
		String folioPagado = null;
		String ordenDeCompra = detalle.findElement("detallePagoPublico/oc").getText();
		String codigoTransaccion = resValidaAcceso.findElement("return/AUTENTIFICACION/ID_TRX").getText();
		String tarjetaCredito = detalle.findElement("detallePagoPublico/tarjetaCredito").getText();
		String numeroCuotas = detalle.findElement("detallePagoPublico/numeroCuotas").getText();
		String montoCuota = detalle.findElement("detallePagoPublico/montoCuota").getText();
		String codAutorizacion  = detalle.findElement("detallePagoPublico/codAutorizacion").getText();
		//String nombreMedioPago = "Webpay";
		String nombreMedioPago  = detalle.findElement("detallePagoPublico/nombreMedioPago").getText();

		
		/*Datos para certificación en transbank*/
		String tipoTransaccion = "Pago";
		String tipoTarjeta = detalle.findElement("detallePagoPublico/tipoTarjeta").getText();
		String tipoCuota = detalle.findElement("detallePagoPublico/tipoCuota").getText();

		if (tipoTarjeta.trim().equals("Crédito")){
			tipoTarjeta = "Cr&eacute;dito";
		}
		if (tipoCuota.trim().equals("Sin interés")){
			tipoCuota = "Sin inter&eacute;s";
		}
		if (tipoCuota.trim().equals("Venta débito")){
			tipoCuota = "Venta d&eacute;bito";
		}

		//Se obtiene el tipo de deuda que está pagando y el folio asociado
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		if(tipoDeuda.trim().equals("total")){
			folioPagado = detalle.findElement("detallePagoPublico/documentoActual").getText();
		}
		else{
			folioPagado = detalle.findElement("detallePagoPublico/documentoVencido").getText();
		}

		StringBuffer sb = new StringBuffer();

		sb.append("<div class=\"row-fluid\">");
		sb.append("<h4>Tu boleta ha sido pagada</h4>\r\n");
		sb.append("<p>La boleta n&uacute;mero <strong>" + folioPagado + "</strong> por un monto de <strong>" + Utiles.separadorMiles(montoPagado) + "</strong> ha sido pagada con &eacute;xito a las <strong>"+hora+ " hrs</strong> del "+dia+" de "+mes+" de "+anio+" a trav&eacute;s de " + nombreMedioPago +".</p>");

		sb.append("<table class=\"table\" id=\"tabla-comprobante\">"); 
		sb.append("<tbody>");
		sb.append("<tr>\r\n" +
				"		  <td>Monto pagado</td>\r\n" +
				"		  <td>" + Utiles.separadorMiles(montoPagado) + "</td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>N&uacute;mero de Folio</td>\r\n" +
				"		  <td>" + folioPagado + "</td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>N&uacute;mero de orden</td>\r\n" +
				"		  <td> " + ordenDeCompra + " </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>Fecha de transacci&oacute;n</td>\r\n" +
				"		  <td> " + fechaPago + " </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>C&oacute;digo de transacci&oacute;n</td>\r\n" +
				"		  <td> " + codigoTransaccion + "</td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>&Uacute;ltimos 4 d&iacute;gitos de la tarjeta</td>\r\n" +
				"		  <td>" + tarjetaCredito + "</td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>N&uacute;mero de cuotas</td>\r\n" +
				"	  	  <td> "+ numeroCuotas +" </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>Monto cuota</td>\r\n" +
				"		  <td> " + montoCuota + " </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>C&oacute;digo autorizaci&oacute;n</td>\r\n" +
				"		  <td> " + codAutorizacion + "</td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>Tipo de transacci&oacute;n</td>\r\n" +
				"		  <td> "+ tipoTransaccion +" </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>Tipo de tarjeta</td>\r\n" +
				"		  <td> " + tipoTarjeta + " </td>\r\n" +
		"	  </tr>");
		sb.append("<tr>\r\n" +
				"		  <td>Tipo de cuotas</td>\r\n" +
				"		  <td> " + tipoCuota + " </td>\r\n" +
		"	  </tr>");
		sb.append("</tbody>");
		sb.append("</table>");

		sb.append("<p><small>Recuerda que si el servicio estaba suspendido lo reestableceremos lo antes posible en un m&aacute;ximo de 24 horas y que el pago puede reflejarse el día h&aacute;bil siguiente.</small></p>");
		sb.append("<br><br>");
		sb.append("<p>&#161;Esperamos que tengas un gran d&iacute;a!</p>");
		sb.append("</div>"); 

		return sb.toString();
	}


	public String generaCuerpoCorreoPublico(WebAppAccess webAppAccess){		
		log.debug("Ingresa al metodo generaCuerpoCorreoPublico");
		StringBuffer sb = new StringBuffer();
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		IXml resValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");		

		SimpleDateFormat formatoComprobante = new SimpleDateFormat("dd/MMMM/yyyy hh:mm" , new Locale("ES"));
		Date hoy = new Date();

		String fechaActual = formatoComprobante.format(hoy);
		String[] splitFecha = fechaActual.split("/|\\ ");
		String dia = splitFecha[0];
		String mes = splitFecha[1];
		mes = mes.substring(0, 1).toUpperCase() + mes.substring(1);

		String anio = splitFecha[2];
		String hora = splitFecha[3];

		String fechaPago = fechaActual;
		String numeroPagado = detalle.findElement("detallePagoPublico/numeroCompleto").getText();
		log.debug("numeroPagado: "+numeroPagado);
		String montoPagado = detalle.findElement("detallePagoPublico/montoAPagar").getText();
		log.debug("montoPagado: "+montoPagado);
		String folioPagado = null;
		String ordenDeCompra = webAppAccess.getVariables().getString("V_OrdenDeCompra");
		log.debug("ordenDeCompra: "+ordenDeCompra);
		String codigoTransaccion = resValidaAcceso.findElement("return/AUTENTIFICACION/ID_TRX").getText();
		log.debug("codigoTransaccion: "+codigoTransaccion);
		String tarjetaCredito = detalle.findElement("detallePagoPublico/tarjetaCredito").getText();
		log.debug("tarjetaCredito: "+tarjetaCredito);
		String numeroCuotas = detalle.findElement("detallePagoPublico/numeroCuotas").getText();
		log.debug("numeroCuotas: "+numeroCuotas);
		String montoCuota = detalle.findElement("detallePagoPublico/montoCuota").getText();
		log.debug("montoCuota: "+montoCuota);
		String codigoAutorizacion = detalle.findElement("detallePagoPublico/codAutorizacion").getText();
		log.debug("codigoAutorizacion: "+codigoAutorizacion);

		/*Datos para certificación en transbank*/
		String tipoTransaccion = "Pago";
		String tipoTarjeta = detalle.findElement("detallePagoPublico/tipoTarjeta").getText();
		log.debug("tipoTarjeta: "+tipoTarjeta);
		String tipoCuota = detalle.findElement("detallePagoPublico/tipoCuota").getText();
		log.debug("tipoCuota: "+tipoCuota);

		//Se obtiene el tipo de deuda que está pagando y el folio asociado
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		if(tipoDeuda.trim().equals("total")){
			folioPagado = detalle.findElement("detallePagoPublico/documentoActual").getText();
		}
		else{
			folioPagado = detalle.findElement("detallePagoPublico/documentoVencido").getText();
		}
		String imagen1 = (String) webAppAccess.callMethod("M_getPreference", "URLImagen1");//http://sia1.subirimagenes.net/img/2013/11/04/131104074400402111.jpg
		String imagen2 = (String) webAppAccess.callMethod("M_getPreference", "URLImagen2");//http://sia1.subirimagenes.net/img/2013/11/04/131104074618842170.jpg
		String imagen3 = (String) webAppAccess.callMethod("M_getPreference", "URLImagen3");//http://sia1.subirimagenes.net/img/2013/11/04/131104074708647719.jpg

		String codMedioPago = detalle.findElement("detallePagoPublico/medioDePago").getText();
		log.debug("codMedioPago: "+codMedioPago);
		//String nombreMedioPago = "WebPay";
		String nombreMedioPago = detalle.findElement("detallePagoPublico/nombreMedioPago").getText();
		
		log.debug("nombreMedioPago: "+nombreMedioPago);

		sb.append("<style type=\"text/css\">\r\n" + 
				"<!--\r\n" + 
				"    img {display:block;}\r\n" + 
				"-->\r\n" + 
				"</style>\r\n" + 
				"<table id=\"Tabla_01\" width=\"796\" height=\"785\" border=\"0\" cellpadding=\"0\" table-layout=\"fixed\"; cellspacing=\"0\" align=\"center\">\r\n" + 
				"    <tr>\r\n" + 
				"		<td colspan=\"3\" width=\"796\" height=\"45\" style=\"background-color:#00517E\">\r\n" + 
				"		</td>\r\n" + 
				"	</tr>\r\n" + 
		"	<tr>");
		sb.append("<td background=\""+imagen1+"\" colspan=\"3\" width=\"796\" height=\"143\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n" + 
				"			<!--[if gte mso 9]>\r\n" + 
				"			<v:image xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theImage\" style='behavior: url(#default#VML); display:block;position:absolute; height:143px; width:796px;top:0;left:0;border:0;z-index:1;' src=\""+ imagen1 +"\"/>\r\n" + 
				"			<v:shape xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theText\" style='behavior: url(#default#VML); display:block;position:absolute; height:143px; width:796px;top:-5;left:-10;border:0;z-index:2;'>\r\n" + 
				"			<div>\r\n" + 
				"			<![endif]-->\r\n" + 
				"			<!-- This is where you nest a table with the content that will float over the image -->\r\n" + 
				"			<table width=\"796\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n" + 
				"				<tr>\r\n" + 
				"					<td width=\"796\" height=\"143\" valign=\"top\">\r\n" + 
				"				\r\n" + 
				"					</td>\r\n" + 
				"				</tr>\r\n" + 
				"			</table>\r\n" + 
				"			<!-- This ends the nested table content -->\r\n" + 
				"			<!--[if gte mso 9]>\r\n" + 
				"			</div>\r\n" + 
				"			</v:shape>\r\n" + 
				"			<![endif]-->\r\n" + 
				"		</td>"+"\r\n" + 
				"	</tr>\r\n" + 
		"<tr>");
		sb.append("<td background=\""+ imagen2 +"\" height=\"511\" width=\"27\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n" + 
				"		<!--[if gte mso 9]>\r\n" + 
				"		<v:image xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theImage\" style='behavior: url(#default#VML); display:block;position:absolute; height:511px; width:27px;top:0;left:0;border:0;z-index:1;' src=\""+ imagen2 +"\"/>\r\n" + 
				"		<v:shape xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theText\" style='behavior: url(#default#VML); display:block;position:absolute; height:511px; width:27px;top:-5;left:-10;border:0;z-index:2;'>\r\n" + 
				"		<div>\r\n" + 
				"		<![endif]-->\r\n" + 
				"		<!-- This is where you nest a table with the content that will float over the image -->\r\n" + 
				"			<table width=\"27\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n" + 
				"				<tr>\r\n" + 
				"					<td width=\"27\" height=\"511\" valign=\"top\">\r\n" + 
				"					\r\n" + 
				"					</td>\r\n" + 
				"				</tr>\r\n" + 
				"			</table>\r\n" + 
				"		<!-- This ends the nested table content -->\r\n" + 
				"		<!--[if gte mso 9]>\r\n" + 
				"		</div>\r\n" + 
				"		</v:shape>\r\n" + 
				"		<![endif]-->\r\n" + 
		"</td>");		
		//Cuerpo del mail aca
		sb.append("<td valign=\"top\" style=\"padding-top: 0px;\">\r\n" + 
				"			<h1 style=\"color: #006991;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 24px;padding-top: 0px;\">Comprobante de operaci&oacute;n exitosa</h1>\r\n" + 
				"				<p style=\"color: #666666;font-family: Arial,Helvetica,sans-serif;font-size: 14px;padding-top: 20px;line-height: 20px;\">\r\n" + 
				"					Con fecha del <strong style=\"color:#000\"> "+dia+" de "+mes+" de "+anio+" </strong> has realizado el pago de tu deuda asociada al número "+ numeroPagado +" a trav&eacute;s de "+ nombreMedioPago +"\r\n" );

		sb.append("<table style=\"font-size: 13px; border: 1px solid #ccc;\">");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" + 
				"			<td>\r\n" + 
				"				Monto Pagado\r\n" + 
				"			</td>\r\n" + 
				"			<td><span class=\"total\">"+Utiles.separadorMiles(montoPagado)+"</span></td>\r\n" + 
		"		</tr>");
		sb.append("<tr>\r\n" + 
				"			<td>\r\n" + 
				"				N&#250;mero de folio\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				folioPagado+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" + 
				"			<td>\r\n" + 
				"				N&#250;mero de orden\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				ordenDeCompra+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr>\r\n" + 
				"			<td>\r\n" + 
				"				Fecha de transacci&#243;n\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				fechaPago+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" + 
				"			<td>\r\n" + 
				"				C&#243;digo de transacci&#243;n\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				codigoTransaccion+
				"			</td>\r\n"+
		"		</tr>");
		sb.append("<tr>\r\n" + 
				"			<td>\r\n" + 
				"				&Uacute;ltimos 4 d&iacute;gitos de la tarjeta\r\n" +
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				tarjetaCredito+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" + 
				"			<td>\r\n" + 
				"				N&#250;mero de cuotas\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				numeroCuotas+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr >\r\n" + 
				"			<td>\r\n" + 
				"				Monto de cuota\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				montoCuota+ 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" +
				"			<td>\r\n" + 
				"				C&oacute;digo de autorizaci&oacute;n\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				"				" +codigoAutorizacion+"\r\n" + 
				"			</td>\r\n" + 
		"		</tr>");	
		sb.append("<tr>\r\n" +
				"			<td>\r\n" + 
				"				Tipo de transacci&oacute;n\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				"				" +tipoTransaccion+"\r\n" + 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr style=\"background-color: #F5F5F5;\">\r\n" +
				"			<td>\r\n" + 
				"				Tipo de tarjeta\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				"				" +tipoTarjeta+"\r\n" + 
				"			</td>\r\n" + 
		"		</tr>");
		sb.append("<tr>\r\n" +
				"			<td>\r\n" + 
				"				Tipo de cuotas\r\n" + 
				"			</td>\r\n" + 
				"			<td>\r\n" + 
				"				" +tipoCuota+"\r\n" + 
				"			</td>\r\n" + 
		"		</tr>");


		sb.append("</table>");
		sb.append("<p><font face=\"Arial,Helvetica,sans-serif\" color=\"#6e6e6e\" size=\"2\">&#8226; Se est&#225; efectuando un proceso de actualizaci&#243;n de saldo y es posible que el pago se refleje al d&#237;a h&#225;bil siguiente.</font></p>");
		sb.append("<p><font face=\"Arial,Helvetica,sans-serif\" color=\"#6e6e6e\" size=\"2\">&#8226; Si el servicio se encuentra suspendido por no pago, ser&#225; reestablecido en las pr&#243;ximas 24 horas.</font></p>");		
		sb.append("	<center><p style=\"color: #666666;font-family: Arial,Helvetica,sans-serif;font-size: 14px;padding-top: 20px;line-height: 20px;\"><strong style=\"color:#000\">¡Gracias por preferirnos!</strong></p></center>\r\n" + 
				"	<p style=\"color: #666666;font-family: Arial,Helvetica,sans-serif;font-size: 14px;padding-top: 10px;line-height: 20px;\">Saludos Cordiales,</p>\r\n" + 
				"	<a href=\"www.movistar.cl\" title=\"www.movistar.cl\" style=\"color: #006991;font-family: Arial,Helvetica,sans-serif;font-size: 14px;text-decoration: none;padding-top: 20px;line-height: 20px;\">www.movistar.cl</a>\r\n" + 
		"</td>");
		//Fin cuerpo de mail		
		sb.append("<td background=\""+ imagen3 +"\" height=\"511\" width=\"285\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-repeat: no-repeat;\">\r\n" + 
				"			<!--[if gte mso 9]>\r\n" + 
				"			<v:image xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theImage\" style='behavior: url(#default#VML); display:inline-block;position:absolute; height:511px; width:285px;top:0;left:0;border:0;z-index:1;' src=\""+ imagen3 +"\"/>\r\n" + 
				"			<v:shape xmlns:v=\"urn:schemas-microsoft-com:vml\" id=\"theText\" style='behavior: url(#default#VML); display:inline-block;position:absolute; height:511px; width:285px;top:-5;left:-10;border:0;z-index:2;'>\r\n" + 
				"			<div>\r\n" + 
				"			<![endif]-->\r\n" + 
				"			<!-- This is where you nest a table with the content that will float over the image -->\r\n" + 
				"			<table width=\"285\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n" + 
				"				<tr>\r\n" + 
				"					<td width=\"285\" height=\"511\" valign=\"top\">\r\n" + 
				"				\r\n" + 
				"					</td>\r\n" + 
				"				</tr>\r\n" + 
				"			</table>\r\n" + 
				"			<!-- This ends the nested table content -->\r\n" + 
				"			<!--[if gte mso 9]>\r\n" + 
				"			</div>\r\n" + 
				"			</v:shape>\r\n" + 
				"			<![endif]-->\r\n" + 
				"		</td>\r\n" + 
		"	</tr>");
		sb.append("<tr>\r\n" + 
				"		<td colspan=\"3\" width=\"796\" height=\"86\">\r\n" + 
				"			<p style=\"color: #666666;font-family: Arial,Helvetica,sans-serif;font-size: 12px;text-align: center;margin-left: 40px;margin-right: 40px;line-height: 20px;\">\r\n" + 
				"				Este comprobante fue generado autom&aacute;ticamente desde la Sucursal Virtual de Movistar Chile, por favor no responder.\r\n" + 
				"				Para cualquier consulta ingresa a <a href=\"www.movistar.cl\" title=\"www.movistar.cl\" style=\"color: #006991;font-family: Arial,Helvetica,sans-serif;font-size: 14px;\">www.movistar.cl</a>\r\n" + 
				"			</p>\r\n" + 
				"		</td>\r\n" + 
		"	</tr>");
		sb.append("</table>");
		return sb.toString();
	}


	public void inputCorreoPublico (WebAppAccess webAppAccess){
		log.debug("Ingresa al metodo inputCorreoPublico");
		IXml inputMail = webAppAccess.getVariables().getXml("V_input_EnviaMailHTML");
		String emailDestinatario = "";
		try{ 	
			emailDestinatario = webAppAccess.getRequestInputs().getInputValue("input-mail-comprobante");
			log.debug("Email destinatario: "+ emailDestinatario);
			String emailCuerpo = generaCuerpoCorreoPublico(webAppAccess);
			log.debug("Email cuerpo: "+emailCuerpo);
			String emailAsunto = "Comprobante pago Movistar App";
			inputMail.findElement("EnviarEMailHTMLRequest/emailDestinatario").setText(emailDestinatario);
			inputMail.findElement("EnviarEMailHTMLRequest/emailAsunto").setText(emailAsunto);
			inputMail.findElement("EnviarEMailHTMLRequest/cuerpoHTML").setText(emailCuerpo);
		}
		catch (Exception e) {
			log.error("Error al generar el input del servicio de Correo : " + e);
			log.error("El destinatario es : " + emailDestinatario);
		}
	}
	
	
	
	public String generaUrlPdf(WebAppAccess webAppAccess){
		
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		IXml resValidaAcceso = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");		
		SimpleDateFormat formato = new SimpleDateFormat("dd/MM/yyyy");
		String fechaActual = formato.format(new Date());
		String fechaPago = fechaActual;
		
		String urlFinal = "";
		String urlBase = (String) webAppAccess.callMethod("M_getPreference","URL_JSP_PDF");
		
		String OC = detalle.findElement("detallePagoPublico/oc").getText();
		String fecha = fechaPago;
		String num = detalle.findElement("detallePagoPublico/numeroCompleto").getText();
		String monto = detalle.findElement("detallePagoPublico/montoAPagar").getText();
		String folio;
		String trx = resValidaAcceso.findElement("return/AUTENTIFICACION/ID_TRX").getText();
		
		String tipoTarjeta = detalle.findElement("detallePagoPublico/tipoTarjeta").getText().replaceAll("é", "e");;
		String tipoCuota = detalle.findElement("detallePagoPublico/tipoCuota").getText().replaceAll("é", "e");;
		
		if (tipoTarjeta.trim().equals("Crédito")){
			tipoTarjeta = "Credito";
		}
		if (tipoCuota.trim().equals("Sin interés")){
			tipoCuota = "Sin interes";
		}
		if (tipoCuota.trim().equals("Venta débito")){
			tipoCuota = "Venta debito";
		}
		
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		if(tipoDeuda.trim().equals("total")){
			folio = detalle.findElement("detallePagoPublico/documentoActual").getText();
		}
		else{
			folio = detalle.findElement("detallePagoPublico/documentoVencido").getText();
		}
		
		String tCredito = detalle.findElement("detallePagoPublico/tarjetaCredito").getText();
		String numCuotas = detalle.findElement("detallePagoPublico/numeroCuotas").getText();
		String montoCuota = detalle.findElement("detallePagoPublico/montoCuota").getText();
		String codAutorizacion  = detalle.findElement("detallePagoPublico/codAutorizacion").getText();
		//String nombreMedioPago = "WebPay";
		String nombreMedioPago  = detalle.findElement("detallePagoPublico/nombreMedioPago").getText();
		
		urlFinal = urlBase+"?FECHA="+fecha+"&NUM="+num+"&MONTO="+monto+"&FOLIO="+folio+"&OC="+OC+"&TRX="+trx+"&TCREDITO="+tCredito+"&NUMCUOTAS="+numCuotas+"&MONTOCUOTA="+montoCuota+"&CODAUT="+codAutorizacion+"&MEDIOPAGO="+nombreMedioPago+"&TIPOTARJETA="+tipoTarjeta+"&TIPOCUOTA="+tipoCuota;
		log.debug("La URL final para PDF mobile es : " + urlFinal);
		return urlFinal;
	}
	



	public boolean esPagoTotal(WebAppAccess webAppAccess){
		String param = webAppAccess.getRequestInputs().getInputValue("tipoDeuda");
		
		log.debug("El tipo deuda es : " + param);
		String idCanal = webAppAccess.getRequestInputs().getInputValue("medios");
		log.debug("El id medio pago es : " + idCanal);
		
		
		
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		detalle.findElement("detallePagoPublico/medioDePago").setText(idCanal);
		getNombreMedioPagoById(webAppAccess);
		if(param.equals("total")){
			log.debug("Paga el total");
			if(detalle.findElement("detallePagoPublico/segmento").getText().trim().equals("movil")){
				IXml resConsultaMovil = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoMovil");
				detalle.findElement("detallePagoPublico/codigoCliente").setText(resConsultaMovil.findElement("SALDOMCOOperationResponse/SALDOS/DOC/ID_CLIENTE").getText());
				detalle.findElement("detallePagoPublico/documentoVencido").setText("N/A");
				detalle.findElement("detallePagoPublico/montoVencido").setText("N/A");
				detalle.findElement("detallePagoPublico/documentoActual").setText(resConsultaMovil.findElement("SALDOMCOOperationResponse/SALDOS/DOC/NRO").getText());
			}
			else{
				IXml resConsultaFijo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija");
				log.debug("Saldo Fijo - DOC/NRO: " + resConsultaFijo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/NRO").getText());
				detalle.findElement("detallePagoPublico/documentoActual").setText(resConsultaFijo.findElement("SALDOFCOOperationResponse/SALDOS/DOC/NRO").getText());
			}
			return true;
		}
		else{		
			log.debug("Paga solo la vencida");
			IXml resConsultaFijo = webAppAccess.getVariables().getXml("V_respuestaConsultaSaldoFija");
			detalle.findElement("detallePagoPublico/documentoVencido").setText(resConsultaFijo.findElement("SALDOFCOOperationResponse/SALDOS/DOC_VENCIDO/NRO").getText());
			return false;
		}
	}
	
	public void getNombreMedioPagoById(WebAppAccess webAppAccess){
		
		log.debug("Entro a obtener el nombre del medio de pago elegido");
		String nombre = "";
		try{
			
			
			String idMedioElegido = webAppAccess.getVariables().getXml("V_DetallePagoPublico").findElement("detallePagoPublico/medioDePago").getText();
			IXml resValida = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");
			log.debug("El id dl medio en session es : " + idMedioElegido);
			Iterator<IXml> it = resValida.findElement("return/MEDIOS_PAGO_LIST").getChildren().iterator();
			
			
			while(it.hasNext()){
				
				log.debug("Iterand medios....");
				
				IXml medio = it.next();
				String idMedio = medio.findElement("MEDIO_PAGO/ID_MEDIO_PAGO").getText();
				String nombreMedio = medio.findElement("MEDIO_PAGO/NOMBRE_MEDIO_PAGO").getText();
				
				
				if(idMedioElegido.equals(idMedio)){
					nombre = nombreMedio;
					String urlMedio = medio.findElement("MEDIO_PAGO/URL_MEDIO_PAGO").getText();
					webAppAccess.getVariables().getXml("V_DetallePagoPublico").findElement("detallePagoPublico/URLmedioDePago").setText(urlMedio);
					break;
				}
			}
			webAppAccess.getVariables().getXml("V_DetallePagoPublico").findElement("detallePagoPublico/nombreMedioPago").setText(nombre);
		}
		catch(Exception e){
			log.error("Error en metodo getNombreMedioPago : " + e);
		}
	}
	


	public boolean registraInicioPagoEnDB(WebAppAccess webAppAccess){

		log.debug("Registrando inicio de pago en DB");
		boolean correcto = false;
		DBSupport dbs = new DBSupport();

		String procedencia = "AppMobile";
		IXml detallePagoPublico = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		IXml resValida = webAppAccess.getVariables().getXml("V_ValidaAcceso_output");
		try {
			String EN_ORDEN_COMPRA = detallePagoPublico.findElement("detallePagoPublico/oc").getText();
			String EN_COD_AREA = "";
			String EN_PHONE = "";
			String EN_TIPO_DOC = "Normal";
			String EN_STATUS = "0";
			String EN_NRO_DOC_VEN = "";
			String EN_NRO_DOC_TOTAL = "";
			String EN_MONTO_VEN = "";
			String EN_MONTO_TOTAL = "";
			String EN_ID_CLIENTE = "";
			String EN_COD_RESP_GATEWAY = "99";
			String EN_PASO_PAGO = "PASO 1";
			String EN_ORIGEN_PAGO = procedencia;
			String EN_DOC_SELECCIONADO = "T";
			String EN_ID_CANAL_GATEWAY = "";


			String EN_ID_TRX_GATEWAY = resValida.findElement("return/AUTENTIFICACION/ID_TRX").getText();
			String EN_ID_MEDIO_PAGO_GATEWAY = detallePagoPublico.findElement("detallePagoPublico/medioDePago").getText();




			log.debug("Orden de compra al insertar en DB : " + EN_ORDEN_COMPRA); 
			log.debug("Procedencia al insertar en DB : " + procedencia); 
			log.debug("Generando insercion para publico con el detalle : " + detallePagoPublico);
			EN_PASO_PAGO = "PASO PAGO";
			EN_COD_AREA = detallePagoPublico.findElement("detallePagoPublico/codAreaAPagar").getText();
			if(detallePagoPublico.findElement("detallePagoPublico/segmento").getText().trim().equals("fijo")){
				EN_PHONE = detallePagoPublico.findElement("detallePagoPublico/numeroFijo").getText();
				EN_COD_AREA = detallePagoPublico.findElement("detallePagoPublico/codAreaAPagar").getText();
				EN_ID_CLIENTE = detallePagoPublico.findElement("detallePagoPublico/codigoCliente").getText();
			}else{
				EN_PHONE = detallePagoPublico.findElement("detallePagoPublico/numeroMovil").getText();
				EN_COD_AREA = "N/A";
				EN_ID_CLIENTE = detallePagoPublico.findElement("detallePagoPublico/codigoCliente").getText();
			}				

			EN_NRO_DOC_VEN = detallePagoPublico.findElement("detallePagoPublico/documentoVencido").getText();
			EN_NRO_DOC_TOTAL = detallePagoPublico.findElement("detallePagoPublico/documentoActual").getText();

			if(EN_NRO_DOC_VEN.trim().equals("00000000000000") || EN_NRO_DOC_VEN.trim().equals("N/A")){					
				log.debug("Ingresa a la logica de insertar el numero de boleta");
				EN_NRO_DOC_VEN = EN_NRO_DOC_TOTAL;
			} 

			EN_MONTO_VEN = detallePagoPublico.findElement("detallePagoPublico/montoVencido").getText();
			EN_MONTO_TOTAL = detallePagoPublico.findElement("detallePagoPublico/montoAPagar").getText();
			EN_ID_CLIENTE = detallePagoPublico.findElement("detallePagoPublico/codigoCliente").getText();

			if(detallePagoPublico.findElement("detallePagoPublico/canal").getText().trim().equals("mobile")){

				EN_ID_CANAL_GATEWAY = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_ID_CANAL_MOBILE");
				log.debug("EN_ID_CANAL_GATEWAY MOBILE: "+EN_ID_CANAL_GATEWAY);	

			}else {

				EN_ID_CANAL_GATEWAY  = (String) webAppAccess.callMethod("M_getPreference", "DEVETEL_ID_CANAL_PUBLICO");
				log.debug("EN_ID_CANAL_GATEWAY PUBLICO: "+EN_ID_CANAL_GATEWAY);
			}			


			log.debug("Datos al insertar : ");
			log.debug(EN_ORDEN_COMPRA);
			log.debug(EN_COD_AREA);
			log.debug(EN_PHONE);
			log.debug(EN_TIPO_DOC);
			log.debug(EN_STATUS);
			log.debug(EN_NRO_DOC_VEN);
			log.debug(EN_NRO_DOC_TOTAL);
			log.debug(EN_MONTO_VEN);
			log.debug(EN_MONTO_TOTAL);
			log.debug(EN_ID_CLIENTE);
			log.debug(EN_COD_RESP_GATEWAY);
			log.debug(EN_PASO_PAGO);
			log.debug(EN_ORIGEN_PAGO);
			log.debug(EN_DOC_SELECCIONADO);
			log.debug(EN_ID_CANAL_GATEWAY);


			if(dbs.insertOrdenDeCompra( EN_ORDEN_COMPRA, 
					EN_COD_AREA, 
					EN_PHONE, 
					EN_TIPO_DOC, 
					EN_STATUS, 
					EN_NRO_DOC_VEN, 
					EN_NRO_DOC_TOTAL, 
					EN_MONTO_VEN, 
					EN_MONTO_TOTAL, 
					EN_ID_CLIENTE, 
					EN_COD_RESP_GATEWAY,
					EN_PASO_PAGO,
					EN_ORIGEN_PAGO,
					EN_DOC_SELECCIONADO,
					EN_ID_CANAL_GATEWAY)){
				log.debug("Insercion en DB correcta.");
				correcto = true;

				if(dbs.updateOrdenPaso(EN_ORDEN_COMPRA, EN_PASO_PAGO, EN_ID_TRX_GATEWAY, EN_ID_MEDIO_PAGO_GATEWAY, EN_MONTO_TOTAL)){
					correcto = true;
				}
				else{
					log.error("Actualizacion en DB no se pudo realizar :(");
					correcto = false;
				}
			}
			else {
				log.error("Fallo al insertar la orden de compra");
			}
		}
		catch (Exception e) {
			log.error("Error al insertar en DB############>>>>>>>>>> : " + e);
			correcto = false;
		}
		return correcto;
	}


	public void obtieneDatosTransaccion(WebAppAccess webAppAccess){
		DBSupport dbs = new DBSupport();
		String [] datos = null;
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
		String oc = detalle.findElement("detallePagoPublico/oc").getText();

		try {
			datos = dbs.obtieneDatosTransaccion(oc);
		} 
		catch (Exception e) {
			log.error("Error al obtener los datos de la tarjeta asociada al pago : " +e.getCause());
		}
		String descriptorPago = datos[3];
		String tipoTarjeta ="";
		String tipoCuota="";
		if(descriptorPago.trim().equalsIgnoreCase("VN")){
			tipoTarjeta ="Crédito";
			tipoCuota="Sin Cuotas";
		}
		else if(descriptorPago.trim().equalsIgnoreCase("VC")){
			tipoTarjeta ="Crédito";
			tipoCuota="Cuotas normales";
		}
		else if(descriptorPago.trim().equalsIgnoreCase("SI")){
			tipoTarjeta ="Crédito";
			tipoCuota="Sin interés";
		}
		else if(descriptorPago.trim().equalsIgnoreCase("CI")){
			tipoTarjeta ="Crédito";
			tipoCuota="Cuotas comercio";
		}
		else if(descriptorPago.trim().equalsIgnoreCase("VD")){
			tipoTarjeta ="RedCompra";
			tipoCuota="Venta débito";
		}
		detalle.findElement("detallePagoPublico/tarjetaCredito").setText(datos[0]);
		detalle.findElement("detallePagoPublico/numeroCuotas").setText(datos[1]);
		detalle.findElement("detallePagoPublico/codAutorizacion").setText(datos[2]);
		detalle.findElement("detallePagoPublico/montoCuota").setText(datos[4]);
		detalle.findElement("detallePagoPublico/tipoTarjeta").setText(tipoTarjeta);
		detalle.findElement("detallePagoPublico/tipoCuota").setText(tipoCuota);

	}


	public void fechaHoraDiaComprobante (WebAppAccess webAppAccess){

		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");

		SimpleDateFormat formatoComprobante = new SimpleDateFormat("dd/MMMM/yyyy hh:mm" , new Locale("ES"));
		Date hoy = new Date();

		String fechaActual = formatoComprobante.format(hoy);
		String[] splitFecha = fechaActual.split("/|\\ ");
		String dia = splitFecha[0];
		String mes = splitFecha[1];
		mes = mes.substring(0, 1).toUpperCase() + mes.substring(1);

		String anio = splitFecha[2];
		String hora = splitFecha[3];

		detalle.findElement("detallePagoPublico/diaActual").setText(dia);
		detalle.findElement("detallePagoPublico/mesActual").setText(mes);
		detalle.findElement("detallePagoPublico/anioActual").setText(anio);
		detalle.findElement("detallePagoPublico/horaActual").setText(hora);


		//Se obtiene el tipo de deuda que está pagando y el folio asociado
		String folioPagado = null;
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		if(tipoDeuda.trim().equals("total")){
			folioPagado = detalle.findElement("detallePagoPublico/documentoActual").getText();
		}
		else{
			folioPagado = detalle.findElement("detallePagoPublico/documentoVencido").getText();
		}
		detalle.findElement("detallePagoPublico/documentoPasoPago").setText(folioPagado);
	}

	public String obtieneFolioPagado(WebAppAccess webAppAccess){
		String folioPagado = "";
		IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");		
		String tipoDeuda = detalle.findElement("detallePagoPublico/tipoDeuda").getText();
		log.debug("Tipo de Deuda: " + tipoDeuda);
		if(tipoDeuda.trim().equals("total")){
			folioPagado = detalle.findElement("detallePagoPublico/documentoActual").getText();
		}
		else{
			folioPagado = detalle.findElement("detallePagoPublico/documentoVencido").getText();
		}
		detalle.findElement("detallePagoPublico/documentoPasoPago").setText(folioPagado);
		String montoOriginal = detalle.findElement("detallePagoPublico/montoAPagar").getText();
		detalle.findElement("detallePagoPublico/montoPasoPago").setText("$"+separadorMilesSinSigno(montoOriginal));
		  log.debug("Folio Pagado: " + folioPagado);
		return folioPagado;
	}
	
	public void documentoDeudaAPagar(WebAppAccess webAppAccess) {
		log.debug("**********************Inicio del metodo documentoDeudaAPagar************************");		
		try{
			
			IXml detalle = webAppAccess.getVariables().getXml("V_DetallePagoPublico");
			
			String documentoVencido = detalle.findElement("detallePagoPublico/documentoVencido").getText();
			log.debug("documentoVencido: "+documentoVencido);
			
			String documentoActual = detalle.findElement("detallePagoPublico/documentoActual").getText();
			log.debug("documentoActual: "+documentoActual);
			
						
			String montoPendiente = webAppAccess.getRequestInputs().getInputValue("montoPendiente");
			log.debug("Valor del input montoPendiente: "+montoPendiente);
			
			if(webAppAccess.getRequestInputs().getInputValue("montoPendiente")== null){				
				
			    detalle.findElement("detallePagoPublico/documentoPasoPago").setText(documentoVencido);
			}else{
				
			
				detalle.findElement("detallePagoPublico/documentoPasoPago").setText(documentoActual);
			}
		
		}catch (Exception e) {
			log.error("Error en el metodo valorDeudaAPagar" + e);
			e.printStackTrace();
		}
	}

	public static String separadorMilesSinSigno(String monto){
		double value;

		String numberFormat = "###,###,###,###";
		DecimalFormat formatter = new DecimalFormat(numberFormat);
		try {
			value = Double.parseDouble(monto);
		} catch (Throwable t) {
			return null;
		}
		String valor = formatter.format(value);
		valor = valor.replaceAll(",",".");
		return valor;

	}
	
	public static String encryptBlowBase64(byte[] plaintext, byte[] Key) {
		SecretKeySpec _key = new SecretKeySpec(Key, "Blowfish");
				
		if (plaintext.length % 8 != 0) { // not a multiple of 8
			byte[] padded = new byte[plaintext.length + 8
			    - (plaintext.length % 8)];
				System.arraycopy(plaintext, 0, padded, 0, plaintext.length);
				plaintext = padded;
			}
		try {
				Cipher cipher = Cipher.getInstance("Blowfish/ECB/NoPadding");
				cipher.init(Cipher.ENCRYPT_MODE, _key);
				byte[] cipherText = cipher.doFinal(plaintext);
				cipherText = Base64.encodeBase64(cipherText);
				String value = new String(cipherText);				
				return value;
			
		} catch (Exception e) {
				e.printStackTrace();				
				return null;
		}
	}
	
	/*public static void main(String []args){
        
		String parametrosURL = "M971408986";
		
		//boolean parametros = isNumeric(parametrosURL);
		//log.debug("Parametros: " + parametrosURL);
		
		//String parametrosURL = "gMzpTcphZlC0SI+JaUhPaw==";
		//boolean subString = parametrosURL.startsWith("M");
		
		
		String key = "1q2w3e4r5t6y7u8i";		
		String encrypt = encryptBlowBase64(parametrosURL.getBytes(), key.getBytes());
		
		String dataURLFormat = encrypt.replace("_", "+").replace("~", "/").replace("!", "=");
		//log.debug("dataURLFormat: " + dataURLFormat);
			
		//String parametros = decryptBlowBase64(dataURLFormat.getBytes(),key.getBytes()).trim();
		//log.debug("Parametro decrypt: "+parametros);
		
		System.out.println(dataURLFormat);
     }
*/

}
