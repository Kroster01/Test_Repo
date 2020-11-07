<?php

class Model_Region extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Region */
    public function getRegiones()
    {
        // Se retornan todas la Region
        $this->db->select("RGN_PK,
                        RGN_N_REGION,
                        RGN_CODE_REG,
                        RGN_DESC")
            ->from("region");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
