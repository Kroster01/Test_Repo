<?php

class Model_Posision_Cancha extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Posision_Cancha */
    public function getUbicacionCancha()
    {
        // Se retornan todas la Ubicacion Cancha
        $this->db->select("UBC_PK,
                        UBC_TIPO_JUEGO,
                        UBC_NUM_POSICION,
                        UBC_DESC_POSICION")
            ->from("ubicacion_cancha");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
