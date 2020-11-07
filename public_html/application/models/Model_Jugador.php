<?php

class Model_Jugador extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Jugador */
    public function setinsertJugador($Fec_ini_club, $Cont_emergencia, $Estatura, $Peso, $Seuro_accidente,
        $Stado_in_club, $Medicamentos, $Eva_nutri, $Alergias, $Observaciones, $Pk_previsiom, $Pk_grupo_sanguineo,
        $Pk_categoria, $Pk_ubicacioncahncha, $CREATED, $CREATED_BY) {

        $response = "OK";
        $array = array
            (
            'JUG_FEC_INI_CLUB' => (string) $Fec_ini_club,
            'JUG_CONT_EMERGENCIA' => $Cont_emergencia,
            'JUG_ESTATURA' => $Estatura,
            'JUG_PESO' => $Peso,
            'JUG_SEURO_ACCIDENTE' => $Seuro_accidente,
            'JUG_STADO_IN_CLUB' => $Stado_in_club,
            'JUG_MEDICAMENTOS' => $Medicamentos,
            'JUG_EVA_NUTRI' => $Eva_nutri,
            'JUG_ALERGIAS' => $Alergias,
            'JUG_OBS' => $Observaciones,
            'JUG_CREATED' => $CREATED,
            'JUG_CREATED_BY' => $CREATED_BY,
            'PVS_PK' => $Pk_previsiom,
            'GSO_PK' => $Pk_grupo_sanguineo,
            'CAT_PK' => $Pk_categoria,
            'UBC_PK' => $Pk_ubicacioncahncha,
        );

        try
        {
            $this->db->insert('jugador', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg Jugador: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }

    /* Model_Jugador */
    public function getSearchJugador($searchJugador)
    {
        $queryString = "";

        $queryString = $queryString . "SELECT JUGA.JUG_FEC_INI_CLUB,JUGA.JUG_PK,PER.PER_NOMBRES,PER.PER_APELLIDOS,PER.PER_RUT,CAT.CAT_DESC_CATEGORIA,BEN.BEF_DESCRIPCION,BEJU.BEGU_OBSERVACION  ";
        $queryString = $queryString . "FROM jugador JUGA ";
        $queryString = $queryString . "INNER JOIN persona PER on JUGA.JUG_PK = PER.JUG_PK ";
        $queryString = $queryString . "INNER JOIN categorias CAT on JUGA.CAT_PK = CAT.CAT_PK ";
        $queryString = $queryString . "INNER JOIN beneficio_jugador BEJU on JUGA.JUG_PK = BEJU.JUG_PK ";
        $queryString = $queryString . "INNER JOIN beneficios BEN on BEJU.BEF_PK = BEN.BEF_PK ";

        $where = "";
        if ($searchJugador->Nombre != "") {
            $where = $where . "PER.PER_NOMBRES LIKE '%" . $searchJugador->Nombre . "%' ";
        }

        if ($searchJugador->Apellido != "") {
            $where = ($where != "") ? $where . " AND PER.PER_APELLIDOS LIKE '%" . $searchJugador->Apellido . "%' " : $where . " PER.PER_APELLIDOS LIKE '%" . $searchJugador->Apellido . "%' ";
        }

        if ($searchJugador->Rut != "") {
            $where = ($where != "") ? $where . " AND PER_RUT LIKE '%" . $searchJugador->Rut . "%' " : $where . " PER_RUT LIKE '%" . $searchJugador->Rut . "%' ";
        }

        if ($searchJugador->Categoria != "0") {
            $where = ($where != "") ? $where . " AND CAT.CAT_PK = " . $searchJugador->Categoria . " " : $where . " CAT.CAT_PK = " . $searchJugador->Categoria . " ";
        }

        if ($where != "") {
            $where = " where " . $where;
        }

        $queryString = $queryString . $where;
        $query = $this->db->query($queryString);
        return $query->result();
    }

    /* Model_Jugador */
    public function getSearchJugador2($searchJugador)
    {
        $queryString = "";

        $queryString = $queryString . "SELECT JUGA.JUG_FEC_INI_CLUB,JUGA.JUG_PK,PER.PER_NOMBRES,PER.PER_APELLIDOS,PER.PER_RUT,CAT.CAT_DESC_CATEGORIA,BEN.BEF_DESCRIPCION,BEJU.BEGU_OBSERVACION  ";
        $queryString = $queryString . "FROM jugador JUGA ";
        $queryString = $queryString . "INNER JOIN persona PER on JUGA.JUG_PK = PER.JUG_PK ";
        $queryString = $queryString . "INNER JOIN categorias CAT on JUGA.CAT_PK = CAT.CAT_PK ";
        $queryString = $queryString . "INNER JOIN beneficio_jugador BEJU on JUGA.JUG_PK = BEJU.JUG_PK ";
        $queryString = $queryString . "INNER JOIN beneficios BEN on BEJU.BEF_PK = BEN.BEF_PK ";

        $where = "";
        if ($searchJugador->Nombre != "") {
            $where = $where . "PER.PER_NOMBRES LIKE '%" . $searchJugador->Nombre . "%' ";
        }

        if ($searchJugador->Apellido != "") {
            $where = ($where != "") ? $where . " AND PER.PER_APELLIDOS LIKE '%" . $searchJugador->Apellido . "%' " : $where . " PER.PER_APELLIDOS LIKE '%" . $searchJugador->Apellido . "%' ";
        }

        if ($searchJugador->Rut != "") {
            $where = ($where != "") ? $where . " AND PER_RUT LIKE '%" . $searchJugador->Rut . "%' " : $where . " PER_RUT LIKE '%" . $searchJugador->Rut . "%' ";
        }

        if ($searchJugador->Categoria != "0") {
            $where = ($where != "") ? $where . " AND CAT.CAT_PK = " . $searchJugador->Categoria . " " : $where . " CAT.CAT_PK = " . $searchJugador->Categoria . " ";
        }

        if ($where != "") {
            $where = " where " . $where;
        }

        $queryString = $queryString . $where;
        $query = $this->db->query($queryString);
        return $query->result();
    }
}
