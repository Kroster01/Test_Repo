<?php

class Model_Persona extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* Model_Persona */
    public function setinsertRegistroJugador($nombres, $apellidos, $rut, $fecha_nac, $fono_contacto, $fecha_pago_cuota, $monto_cuota, $e_mail, $direccion, $JUG_PK, $CMA_PK)
    {

        $array = array
            (
            'PER_NOMBRES'->$nombres,
            'PER_APELLIDOS'->$apellidos,
            'PER_RUT'->$rut,
            'PER_FECHE_NAC'->$fecha_nac,
            'PER_FONO_CONTACTO'->$fono_contacto,
            'PER_FEC_PAGO_CUOTA'->$fecha_pago_cuota,
            'PER_MONTO_CUOTA'->$monto_cuota,
            'PER_E_MAIL'->$e_mail,
            'PER_DIRECCION'->$direccion,
            'JUG_PK'->$JUG_PK,
            'CMA_PK'->$CMA_PK,
        );

        $this->db->insert('persona', $array);
    }

    /* Model_Persona */
    public function setInsertPersona($Nombre, $Apellido, $Rut, $FotoPerfil, $FechaNacimiento, $FonoContacto, $Email, $PkComuna, $idJugador, $Direccion, $CREATED, $CREATED_BY)
    {
        $response = "OK";
        $array = array
            (
            'PER_NOMBRES' => $Nombre,
            'PER_APELLIDOS' => $Apellido,
            'PER_RUT' => $Rut,
            'PER_FECHE_NAC' => (string) $FechaNacimiento,
            'PER_FONO_CONTACTO' => $FonoContacto,
            'PER_E_MAIL' => $Email,
            'PER_DIRECCION' => $Direccion,
            'PER_CREATED' => $CREATED,
            'PER_CREATED_BY' => $CREATED_BY,
            'JUG_PK' => $idJugador,
            'CMA_PK' => $PkComuna,
        );

        try
        {
            $this->db->insert('persona', $array);
        } catch (Exception $e) {
            $response = 'Excepción al insertar Reg Persona: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }

    /* Model_Persona */
    public function GetCountPersonaByRut($Rut)
    {
        $this->db->select("count(*) as countPerson")
            ->from("jugador")
            ->join('persona', 'persona.JUG_PK = jugador.JUG_PK')
            ->where("persona.PER_RUT", $Rut);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;

    }
}
