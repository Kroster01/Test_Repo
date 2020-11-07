<?php

class Model_Categorias extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Categorias */
    public function getCategoria()
    {
        // Se retornan todas la Categorias
        $this->db->select("CAT_PK,
                        CAT_DESC_CATEGORIA")
            ->from("categorias");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
