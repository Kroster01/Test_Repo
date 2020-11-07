<?php

class Model_Proveedores extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
    * 
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function GetProveedores()
    {
        $this->db->select("proveedores.PVD_ID,
                        proveedores.PVD_DESCRIPCION,
                        proveedores.PVD_NOMBRE")
            ->from("proveedores");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

}