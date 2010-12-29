<?php

class Merek_model extends Model {

    function Merek_model() {
        parent::Model();
    }

    function get_semua_merek($order = 'nama')
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM merek ORDER BY $order");

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

    function get_merek($val, $col = 'id')
    {
        $data = "";
        $q = $this->db->query("SELECT * FROM merek WHERE $col = $val");
        
        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;
    }

    function insert_merek($data)
    {
        return $this->db->insert('merek', $data);
    }

    function update_merek($id_merek, $data)
    {
        $this->db->where('id', $id_merek);
        return $this->db->update('merek', $data);
    }

    function aman_dihapus($id_merek)
    {
        // syarat => belum pernah dibikin modelnya
        //        => nggak ada di tabel "model"

        $n = $this->db->query("SELECT * FROM model WHERE merek = {$id_merek}")->num_rows();
        if ($n > 0)
            return false; // kalo > 0 berarti ada modelnya => gak aman dihapus
        else
            return true;
    }

}

