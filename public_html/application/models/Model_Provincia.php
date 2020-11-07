<?php

class Model_Provincia extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Provincia */
    public function getProvincias()
    {
        // Se retornan todas la Provincia
        $this->db->select("PVC_PK,
                        PVC_DESC,
                        RGN_PK")
            ->from("provincia");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Provincia */
    public function getProvinciasByRegion($selectedregin)
    {
        // Se retornan todas la Provincia
        $this->db->select("PVC_PK,
                        PVC_DESC,
                        RGN_PK")
            ->from("provincia")
            ->where("RGN_PK", $selectedregin);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
