<?php

class Model_Usuarios extends CI_Model
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
    public function GetUsuarioById($idUser)
    {
        $this->db->select("usuarios.USU_ID,
                        usuarios.USU_NOMBRE_COMPLETO,
                        usuarios.USU_CELULAR,
                        usuarios.USU_CORREO_ELECTRONICO,
                        usuarios.USU_CARGO_EMPRESA,
                        usuarios.USU_FOTOGRAFIA_RUTA,
                        usuarios.USU_FOTOGRAFIA_NOMBRE")
            ->from("usuarios")
            ->where("USU_ID",$idUser);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /**
    * 
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function GetUsuarioByUserPass($user,$pass)
    {
        $this->db->select("usuarios.USU_ID,
                        usuarios.USU_NOMBRE_COMPLETO,
                        usuarios.USU_CELULAR,
                        usuarios.USU_CORREO_ELECTRONICO,
                        usuarios.USU_CARGO_EMPRESA,
                        usuarios.USU_FOTOGRAFIA_RUTA,
                        usuarios.USU_FOTOGRAFIA_NOMBRE")
            ->from("usuarios")
            ->where("USU_NOMBRE_CUENTA",$user)
            ->where("USU_CLAVE",$pass);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /**
    * 
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function UpdateCuenta($pk,$dataUpCuenta)
    {
        $this->db->where('USU_ID', $pk);
        $this->db->update('usuarios', $dataUpCuenta);
    }

}