<?php

class Warna_model extends Model {

    function Warna_model()
    {
        parent::Model();
    }

    function get_semua_warna($order = 'nama')
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM warna ORDER BY $order");

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    function get_warna($val, $col = 'id')
    {
        $data = "";
        $q = $this->db->query("SELECT * FROM warna WHERE $col = $val");
        
        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;
    }

    function insert_warna($data)
    {
        return $this->db->insert('warna', $data);
    }

    function update_warna($id_warna, $data)
    {
        $this->db->where('id', $id_warna);
        return $this->db->update('warna', $data);
    }

}

