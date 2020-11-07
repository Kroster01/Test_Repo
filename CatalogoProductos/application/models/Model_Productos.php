<?php

class Model_Productos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function GetProductos()
    {
        $this->db->select("productos.PRO_ID,
                        productos.PRO_NOMBRE,
                        productos.PRO_CODIGO,
                        productos.PRO_DESCRIPCION,
                        productos.PRO_VALOR_UNITARIO,
                        productos.PRO_FICHA_TECNICA_RUTA,
                        productos.PRO_FICHA_TECNICA_NOMBRE,
                        productos.PRO_FOTOGRAFIA_RUTA,
                        productos.PRO_FOTOGRAFIA_NOMBRE,
                        proveedores.PVD_NOMBRE")
            ->from("productos")
            ->join('proveedores', 'proveedores.PVD_ID = productos.PVD_ID');

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /**
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function GetProductosByID($id_producto)
    {
        $this->db->select("productos.PRO_ID,
                        productos.PRO_NOMBRE,
                        productos.PRO_CODIGO,
                        productos.PRO_DESCRIPCION,
                        productos.PRO_VALOR_UNITARIO,
                        productos.PRO_FICHA_TECNICA_RUTA,
                        productos.PRO_FICHA_TECNICA_NOMBRE,
                        productos.PRO_FOTOGRAFIA_RUTA,
                        productos.PRO_FOTOGRAFIA_NOMBRE,
                        proveedores.PVD_NOMBRE,
                        proveedores.PVD_ID")
            ->from("productos")
            ->join('proveedores', 'proveedores.PVD_ID = productos.PVD_ID')
            ->where('productos.PRO_ID',$id_producto);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    /**
    * 
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function AddProductos($dataProducto)
    {
        $this->db->insert('productos', $dataProducto);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /**
    * 
    *
    * @param	Sin Parametros
    * @return	lista de personas
    */
    public function UpdateProducto($pk,$dataUpCuenta)
    {
        $this->db->where('PRO_ID', $pk);
        $this->db->update('productos', $dataUpCuenta);
    }
}