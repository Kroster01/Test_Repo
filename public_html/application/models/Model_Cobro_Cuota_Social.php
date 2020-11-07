<?php

class Model_Cobro_Cuota_Social extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Cobro_Cuota_Social */
    public function getSearchCuota($searchCuota)
    {
        $queryString = "";
        $queryString = $queryString . "SELECT CONCAT(PER.PER_NOMBRES,' ',PER.PER_APELLIDOS) NOMBRE,PER.PER_RUT,CCS.CCS_MONTO_PAGO,CCS.CCS_PERIODO_PAGO,CAT.CAT_DESC_CATEGORIA, " . "'Valor Pendiente'" . " APODERADOS ";
        $queryString = $queryString . "FROM cobro_cuota_social CCS ";
        $queryString = $queryString . "INNER JOIN jugador JUGA on CCS.JUG_PK = JUGA.JUG_PK ";
        $queryString = $queryString . "INNER JOIN persona PER on JUGA.JUG_PK = PER.JUG_PK ";
        $queryString = $queryString . "INNER JOIN categorias CAT on JUGA.CAT_PK = CAT.CAT_PK ";

        $where = "";
        if ($searchCuota->Nombre != "") {
            $where = $where . "PER.PER_NOMBRES LIKE '%" . $searchCuota->Nombre . "%' ";
        }

        if ($searchCuota->Apellido != "") {
            $where = ($where != "") ? $where . " AND PER.PER_APELLIDOS LIKE '%" . $searchCuota->Apellido . "%' " : $where . " PER.PER_APELLIDOS LIKE '%" . $searchCuota->Apellido . "%' ";
        }

        if ($searchCuota->Rut != "") {
            $where = ($where != "") ? $where . " AND PER_RUT LIKE '%" . $searchCuota->Rut . "%' " : $where . " PER_RUT LIKE '%" . $searchCuota->Rut . "%' ";
        }

        if ($searchCuota->FechaIni != "") {
            // Validar
            //$where = ($where != "") ? $where." AND date('".$searchCuota->FechaIni."') <= date(CCS_PERIODO_PAGO) " :$where." date('".$searchCuota->FechaIni."') <= date(CCS_PERIODO_PAGO) ";
        }

        if ($searchCuota->FechaFin != "") {
            // Validar
            //$where = ($where != "") ? $where." AND date(CCS_PERIODO_PAGO) <= date('".$searchCuota->FechaFin."')" : $where." date(CCS_PERIODO_PAGO) <= date('".$searchCuota->FechaFin."')";
        }

        if ($searchCuota->Categoria != "0") {
            $where = ($where != "") ? $where . " AND CAT.CAT_PK = " . $searchCuota->Categoria . " " : $where . " CAT.CAT_PK = " . $searchCuota->Categoria . " ";
        }

        if ($where != "") {
            $where = " where " . $where;
        }

        $queryString = $queryString . $where;
        $queryString = $queryString . " ORDER BY CCS.CCS_PK ASC ";
        $query = $this->db->query($queryString);

        return $query->result();
    }
}
