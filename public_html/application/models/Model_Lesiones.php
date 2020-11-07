<?php

class Model_Lesiones extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Lesiones - Se retornan todas la configuración de las Lesiones*/
    public function getLesiones()
    {
        // Se retornan todas la configuración de las Lesiones
        $this->db->select("LSN_PK,
                        LSN_MENU_LEVEL,
                        LSN_PARENT_LESION,
                        SN_CHILD_LESION,
                        LSN_DESCRIPCION,
                        LSN_CREATED,
                        LSN_CREATED_BY,
                        LSN_MODIFIED,
                        LSN_MODIFIED_BY")
            ->from("lesiones");

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Lesiones - Tipo de Lesiones */
    public function getTipoDeLesiones()
    {
        $this->db->select("LSN_PK,
                        LSN_MENU_LEVEL,
                        LSN_PARENT_LESION,
                        LSN_CHILD_LESION,
                        LSN_DESCRIPCION,
                        LSN_CREATED,
                        LSN_CREATED_BY,
                        LSN_MODIFIED,
                        LSN_MODIFIED_BY")
            ->from("lesiones")
            ->where("LSN_MENU_LEVEL", 1)
            ->order_by('LSN_PARENT_LESION', 'asc');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Lesiones - Area Corporal */
    public function getAreaCorporal()
    {
        $this->db->select("LSN_PK,
                        LSN_MENU_LEVEL,
                        LSN_PARENT_LESION,
                        LSN_CHILD_LESION,
                        LSN_DESCRIPCION,
                        LSN_CREATED,
                        LSN_CREATED_BY,
                        LSN_MODIFIED,
                        LSN_MODIFIED_BY")
            ->from("lesiones")
            ->where("LSN_MENU_LEVEL", 2)
            ->order_by('LSN_CHILD_LESION', 'asc');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Lesiones - Segmento Corporal */
    public function getSegmentoCorporal($idAreaCorporal)
    {
        $this->db->select("LSN_PK,
                        LSN_MENU_LEVEL,
                        LSN_PARENT_LESION,
                        LSN_CHILD_LESION,
                        LSN_DESCRIPCION,
                        LSN_CREATED,
                        LSN_CREATED_BY,
                        LSN_MODIFIED,
                        LSN_MODIFIED_BY")
            ->from("lesiones")
            ->where("LSN_MENU_LEVEL", 3)
            ->where("LSN_CHILD_LESION", $idAreaCorporal)
            ->order_by('LSN_DESCRIPCION', 'asc');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /* Model_Jugador */
    public function setLesiones_Jugador($pkJugador, $lesiones, $CREATED, $CREATED_BY)
    {

        $response = "OK";
        $array = array(
            'LSJ_TIPOLESION' => $lesiones->tipoLesion,
            'LSJ_AREACORPORAL' => $lesiones->areaCorporal,
            'LSJ_SEGCORPORAL' => $lesiones->segmentoCorporal,
            'LSJ_DIAGNOSTICO' => $lesiones->diagnostico,
            'LSJ_FECHALESION' => (string) $lesiones->fechaLesion,
            'JUG_PK' => $pkJugador,
            'LSJ_CREATED' => $CREATED,
            'LSJ_CREATED_BY' => $CREATED_BY,
        );

        try
        {
            $this->db->insert('lesiones_jugadores', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg lesiones_jugadores: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }

}
