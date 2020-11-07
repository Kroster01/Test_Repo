<?php

class Model_Beneficio_Jugador extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Beneficio_Jugador */
    public function setinsertBeneficioJugador($Pk_Beneficio, $Fecha_Ini, $Fecha_Fin, $Observacion, $Pk_Jugador)
    {

        $response = "OK";
        //echo "fecha en el modelo Model_Jugador.php -> : setinsertJugador: ".$Fecha_Ini;
        $array = array(
            'BEGU_FECHA_INI' => $Fecha_Ini,
            'BEGU_FECHA_FIN' => $Fecha_Fin,
            'BEGU_OBSERVACION' => $Observacion,
            'JUG_PK' => $Pk_Jugador,
            'BEF_PK' => $Pk_Beneficio,
        );

        try
        {
            $this->db->insert('beneficio_jugador', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg Jugador: ' . $e->getMessage();
            return $response;
        }
        return $response;
    }
}
