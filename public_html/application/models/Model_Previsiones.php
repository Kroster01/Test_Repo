<?php

class Model_Previsiones extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Previsiones */
    public function getTipePrevision()
    {
        // Se retornan todas la Prevision
        $this->db->select("PVS_PK,
                        PVS_CODE,
                        PVS_NOMBRE,
                        PVS_DESC")
            ->from("previsiones")
            ->group_by("PVS_NOMBRE")
            ->order_by('PVS_PK', 'desc');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Previsiones */
    public function getPrevisonesByTipo($selectedprevision)
    {
        // Se retornan todas la Previsones By Tipo
        $this->db->select("PVS_PK,
                        PVS_CODE,
                        PVS_NOMBRE,
                        PVS_DESC")
            ->from("previsiones")
            ->where("PVS_CODE", $selectedprevision);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
