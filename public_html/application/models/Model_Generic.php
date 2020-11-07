<?php

class Model_Generic extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Generic */
    public function checkidlastrecord($tableName, $PK)
    {

        $this->db->select("max(" . $PK . ") as max")
            ->from($tableName);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }
}
