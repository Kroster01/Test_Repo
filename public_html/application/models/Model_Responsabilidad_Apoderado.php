<?php

class Model_Responsabilidad_Apoderado extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Responsabilidad_Apoderado */
    public function getResponsabilidadApoderados()
    {
        // Se retornan todas la Prevision
        $this->db->select("REAP_PK,
                        REAP_DESCRIPCION")
            ->from("responsabilidad_apoderado")
            ->order_by("REAP_PK", "asc");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
