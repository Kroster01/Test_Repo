<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$lang['email_must_be_array'] = "El método de validación de correo debe ser pasado como un arreglo.";
$lang['email_invalid_address'] = "Dirección de correo no válida: %s";
$lang['email_attachment_missing'] = "No se ha podido localizar el fichero adjunto: %s";
$lang['email_attachment_unreadable'] = "No se ha podido abrir el fichero adjunto: %s";
$lang['email_no_from'] = 'No se puede enviar correo sin encabezado "De".';
$lang['email_no_recipients'] = "Debe incluir receptores: Para, CC, o BCC";
$lang['email_send_failure_phpmail'] = "No puedo enviar el correo usando la función mail() de PHP.  Su servidor puede no estar configurado para usar este metodo de envío.";
$lang['email_send_failure_sendmail'] = "No puedo enviar el correo usando SendMail. Su servidor puede no estar configurado para usar este metodo de envío.";
$lang['email_send_failure_smtp'] = "No puedo enviar el correo usando SMTP PHP. Su servidor puede no estar configurado para usar este metodo de envío.";
$lang['email_sent'] = "Su mensaje a sido enviado satisfactoriamente usando el siguiente protocolo: %s";
$lang['email_no_socket'] = "No puedo abrir un socket para Sendmail. Por favor revise las configuraciones.";
$lang['email_no_hostname'] = "No has especificado un servidor SMTP";
$lang['email_smtp_error'] = "Los siguientes errores SMTP han sido encontrados: %s";
$lang['email_no_smtp_unpw'] = "Error: Debes asignar un usuario y contraseña para el servidor SMTP."; 
$lang['email_failed_smtp_login'] = "Falló enviando el comando AUTH LOGIN command. Error: %s";
$lang['email_smtp_auth_un'] = "Falló autentificando el usuario. Error: %s";
$lang['email_smtp_auth_pw'] = "Falló usando la contraseña. Error: %s";
$lang['email_smtp_data_failure'] = "No se han podido enviar los datos: %s";
$lang['email_exit_status'] = "Código de estado de salida: %s";