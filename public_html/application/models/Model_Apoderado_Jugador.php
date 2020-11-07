<?php

class Model_Apoderado_Jugador extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Apoderado_Jugador */
    public function setinsertApoderado_Jugador($pkApoderado, $pkJugador, $pkResponsabilidadApoderado, $CREATED, $CREATED_BY)
    {
        $response = "OK";
        $array = array(
            'JUG_PK' => $pkJugador,
            'APO_PK' => $pkApoderado,
            'REAP_PK' => $pkResponsabilidadApoderado,
            'APJU_CREATED' => $CREATED,
            'APJU_CREATED_BY' => $CREATED_BY,
        );

        try
        {
            $this->db->insert('apoderado_jugador', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg Apoderado: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }
}
