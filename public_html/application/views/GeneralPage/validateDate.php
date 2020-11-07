<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript" >

  // Función para permitir sólo números, retroceso y enter
  function SoloNumeros(evt){
    if(window.event){ //asignamos el valor de la tecla a keynum
      keynum = evt.keyCode; //IE
    }
    else{
      keynum = evt.which; //FF
    }

    //comprobamos si se encuentra en el rango numérico
    if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13){
      return true;
    }
    else
    {
      return false;
    }
  }

  // Función para verificar que la fecha escrita sea correcta según el formato YYYYMMDD
  function ValidarFecha(){
    // Almacenamos el valor digitado en TxtFecha
    var Fecha = document.getElementById('TxtFecha').value;
    var Mensaje = '';
    document.getElementById('Mensaje').className = '';

    // Si la fecha está completa comenzamos la validación
    if(Fecha.length == 8){
      var Anio = Fecha.substr(0, 4); // Extraemos en año
      var Mes = parseFloat(Fecha.substr(4, 2)) - 1; // Extraemos el mes
      var Dia = Fecha.substr(6, 2); // Extraemos el día

      // Con la función Date() de javascript evaluamos si la fecha existe
      var VFecha = new Date(Anio, Mes, Dia);

      // Si las partes de la fecha concuerdan con las que digitamos, es correcta
      if((VFecha.getFullYear() == Anio) && (VFecha.getMonth() == Mes) && (VFecha.getDate() == Dia)){
        Mensaje = 'Fecha correcta';
        document.getElementById('Mensaje').className = 'Mensaje1';
      }
      else
      {
        Mensaje = 'Fecha incorrecta';
        document.getElementById('Mensaje').className = 'Mensaje';
      }
    }

    // Mostramos el mesaje
    document.getElementById('Mensaje').innerHTML = Mensaje;
  }
</script>