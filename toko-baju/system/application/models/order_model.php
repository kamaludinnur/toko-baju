<?php
class Order_model extends Model {

    function Order_model()
    {
        parent::Model();
    }

    function insert_order($data)
    {
        $this->db->insert('order', $data);
        return $this->db->insert_id();
    }
}