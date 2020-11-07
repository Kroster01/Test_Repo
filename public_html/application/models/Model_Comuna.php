<?php

class Model_Comuna extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Comuna */
    public function getComunas()
    {
        // Se retornan todas la Comunas
        $this->db->select("CMA_PK,
                        CMA_DESC,
                        RGN_PK,
                        PVC_PK")
            ->from("comuna");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Comuna */
    public function getComunasByProvincia($selectedprovincia)
    {
        // Se retornan todas la Provincia
        $this->db->select("CMA_PK,
                        CMA_DESC,
                        RGN_PK,
                        PVC_PK")
            ->from("comuna")
            ->where("PVC_PK", $selectedprovincia);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

}
