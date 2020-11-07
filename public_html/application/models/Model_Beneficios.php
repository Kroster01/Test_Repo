<?php

class Model_Beneficios extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Metodo que sirve para tal wea
     *
     * @return mixed
     */
    public function getBeneficios()
    {
        $this->db->select("BEF_PK,
						ORDER_BENEFICIO,
						BEF_DESCRIPCION,
						BEF_MONTO,
						BEF_TIPO_BEN")
            ->from("beneficios")
            ->where("BEF_ESTADO", 'ACTIVO')
            ->order_by('ORDER_BENEFICIO', 'asc');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
