<?php

class Model_baju extends Model {

    function Model_baju()
    {
        parent::Model();
    }

    function get_semua_model($order = 'nama')
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM model ORDER BY $order");

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

    function get_model($val, $col = 'id')
    {
        $data = "";
        $q = $this->db->query("SELECT model.id AS id, model.nama AS nama, model.merek AS id_merek, merek.nama AS merek, model.keterangan AS keterangan
                              FROM model, merek WHERE model.merek = merek.id AND model.{$col} = {$val}");

        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;
    }

    function insert_model($data)
    {
        return $this->db->insert('model', $data);
    }

    function update_model($id_model, $data)
    {
        $this->db->where('id', $id_model);
        return $this->db->update('model', $data);
    }


}
