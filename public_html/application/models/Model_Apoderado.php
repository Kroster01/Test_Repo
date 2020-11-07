<?php

class Model_Apoderado extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Apoderado */
    public function setinsertApoderado($apoderado, $CREATED, $CREATED_BY)
    {
        $response = "OK";
        $array = array (
            'APO_NOMBRE' => $apoderado->NomApoderado,
            'APO_CONTACTO' => $apoderado->FonoApoderado,
            'APO_E_MAIL' => $apoderado->EmailApoderado,
            'APO_CREATED' => $CREATED,
            'APO_CREATED_BY' => $CREATED_BY,
        );

        try
        {
            $this->db->insert('apoderado', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg Apoderado: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }
}
