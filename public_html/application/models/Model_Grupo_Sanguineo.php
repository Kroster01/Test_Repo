<?php

class Model_Grupo_Sanguineo extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Grupo_Sanguineo */
    public function getGrupSangui()
    {
        // Se retornan todas la Grupo Sanguineo
        $this->db->select("GSO_PK,
                        GSO_CORRELATIVO,
                        GSO_DESC")
            ->from("grupo_sanguineo");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
