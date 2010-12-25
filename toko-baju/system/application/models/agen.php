<?php
class Agen extends Model {
    function Agen(){
        parent::Model();
    }
    function get_semua_agen($order = 'nama')
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM agen ORDER BY $order");

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

    function get_agen($val, $col = 'id')
    {
        $data = "";
        $q = $this->db->query("SELECT * FROM agen WHERE $col = $val");

        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;
    }

    function insert_agen($data)
    {
        return $this->db->insert('agen', $data);
    }

    function update_agen($id_agen, $data)
    {
        $this->db->where('id', $id_agen);
        return $this->db->update('agen', $data);
    }
}
